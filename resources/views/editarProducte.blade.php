@extends('layouts.layout')

@section('contenidor')
    
    <form action="/producte/{{$producte->id}}" method="POST" style="width: 50%; margin: 50px auto; border: 1px solid green; border-radius: 30px; padding: 20px;" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('nom') is-invalid @enderror" @error('nom') value="{{old('nom')}}" @enderror value="{{$producte->nom}}" placeholder=" " id="nom" name="nom" aria-describedby="validationNom">
            <label for="nom" class="form-label">Nom producte</label>
            <div id="validationNom" class="invalid-feedback">
              Camp obligatori.
            </div>
        </div>

        <div class="mb-3">
            <label for="descripcio" class="form-label">Descripció</label>
            <textarea  class="form-control @error('descripcio') is-invalid @enderror" id="descripcio" name="descripcio" aria-describedby="validationdescripcio">@if(empty(old('descripcio'))){{$producte->descripcio}}@else{{old('descripcio')}}@endif</textarea>
            <div id="validationDescripcio" class="invalid-feedback">
              Camp obligatori.
            </div>
        </div>

        <div class="mb-3">
            <label for="imatge" class="form-label">Imatge</label>
            <input type="file" class="form-control @error('imatge') is-invalid @enderror" @error('imatge') value="{{old('imatge')}}" @enderror value="{{$producte->imatge}}" placeholder=" " id="imatge" name="imatge" aria-describedby="validationImatge">
            <div id="validationImatge" class="invalid-feedback">
              Camp obligatori.
            </div>
        </div>

        <div class="form-floating mb-3">
            <input type="number" step="0.01" min="0.01" class="form-control @error('preu') is-invalid @enderror" @error('preu') value="{{old('preu')}}" @enderror value="{{$producte->preu}}" placeholder=" " id="preu" name="preu" aria-describedby="validationPreu">
            <label for="preu" class="form-label">Preu</label>
            <div id="validationPreu" class="invalid-feedback">
              Camp obligatori.
            </div>
        </div>


        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoria</label>

            <select class="form-select @error('categoria_id') is-invalid @enderror" size="3" aria-label="size 3 select example" id="categoria_id" name="categoria_id" aria-describedby="validationCategoria">
                @forelse ($categories as $categoria)
                    <option value="{{$categoria->id}}" 
                        @if(empty(old('categoria_id')) && $producte->categoria->id == $categoria->id) 
                            selected
                        @elseif(!empty(old('categoria_id')) && old('categoria_id') == $categoria->id) 
                            selected 
                        @endif>{{$categoria->nom}}</option>
                @empty
                    <option selected>No hi han categories disponibles</option>
                @endforelse
            </select>
            
            <div id="validationCategoria" class="invalid-feedback">
              Camp obligatori.
            </div>
        </div>



        <div style="display: flex; justify-content: center; width: 100%; margin-top: 15px;">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>

@endsection