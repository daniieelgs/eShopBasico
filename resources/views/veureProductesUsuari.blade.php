@extends('layouts.layout')

@section('contenidor')
    
<div class="album py-5 bg-light">
    <div class="container">

        <div style="width: max-content; margin: auto">
            @if(isset($categoria))
                <h1>{{$categoria->nom}}</h1>
            @else
                <h1>Tots els productes</h1>
            @endif
        </div>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        @forelse ($productes as $producte)
            
            <div class="col">
                <div class="card shadow-sm">
                    <img src="{{$producte->imatge}}" width="100%" height="225" style="object-fit: contain"/>
                
                    <div class="card-body">
                        <h3>{{$producte->nom}}</h3>
                        <p class="card-text" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                            {{$producte->descripcio}}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.location.href='/producte/{{$producte->id}}/veure'">View</button>
                                @if(Auth::check() && Auth::user()->admin)
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.location.href='/producte/{{$producte->id}}/edit'">Edit</button>
                                @endif
                            </div>
                            <h4 class="text-muted">{{$producte->preu}}€</h4>
                        </div>
                    </div>
                </div>
            </div>

        @empty
            
            <div class="alert alert-info" role="alert" style="margin: 50px auto">
                ¡No hi han productes per mostrar!
            </div>

        @endforelse



      </div>
    </div>
  </div>

@endsection