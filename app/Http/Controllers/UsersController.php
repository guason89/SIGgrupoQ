<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use DB;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Perfiles;
use Auth;
use Laracasts\Flash\Flash;

class UsersController extends Controller
{
     
   use AuthenticatesUsers;
   
   protected $loginView = 'auth.login';

    public function index(){
      
      $usuarios = User::all();
      $data['usuarios'] = $usuarios;
       	
       	return view('auth.index',$data);
    }

    public function authenticate(Request $request)
    {
      //return $request->contraseña;
      $usuario = User::where('usuario', $request->nombre)
          ->where('password', md5($request->contraseña))
          ->where('activo','true')->first();
    	if($usuario)         
    	{ 
        Auth::login($usuario);
        return redirect()->route('doInicio');
		}
		else
		{
     
			return redirect('/')
      ->withInput($request->only('nombre'))
      ->withErrors([
          'nombre'=>'Las credenciales no son validas.'
        ]);
		}
		
       
    }
    public function logout(){
    	Auth::logout();
      \Session::flush();
    	return redirect('/');
    }
  
    public function getRegister(){
    	$roles = Perfiles::select('id','nombre')->get();    	
      return view('auth.register',['roles'=>$roles]);
    }
     
    public function postRegister(Request $request){

      $this->validate($request,[             
          'name'=>'required|max:100|regex: /^[a-zA-Z0-9áéíóúñÑ,\s\-\_\.]*$/ ',
          'email' => 'required|email|max:255|unique:usuarios',
          'usuario'=>'required|max:100|unique:usuarios|regex: /^[a-zA-Z0-9áéíóúñÑ,\s\-\_\.]*$/ ',
          'password' => 'required|confirmed|min:6',
          'perfil'=>'required|not_in:0',
        ]);

      	$usuario = new User();
        $usuario->nombre = $request->name;
        $usuario->usuario = $request->usuario;
        $usuario->email = $request->email;
        $usuario->password = md5($request->password); 
		    $usuario->activo = "true";
        $usuario->idperfil = $request->perfil;       
		    $usuario->save();   		
    
       flash('guardado','success');
        $usuarios = User::all();
        return redirect()->route('indexusuarios');
      
    }
    public function getEdit($id){
    	  $usuario = User::FindOrFail($id);
       	$roles = Perfiles::all();    	
    	  return view('auth.edit',['roles'=>$roles,'usuario'=>$usuario]);
    }

    //funcion actualizar usuario
    public function update(Request $request){
 
      $this->validate($request,[
            'nombre'=>'required|max:100|regex: /^[a-zA-Z0-9áéíóúñÑ,\s\-\_\.]*$/|unique:usuarios,nombre,'.$request->idUsuario.',id',
            'email' => 'required|email|max:255|unique:usuarios,email,'.$request->idUsuario.',id',
            'usuario'=>'required',
        ]); 
     
         //recuperar usuario a actualizar
        $usuario = User::where('id',$request->idUsuario)->first();
    
        if($request->input('password'))
        {
          $this->validate($request,[
            'password' => 'confirmed|min:6',
        ]);

          $usuario->nombre = $request->nombre;
          $usuario->password = md5($request->password);
          $usuario->email = $request->email;
          $usuario->usuario = $request->usuario;
          $usuario->activo = $request->activo;
          $usuario->idperfil = $request->perfil;
          $usuario->save();
          
        }
        else
        {
          $usuario->nombre = $request->nombre;          
          $usuario->email = $request->email;
          $usuario->usuario = $request->usuario;
          $usuario->activo = $request->activo;
          $usuario->idperfil = $request->perfil;
          $usuario->save();      
        }
        
        flash('actualizado','success');
        return redirect()->route('indexusuarios');
           
        
    }//fin de update

     public function mostrar($id)
    {
        $usuario= User::FindOrFail($id);
        return view('auth.delete')->with('usuario',$usuario);
    }

   public function destroy(Request $request)
    { 
      $u=User::FindOrFail($request->idUsuario);
          
      $u->delete();
     
            flash('eliminado exitosamente','success');            
            return redirect()->route('indexusuarios');
        
    }

     public function edit($id)
    {
        $usuario = User::FindOrFail($id);
        $roles = Role::all();     
        return view('auth.actualizar',['roles'=>$roles,'usuario'=>$usuario]);
    }

}
