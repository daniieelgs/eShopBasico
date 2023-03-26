<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Opinio;
use App\Models\Producte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProducteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }

        $productes = Producte::all();

        $categories = Categoria::all();

        return view('veureProductes', ['productes' => $productes, 'categories' => $categories]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $req)
    {
        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }

        $categoria_id = $req->input("categoria_id");

        $categories = Categoria::all();

        $categoria_seleccionada = null;

        if($categoria_id != null){
            $categoria_seleccionada = Categoria::find($categoria_id);
        }

        return view('crearProducte', ['categories' => $categories, 'categoria_seleccionada' => $categoria_seleccionada]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            "nom" => "required",
            "descripcio" => "required",
            "imatge" => "required",
            "preu" => "required|numeric|min:0",
            "categoria_id" => "required|numeric",
        ]);

        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }

        $producte = new Producte();

        $id = (Producte::max('id') ?? 0) + 1;

        $img_nom = $id.'-'.$request->file('imatge')->getClientOriginalName();

        $request->file('imatge')->storeAs('imatges', $img_nom, 'public');

        $producte->nom = $request->input("nom");
        $producte->descripcio = $request->input("descripcio");
        $producte->imatge = '/storage/imatges/'.$img_nom;
        $producte->preu = $request->input("preu");
        $producte->categoria_id = $request->input("categoria_id");

        $producte->save();

        return redirect('/producte/'.$producte->id);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }

        $producte = Producte::find($id);

        $categories = Categoria::all();

        return view('veureProducte', ['producte' => $producte, 'categories' => $categories]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }

        $producte = Producte::find($id);

        $categories = Categoria::all();

        $categories = Categoria::all();

        return view('editarProducte', ['producte' => $producte,'categories' => $categories, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            "nom" => "required",
            "descripcio" => "required",
            "imatge" => "required",
            "preu" => "required|numeric|min:0",
            "categoria_id" => "required|numeric",
        ]);

        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }

        $producte = Producte::find($id);

        Storage::disk('public')->delete($producte->imatge);

        $id = $producte->id;

        $img_nom = $id.'-'.$request->file('imatge')->getClientOriginalName();

        $request->file('imatge')->storeAs('imatges', $img_nom, 'public');

        $producte->nom = $request->input("nom");
        $producte->descripcio = $request->input("descripcio");
        $producte->imatge = '/storage/imatges/'.$img_nom;
        $producte->preu = $request->input("preu");
        $producte->categoria_id = $request->input("categoria_id");

        $producte->save();

        return redirect('/producte/'.$producte->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if(!Auth::check() || !Auth::user()->admin ){
            return back();
        }

        $producte = Producte::find($id);

        $producte->delete();

        return redirect('/producte');
    }

    public function veureTots(){

        $categories = Categoria::all();
        $productes = Producte::all();

        return view('veureProductesUsuari', ['categories' => $categories, 'productes' => $productes]);

    }

    public function veure($id = 0){
        $categories = Categoria::all();
        $producte = Producte::find($id);

        $opinions = $producte->opinions;

        
        return view('veureProducteUsuari', ['categories' => $categories, 'producte' => $producte, 'opinions' => $opinions]);
    }

    public function veureCesta(){

        $cesta = [];

        if(session()->has('cesta')){

            $cesta = session('cesta');

            foreach($cesta as $key => $item){
                $item['producte'] = Producte::find($key);
                $cesta[$key] = $item;
            }

            session()->put('cesta', $cesta);
        }

        $categories = Categoria::all();

        $comptes = Auth::user()->comptes;

        return view('veureCesta', ['categories' => $categories, 'cesta' => $cesta, 'comptes' => $comptes]);

    }

    public function afegirCesta(Request $request, $id){

        $request->validate([
            "quantitat" => 'required|numeric|min:1'
        ]);

        $cesta = [];

        if(session()->has('cesta')){

            $cesta = session('cesta');

        }

        
        if(array_key_exists($id, $cesta)){

            $cesta[$id]["quantitat"] += $request->input('quantitat');

        }else{

            $cesta[$id] = ["quantitat" => $request->input('quantitat'), "producte" => Producte::find($id)];

        }       

        session()->put('cesta', $cesta);

        return redirect('/producte/cesta');

    }

    public function actualitzarCesta(Request $request, $id){

        $request->validate([
            "quantitat" => 'required|numeric|min:1'
        ]);

        $cesta = session('cesta');

        $cesta[$id]["quantitat"] = $request->input('quantitat');

        session()->put('cesta', $cesta);

        return redirect('/producte/cesta');
    }

    public function treureCesta($id){

        $cesta = session('cesta');

        unset($cesta[$id]);

        session()->put('cesta', $cesta);

        return redirect('/producte/cesta');

    }

    public function comprarCesta(Request $request){

        $request->validate([
            "compte" => 'required'
        ]);

        Session::forget('cesta');

        return redirect('/producte/tots')->with('alerta', "La teva compra s'ha realitzat amb exit");

    }

    public function afegirOpinio(Request $request, $id){

        $request->validate([
            "estrellas" => "required|numeric|min:1|max:5",
            "opinio" => "required"
        ]);

        $opinio = new Opinio();

        $opinio->estrellas = $request->input('estrellas');
        $opinio->opinio = $request->input('opinio');
        $opinio->user_id = Auth::user()->id;
        $opinio->producte_id = $id;

        $opinio->save();

        return redirect('/producte/'.$id.'/veure');
    }
}
