<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Representante extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'representante';
    protected $primaryKey = 'cedula';

    public $incrementing = false;

    protected $fillable = [
        'cedula', 'nombre', 'apellido', 'numero_contacto_1', 'numero_contacto_2'
    ];

    public function municipio() {
        return $this->belongsTo(Municipio::class);
    }

    public function ninhos() {
        return $this->hasMany(Ninho::class);
    }

    public function user() {
        return $this->hasOne(User::class);
    }
}
