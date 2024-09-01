<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'persona';
    protected $primaryKey = 'pk_persona';

    protected $fillable = [
        'correo',
        'clave',
        'nombre',
    ];

    protected $hidden = [
        'clave',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->clave = bcrypt($model->clave);
        });
    }

}
