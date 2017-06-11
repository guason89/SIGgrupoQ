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
       	return view('auth.index')->with('usuarios',$usuarios);
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

      	User::create([
            'nombre' =>$request->name,	
            'usuario' =>$request->usuario,  	    
            'email' =>$request->email,
		        'password' => md5($request->password),
		        'activo' =>'true',	
		        'idPerfil'=>$request->perfil,
		        ]
    		);
    
       flash('guardado','success');
        $usuarios = User::all();
        return redirect()->route('indexusuarios');
      
    }
    public function getEdit($id){
    	  $usuario = User::FindOrFail($id);
       	$roles = Role::all();    	
    	  return view('auth.edit',['roles'=>$roles,'usuario'=>$usuario]);
    }

    //funcion actualizar usuario
    public function update(Request $request, $id){

      $this->validate($request,[
            'nombre'=>'required|max:100|regex: /^[a-zA-Z0-9áéíóúñÑ,\s\-\_\.]*$/|unique:users,name,'.$id.',id',
            'email' => 'required|email|max:255|unique:users,email,'.$id.',id',
            'password' => 'confirmed|min:6',

        ]); 
      
         //recuperar usuario a actualizar
        $usuario = User::FindOrFail($id);
        $depto=Department::where('id','=',$usuario->departamento_id)->first();
        if($depto){
          $depto->update([           
            'encargado' =>$request->input('nombre'),                                 
          ]);
        }
        

         if($request->input('depto'))//if deptos
        {
          if($request->input('password'))
          {
            $usuario->update([           
            'name' =>$request->input('nombre'),
            'usuario' =>$request->input('usuario'),        
            'email' =>$request->input('email'),
            'password' => bcrypt($request['password']),             
          ]);
          }
          else
          {
            $usuario->update([           
            'name' =>$request->input('nombre'),       
            'email' =>$request->input('email'),
            'usuario' =>$request->input('usuario'),               
          ]);
          }
          
        flash('actualizado','success');
        return redirect()->back();
        }//fin if deptos
        else
        {
          if($request->input('password'))
          {
             $usuario->update([          
            'name' =>$request->input('nombre'),           
            'password' => bcrypt($request['password']),                 
            'email' =>$request->input('email'), 
            'usuario' =>$request->input('usuario'),         
            'activo' =>$request->input('activo'),  
            'perfil_id'=>$request->input('perfil')
          ]);
          }
          else
          {
             $usuario->update([          
            'name' =>$request->input('nombre'),                         
            'email' =>$request->input('email'), 
            'usuario' =>$request->input('usuario'),         
            'activo' =>$request->input('activo'),  
            'perfil_id'=>$request->input('perfil')
          ]);
          }
        
        flash('actualizado','success');
        $usuarios = User::all();
        return view('auth.index')->with('usuarios',$usuarios); 
        }    
        
    }//fin de update

     public function mostrar($id)
    {
        $usuario= User::FindOrFail($id);
        return view('auth.delete')->with('usuario',$usuario);
    }

   public function destroy($id)
    {
      $u=User::FindOrFail($id);

      if($u->perfil_id==4)
      {
        $departamento = Department::where('id',$u->departamento_id)->first(); 
         if($departamento){
          $departamento->update([           
            'encargado' =>'No Definido',                                 
          ]);
        }  
      }           
       
      $u->delete();
     
            flash('eliminado exitosamente','success');
            $usuarios = User::all();
            return view('auth.index')->with('usuarios',$usuarios);
        
    }

     public function edit($id)
    {
        $usuario = User::FindOrFail($id);
        $roles = Role::all();     
        return view('auth.actualizar',['roles'=>$roles,'usuario'=>$usuario]);
    }

}
