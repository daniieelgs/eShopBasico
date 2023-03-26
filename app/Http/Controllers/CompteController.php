<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comptes = Auth::user()->comptes;
        $categories = Categoria::all();

        return view('veureComptes', ['comptes' => $comptes, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categoria::all();

        return view('crearCompte', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "compte" => 'required'
        ]);

        $compte = new Compte();

        $compte->numero = $request->input("compte");
        $compte->user_id = Auth::user()->id;

        $compte->save();

        return redirect('/compte');
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
        $categories = Categoria::all();

        $compte = Compte::find($id);

        return view('editarCompte', ['compte' => $compte, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            "compte" => 'required'
        ]);


        $compte = Compte::find($id);

        $compte->numero = $request->input("compte");

        $compte->save();

        return redirect('/compte');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $compte = Compte::find($id);

        $compte->delete();

        return redirect('/compte');
    }
}
