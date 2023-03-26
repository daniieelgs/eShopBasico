@extends('layouts.layout')

@section('contenidor')
    
@if(!empty($cesta))

    <div class="modal fade" id="comprarModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add category</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="comprarCesta" action="/comprar" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="compte" class="form-label">Escogeix la teva compte bancaria:</label>
                        <select name="compte" id="compte" class="form-control @error('compte') is-invalid @enderror" aria-describedby="validationComptes" required>
                            <option selected disabled>Escogeix una compte bancaria</option>
                            @foreach ($comptes as $compte)
                                <option value="{{$compte->id}}">{{$compte->numero}}</option>
                            @endforeach

                        </select>

                        <div class="invalid-feedback" id="validationCompte">
                            Camp obligatori.
                        </div>
                        <button type="button" class="btn btn-link" style="width: max-content" onclick="window.location.href='/compte'">Gestionar comptes</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <h4 style="text-align: center; width: 100%;">Total a pagar: @php
    
                    $total = 0;
            
                    if(!empty($cesta)){
            
                        foreach ($cesta as $item) {
                            $total += $item['producte']->preu * $item['quantitat'];
                        }
            
                    }
            
                    echo $total;
            
                @endphp€
                </h4>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tancar</button>
            <button type="submit" class="btn btn-success" form="comprarCesta">Comprar</button>
            </div>
        </div>
        </div>
    </div>

@endif

<div style="display: flex; justify-content: center; align-items: center; flex-direction: column">
    <h1 style="text-align: center">Cistella de la compra</h1>

    <div style="display: flex; flex-direction: column; gap: 30px; width: 80%; margin: auto; justify-content: center; align-items: center;">
        
        @forelse ($cesta as $item)
            
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="{{$item['producte']->imatge}}" class="img-fluid rounded-start" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                    <div style="display: flex; align-items: center; justify-content: space-between">
                        <h5 class="card-title"><a href="/producte/{{$item['producte']->id}}/veure" style="color: black">{{$item['producte']->nom}}</a></h5>

                        <form action="/producte/{{$item['producte']->id}}/cesta" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link" style="width: max-content">Eliminar</button>
                        </form>
                    </div>
                  <p class="card-text"><span style="font-weight: 600">Total: </span>{{$item['producte']->preu * $item['quantitat']}}€</p>

                  <form action="/producte/{{$item['producte']->id}}/cesta" method="POST" style="display: flex; flex-direction: column">

                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                      <label for="quantitat" class="col-sm-2 col-form-label" style="width: max-content">Quantitat:</label>
                      <div class="col-sm-10">
                        <input type="number" min="1" class="form-control @error('quantitat') is-invalid @enderror" value="{{$item['quantitat']}}" id="quantitat" name="quantitat" aria-describedby="validationQuantitat" style="width: 100px">
                        
                        <div id="validationQuantitat" class="invalid-feedback">
                            Mínim 1 producte.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-link" style="width: max-content">Actualitzar</button>

                    </div>
        
                </form>

                </div>
              </div>
            </div>
          </div>

        @empty
            
            <div class="alert alert-info" role="alert">
                ¡No hi han productes al carret!
            </div>

        @endforelse
    
    </div>

    <h2>Total: @php
    
        $total = 0;

        if(!empty($cesta)){

            foreach ($cesta as $item) {
                $total += $item['producte']->preu * $item['quantitat'];
            }

        }

        echo $total;

    @endphp€
    </h2>

    <div style="display: flex; justify-content: center; width: 100%">
        <button type="submit" class="btn btn-warning" @if(empty($cesta)) disabled @endif data-bs-toggle="modal" data-bs-target="#comprarModal">Comprar</button>
    </div>
</div>

@endsection

@section('js')
    
    @error('compte')
        <script>
            const modal = new bootstrap.Modal('#comprarModal');
            modal.show();

            
        </script>
    @enderror

@endsection