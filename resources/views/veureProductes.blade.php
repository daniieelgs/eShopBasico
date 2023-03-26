@extends('layouts.layout')

@section('contenidor')


<table class="table table-dark table-hover" style="width: 90%; margin: 30px auto; border-radius: 30px; border: 1px solid white;">

    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
            <th scope="col">Descripció</th>
            <th scope="col">Imatge</th>
            <th scope="col">Preu</th>
            <th scope="col">Categoria</th>
            <th scope="col"><button type="button" class="btn btn-success" onclick="window.location.href = '/producte/create'">Crear</button></th>
        </tr>
    </thead>
    <tbody>

        @forelse ($productes as $producte)       
            <tr>
                <th scope="row">{{$producte->id}}</th>
                <td>{{$producte->nom}}</td>
                <td style="max-width: 30vw; overflow: hidden; white-space: nowrap; text-overflow: ellipsis">{{$producte->descripcio}}</td>
                <td><img src="{{$producte->imatge}}" width="40px"; height="40px;" style="object-fit: cover"/></td>
                <td>{{$producte->preu}}€</td>
                <td><a href="/categoria/{{$producte->categoria->id}}">{{$producte->categoria->nom}}</a></td>
                <td>
                    <div style="display: flex; justify-content: space-between;">
                        <button type="button" class="btn btn-primary" onclick="window.location.href='/producte/{{$producte->id}}'">Veure</button>
                        <button type="button" class="btn btn-warning" onclick="window.location.href='/producte/{{$producte->id}}/edit'">Editar</button>
                        <form action="/producte/{{$producte->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <div class="alert alert-info" role="alert">
                ¡No hi han productes per mostrar!
            </div>
        @endforelse

    </tbody>

</table>
@endsection