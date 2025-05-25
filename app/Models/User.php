<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Les rôles disponibles
     */
    public const ROLE_CITOYEN = 'citoyen';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_OFFICIER = 'officier';

    /**
     * @var array Liste des rôles
     */
    public static $roles = [
        self::ROLE_CITOYEN => 'Citoyen',
        self::ROLE_OFFICIER => 'Officier',
        self::ROLE_ADMIN => 'Administrateur',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'date_naissance',
        'genre',
        'contact',
        'role',
        'signature', // Ajout de la signature
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_naissance' => 'date',
        'role' => 'string', // Bien que ce soit un enum en base
    ];

    /**
     * Vérifie si l'utilisateur a un rôle spécifique
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Vérifie si l'utilisateur est admin
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(self::ROLE_ADMIN);
    }

    /**
     * Vérifie si l'utilisateur est officier
     */
    public function isOfficier(): bool
    {
        return $this->hasRole(self::ROLE_OFFICIER);
    }

    /**
     * Vérifie si l'utilisateur est citoyen
     */
    public function isCitoyen(): bool
    {
        return $this->hasRole(self::ROLE_CITOYEN);
    }

    public function getRoleName()
    {
        return self::$roles[$this->role] ?? $this->role;
    }
    public function actesNaissance()
    {
        return $this->hasMany(ActeNaissance::class);
    }
    public function actesMariage()
    {
        return $this->hasMany(ActeMariage::class);
    }
    public function actesDeces()
    {
        return $this->hasMany(ActeDeces::class);
    }
}