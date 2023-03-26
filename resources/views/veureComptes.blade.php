@extends('layouts.layout')

@section('contenidor')


<table class="table table-secondary table-striped" style="width: 90%; margin: 30px auto; border-radius: 30px; border: 1px solid white;">

    <thead>
        <tr>
            <th scope="col">Número de compte</th>
            <th scope="col"><button type="button" class="btn btn-success" onclick="window.location.href = '/compte/create'">Afegir</button></th>
        </tr>
    </thead>
    <tbody>

        @forelse ($comptes as $compte)
            
            <tr>
                <td>{{$compte->numero}}</td>
                <td>
                    <div style="display: flex; justify-content: space-between;">
                        <button type="button" class="btn btn-warning" onclick="window.location.href='/compte/{{$compte->id}}/edit'">Editar</button>
                        <form action="/compte/{{$compte->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>

        @empty
            <div class="alert alert-info" role="alert">
                ¡No hi han comptes guardats!
            </div>
        @endforelse

    </tbody>

</table>
    
@endsection