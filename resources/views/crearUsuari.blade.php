@extends('layouts.layout')

@section('contenidor')
    
    <form action="/usuari" method="POST" style="width: 50%; margin: 50px auto; border: 1px solid green; border-radius: 30px; padding: 20px;">

        @csrf

        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder=" " id="name" name="name" aria-describedby="validationNom">
            <label for="name" class="form-label">Nom</label>
            <div id="validationNom" class="invalid-feedback">
              Camp obligatori.
            </div>
        </div>

        <div class="form-floating mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder=" " id="email" name="email" aria-describedby="validationEmail">
            <label for="email" class="form-label">Email</label>
            <div id="validationEmail" class="invalid-feedback">
              Camp obligatori.
            </div>
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" minlength="8" placeholder=" " id="password" name="password" aria-describedby="validationPassword">
            <label for="password" class="form-label">Contrasenya</label>
            <div id="validationPassword" class="invalid-feedback">
              Camp obligatori.
            </div>
        </div>


        <div class="mb-3">
            <label for="admin" class="form-label">Admin</label>
            <input type="checkbox" class="@error('admin') is-invalid @enderror" @if(old('admin')) checked @endif placeholder=" " id="admin" name="admin" aria-describedby="validationAdmin">
            <div id="validationAdmin" class="invalid-feedback">
              Camp obligatori.
            </div>
        </div>


        <div style="display: flex; justify-content: center; width: 100%; margin-top: 15px;">
            <button type="submit" class="btn btn-success">Crear</button>
        </div>
    </form>

@endsection