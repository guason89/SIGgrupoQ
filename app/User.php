<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
   
    protected $table='usuarios';
    protected $primaryKey='id';
  
   

    public function perfil(){
        return $this->hasOne('App\Models\Perfiles','id','idperfil');       
    }
}
