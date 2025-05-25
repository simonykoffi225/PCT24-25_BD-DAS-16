<?php

// app/Models/ActeNaissance.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActeNaissance extends Model
{
    use HasFactory;

    protected $table = 'acte_naissance';
    protected $fillable = [
        'filiation',
        'nom_demandeur',
        'prenom_demandeur',
        'date_naissance',
        'date_acte',
        'nom_enfant',
        'prenom_enfant',
        'lieu_naissance',
        // nouvelle colonne
        'heure_naissance',
        'localite_id',
        'nom_pere',
        'prenom_pere',
        'domicile_pere',
        'profession_pere',
        'numero_cni_pere',
        'nom_mere',
        'prenom_mere',
        'domicile_mere',
        'profession_mere',
        'numero_cni_mere',
        'numero_acte',
        'statut',
        'updated_by_status',
        'motif_rejet',
        'documents',
        'user_id',

    ];

    protected $casts = [
        'date_naissance' => 'date',
        'date_acte' => 'date',
        'heure_naissance' => 'datetime:H:i:s', 
        'documents'       => 'array',
    ];

    public function localite()
    {
        return $this->belongsTo(Localite::class, 'localite_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($acte) {
            $acte->numero_acte = 'AN-' . date('Y-m') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_status');
    }
}
