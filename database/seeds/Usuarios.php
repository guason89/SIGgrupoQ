<?php

use Illuminate\Database\Seeder;

class Usuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //eliminamos los existentes
        DB::table('usuarios')->truncate();
        DB::table('perfiles')->delete();

        //insertar los perfiles
    	DB::table('perfiles')->insert(['id'=>1,'nombre' => 'ADMIN SISTEMA', 'descripcion' => 'Administrador del Sistema']);
      	DB::table('perfiles')->insert(['id'=>2,'nombre' => 'USUARIO TACTICO', 'descripcion' => 'USUARIO DEL NEGOCIO TACTICO']);
      	DB::table('perfiles')->insert(['id'=>3,'nombre' => 'USUARIO ESTRATEGICO', 'descripcion' => 'USUARIO DEL NEGOCIO ESTRATEGICO']);	
      


      	//usuarios   	

       	DB::table('usuarios')->insert([ 'nombre' => 'Administrador Del Sistema', 'email' => 'admin@gmail.com','usuario'=>'admin', 'password'=>md5('admin14'), 'activo'=>'true','idperfil'=>'1']);

        DB::table('usuarios')->insert([ 'nombre' => 'De La Cruz De La O, Jose Oswaldo', 'email' => 'jose@gmail.com','usuario'=>'oswaldo', 'password'=>md5('de la o'), 'activo'=>'true','idperfil'=>'2']);

        DB::table('usuarios')->insert([ 'nombre' => 'Borja, Marcos Tulio', 'email' => 'marcos@gmail.com','usuario'=>'marcos', 'password'=>md5('borja'), 'activo'=>'true','idperfil'=>'3']);
    }
}
