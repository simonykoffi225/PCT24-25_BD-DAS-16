<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'acte_id',
        'type_acte',
        'numero_acte', 
        'date_acte',
        'nombre_copie',
        'statut',
        'date_demande' // Assurez-vous que ce champ existe
    ];

    protected $casts = [
        'date_acte' => 'date',
        'date_demande' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function acteNaissance()
    {
        return $this->belongsTo(ActeNaissance::class, 'acte_id');
    }

    public function acteMariage()
    {
        return $this->belongsTo(ActeMariage::class, 'acte_id');
    }

    public function acteDeces()
    {
        return $this->belongsTo(ActeDeces::class, 'acte_id');
    }

    // Méthode pour obtenir l'acte en fonction du type
    public function acte()
    {
        switch ($this->type_acte) {
            case 'naissance':
                return $this->acteNaissance();
            case 'mariage':
                return $this->acteMariage();
            case 'deces':
                return $this->acteDeces();
            default:
                return null;
        }
    }
}