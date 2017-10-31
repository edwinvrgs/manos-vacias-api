<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Ninho extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'ninho';

    protected $fillable = [
        'nombre', 'apellido', 'descripcion_situacion'
    ];

    public function requerimientos() {
        return $this->hasMany(Requerimiento::class);
    }

    public function cancer() {
        return $this->belongsToMany(Cancer::class, 'ninho_cancer')->withPivot('descripcion')->withPivot('enable')->withTimestamps();
    }

    public function representante() {
        return $this->belongsTo(Representante::class);
    }
}
