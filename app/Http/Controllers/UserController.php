<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

use App\Models\User;

class UserController extends Controller
{
    function listado()
    {

        $users = User::with('roles')->get();


        return view('users.user',compact('users'));
    }

    function formulario($oper='', $id='')
    {
        $user = empty($id)? new User() : User::find($id);
        $roles = Role::all()->pluck('name');
        return view('users.formulario',compact('user', 'oper', 'roles'));
    }

    function mostrar($id)
    {
        return $this->formulario('cons', $id);
    }


    function actualizar($id)
    {
        return $this->formulario('modi', $id);

    }

    function eliminar($id)
    {
        return $this->formulario('supr', $id);

    }

    function alta()
    {
        return $this->formulario();
    }

    function almacenar(Request $request)
    {

        if ($request->oper == 'supr')
        {

            $user = User::find($request->id);
            $user->delete();

            $salida = redirect()->route('user.listado');
        }
        else
        {
            
            $validatedData = $request->validate([
                'name'         => 'required|string|max:255',
                'email'          => 'required|string|max:255',
                'password'          => 'required|string|max:255',
            ], [
                'name.required' => 'El nombre es obligatorio.',
                'name.string'   => 'Debe ser de tipo cadena de texto.',
                'name.max'      => 'Máximo 255 caracteres',

                'email.required' => 'El autor es obligatorio.',
                'email.string'   => 'Debe ser de tipo cadena de texto.',
                'email.max'      => 'Máximo 255 caracteres',

                'password.required' => 'El autor es obligatorio.',
                'password.string'   => 'Debe ser de tipo cadena de texto.',
                'password.max'      => 'Máximo 255 caracteres',
            ]);

            $user = empty($request->id)? new User() : User::find($request->id);
            $user->name           = $request->name;
            $user->email          = $request->email;
            $user->password       = $request->password;
            $roles = Role::all()->pluck('name');
            $user->syncRoles();
            foreach($roles as $rol){
                if($request->$rol){
                    $user->assignRole($rol);
                }
            }
            $user->save();


            $salida = redirect()->route('users.alta')->with([
                    'success'  => 'Libro insertado correctamente.'
                    ,'formData' => $user
                ]
            );

        }

        return $salida;
    }
}
