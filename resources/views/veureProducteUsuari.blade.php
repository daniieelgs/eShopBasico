@extends('layouts.layout')

@section('contenidor')
    <div style="display: flex; margin-top: 30px; padding: 20px; justify-content: space-between">

        <img src="{{ $producte->imatge }}" style="width: 25%; height: 300px; object-fit: contain;" />

        <div style="width: 60%;">

            <h1>{{ $producte->nom }}</h1>

            <h4>Preu: {{ $producte->preu }}€</h4>

            <div style="text-align: center">

                <h5>Descripció</h5>

                <p>
                    {{ $producte->descripcio }}
                </p>

            </div>

            <h6>Catgeoria: <a href="/categoria/{{ $producte->categoria->id }}/productes">{{ $producte->categoria->nom }}</a>
            </h6>

            <form action="/producte/{{ $producte->id }}/cesta" method="POST">

                @csrf

                <div class="row mb-3">
                    <label for="quantitat" class="col-sm-2 col-form-label" style="width: max-content">Quantitat:</label>
                    <div class="col-sm-10">
                        <input type="number" min="1" value="1"
                            class="form-control @error('quantitat') is-invalid @enderror" id="quantitat" name="quantitat"
                            aria-describedby="validationQuantitat" style="width: 100px">

                        <div id="validationQuantitat" class="invalid-feedback">
                            Mínim 1 producte.
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: center; width: 100%">
                    <button type="submit" class="btn btn-warning">Afegir al carret</button>
                </div>

            </form>

        </div>

    </div>

    <div style="margin-left: 30px">

        <form action="/producte/{{ $producte->id }}/opinio" method="POST">

            @csrf

            <div class="row mb-3">
                <label for="estrellas" class="col-sm-2 col-form-label" style="width: max-content">Estrellas:</label>
                <div class="col-sm-10">
                    <input type="number" min="1" value="1" max="5"
                        class="form-control @error('estrellas') is-invalid @enderror" id="estrellas" name="estrellas"
                        aria-describedby="validationEstrellas" style="width: 100px">

                    <div id="validationEstrellas" class="invalid-feedback">
                        Mínim 1 estrella.
                        Màxim 5 estrelles.
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="opinio" class="col-sm-2 col-form-label" style="width: max-content">Opinió:</label>
                <div class="col-sm-10">
                    <textarea
                        class="form-control @error('opinio') is-invalid @enderror" id="opinio" name="opinio"
                        aria-describedby="validationOpinio" style="max-width: 200px; height: 100px;"></textarea>

                    <div id="validationOpinio" class="invalid-feedback">
                        Camp obligatori.
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-warning">Publicar</button>


        </form>

        <div>

            @foreach ($opinions as $opinio)
                
                <div style="width: max-content; max-width: 50%; padding: 10px; margin: 10px; border: 1px solid #ffc107; border-radius: 10px;">

                    <h5>{{$opinio->user->name}}</h5>
                    <span style="font-size: 1.2rem; font-weight: bold;">{{$opinio->estrellas}} estrellas</span>

                    <p>{{$opinio->opinio}}</p>
                </div>

            @endforeach

        </div>

    </div>
@endsection
