<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Itineraire extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $hidden = ['created_at', 'updated_at'];

    protected static function booted()
    {
        static::creating(function ($record) {
            $record->id = (string) Str::uuid();
        });
    }
}

