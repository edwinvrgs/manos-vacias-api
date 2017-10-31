<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Cancer extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'cancer';

    protected $fillable = [
        'nombre', 'descripcion',
    ];

    public function ninhos() {
        return $this->belongsToMany(Ninho::class, 'ninho_cancer')->withPivot('descripcion')->withPivot('enable')->withTimestamps();
    }
}
