@extends('layouts.layout')

@section('contenidor')


<table class="table table-dark table-hover" style="width: 90%; margin: 30px auto; border-radius: 30px; border: 1px solid white;">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
            <th scope="col">Productes</th>
            <th scope="col"><button type="button" class="btn btn-success" onclick="window.location.href = '/categoria/create'">Crear</button></th>
        </tr>
    </thead>
    <tbody>

        @forelse ($categories as $categoria)       
            <tr>
                <th scope="row">{{$categoria->id}}</th>
                <td>{{$categoria->nom}}</td>
                <td>{{count($categoria->productes)}}</td>
                <td>
                    <div style="display: flex; justify-content: space-between;">
                        <button type="button" class="btn btn-primary" onclick="window.location.href='/categoria/{{$categoria->id}}'">Veure</button>
                        <button type="button" class="btn btn-warning" onclick="window.location.href='/categoria/{{$categoria->id}}/edit'">Editar</button>
                        <form action="/categoria/{{$categoria->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <div class="alert alert-info" role="alert">
                ¡No hi han categories per mostrar!
            </div>
        @endforelse

    </tbody>

</table>
@endsection