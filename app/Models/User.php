<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable, Searchable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function vacancies():BelongsToMany
    {
        return $this->belongsToMany(Vacancy::class);
    }

    public function createdVacancies():HasMany
    {
        return $this->hasMany(Vacancy::class);
    }
}
