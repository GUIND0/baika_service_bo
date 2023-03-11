<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retour extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;


    protected static function booted()
    {
        static::creating(function ($record) {
            $record->id = (string) Str::uuid();
        });
    }
}
