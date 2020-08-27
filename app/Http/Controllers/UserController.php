<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $usuarios = User::all();

        return view('usuarios.index', ['usuarios' => $usuarios]);
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users',
            'password' => 'required|min:8'
        ]);


        $request->password = bcrypt($request->password);
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        if ($usuario->save()) {
            return redirect()->route('usuario.index');
        }
    }
    public function edit(User $usuario){
        return view('usuarios.edit', ['usuario' => $usuario]);
    }

    public function update(Request $request, User $usuario){
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
        ]);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        if ($request->password == null ) {

        }else{
            $usuario->password = bcrypt($request->password);
        }
        if ($usuario->update()) {
            return redirect()->route('usuario.index');
        }
    }
    public function destroy(User $usuario){
        if ($usuario->delete()) {
            return redirect()->route('usuario.index');
        }
    }
}
