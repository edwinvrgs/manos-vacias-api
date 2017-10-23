<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Requerimiento extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'requerimiento';

    protected $fillable = [
        'descripcion', 'cantidad', 'fecha_vencimiento', 'estado'
    ];

    public function adjuntos() {
        return $this->hasMany(Adjunto::class);
    }

    public function tipo() {
        return $this->belongsTo(Tipo::class);
    }

    public function ninho() {
        return $this->belongsTo(Ninho::class);
    }
}
