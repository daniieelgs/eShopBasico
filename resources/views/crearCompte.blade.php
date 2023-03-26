@extends('layouts.layout')

@section('contenidor')
    
    <form action="/compte" method="POST" style="width: 50%; margin: 50px auto; border: 1px solid green; border-radius: 30px; padding: 20px;">

        @csrf

        <div class="form-floating">
            <input type="text" class="form-control @error('compte') is-invalid @enderror" placeholder=" " id="compte" name="compte" aria-describedby="validationCompte">
            <label for="compte" class="form-label">Número de compte</label>
            <div id="validationCompte" class="invalid-feedback">
              Camp obligatori.
            </div>
        </div>

        <div style="display: flex; justify-content: center; width: 100%; margin-top: 15px;">
            <button type="submit" class="btn btn-success">Crear</button>
        </div>
    </form>

@endsection