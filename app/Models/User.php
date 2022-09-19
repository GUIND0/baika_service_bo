<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as IlluminateAuthenticatable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
    use IlluminateAuthenticatable;

    protected $dates = ['last_login_at'];

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'roles_id',
        'nom',
        'prenom',
        'email',
        'telephone',
        'password',
        'etat',
        'last_login_at',
    ];



    protected static function booted()
    {
        static::creating(function ($user) {
            $user->id = (string) Str::uuid();
        });
    }

    public function role()
    {
        return $this->belongsTo(Role::class,'roles_id');
    }


}
