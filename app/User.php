<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='usuarios';
    protected $primaryKey='id';
    protected $fillable = [
        'nombre', 'email', 'password','usuario','activo','idPerfil',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function perfil(){
        return $this->hasOne('sig\Models\Perfiles','id','idPerfil');       
    }
}
