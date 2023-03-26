<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }

        $categories = Categoria::all();

        return view('veureCategories', ['categories' => $categories]);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }

        $categories = Categoria::all();

        return view('crearCategoria', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }

        $request->validate([
            "nom" => "required"
        ]);

        $categoria = new Categoria();

        $categoria->nom = $request->input("nom");

        $categoria->save();

        return redirect('/categoria/'.$categoria->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }

        $categoria = Categoria::find($id);

        $categories = Categoria::all();

        return view('veureCategoria', ['categoria' => $categoria, 'productes' => $categoria->productes, 'categories' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }

        $categoria = Categoria::find($id);

        $categories = Categoria::all();

        return view('editarCategoria', ['categoria' => $categoria, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            "nom" => "required"
        ]);

        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }

        $categoria = Categoria::find($id);
        $categoria->nom = $request->input("nom");

        $categoria->save();

        return redirect('/categoria/'.$categoria->id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }

        $categoria = Categoria::find($id);

        $categoria->delete();

        return redirect('/categoria');
    }

    public function veureProductes($id){

        $categories = Categoria::all();
        $categoria = Categoria::find($id);

        $productes = $categoria->productes;

        return view('veureProductesUsuari', ['categories' => $categories, 'productes' => $productes, 'categoria' => $categoria]);

    }
}
