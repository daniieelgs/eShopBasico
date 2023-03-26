<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Si el usuario no está autenticado o no es un administrador, redirecciona al usuario a la página anterior.
        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }

        //Obtener todas las categorias y usuarios 
        $categories = Categoria::all();
        $usuaris = User::all();

         // Renderizar la vista "veureUsuaris" con los datos obtenidos.
        return view('veureUsuaris', ['categories' => $categories, 'usuaris' => $usuaris]);    

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    // Si el usuario no está autenticado o no es un administrador, redirecciona al usuario a la página anterior.
        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }
        // Obtener todas las categorías y renderizar la vista "crearUsuari" con los datos obtenidos.
        $categories = Categoria::all();
        return view('crearUsuari', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     // Validar los campos requeridos del formulario de creación de usuario.
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'admin' => 'required'
        ]);

     // Si el usuario no está autenticado o no es un administrador, redirecciona al usuario a la página anterior.
        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }
    
        // Crear un nuevo usuario con los datos del formulario.
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'admin' => $request->input('admin') ? 1 : 0
        ]);

        // Redireccionar a la página de usuarios.
        return redirect('/usuari');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }

        $categories = Categoria::all();

        $usuari = User::find($id);

        return view('editarUsuari', ['categories' => $categories, 'usuari' => $usuari]);    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'admin' => 'required'
        ]);

        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }

        $usuari = User::find($id);

        $usuari->name = $request->input('name');
        $usuari->email = $request->input('email');
        $usuari->admin = $request->input('admin') ? 1 : 0;
        $usuari->save();

        return redirect('/usuari');
    }

    public function update_pass(Request $request, $id)
    {

        $request->validate([
            'password' => 'required|string|min:8',
        ]);

        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }

        $usuari = User::find($id);

        $usuari->password = Hash::make($request->password);
        $usuari->save();

        return redirect('/usuari');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuari = User::find($id);

        $usuari->delete();

        return redirect('/usuari');
    }
}
