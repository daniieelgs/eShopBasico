@extends('layouts.layout')

@section('contenidor')

<a href="/producte" style="margin: 10px;">Vuere tots els productes</a>
<table class="table table-dark table-hover" style="width: 90%; margin: 30px auto; border-radius: 30px; border: 1px solid white;">

    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
            <th scope="col">Preu</th>
            <th scope="col">Categoria</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
  
        <tr>
            <th scope="row">{{$producte->id}}</th>
            <td>{{$producte->nom}}</td>
            <td>{{$producte->preu}}€</td>
            <td><a href="/categoria/{{$producte->categoria->id}}">{{$producte->categoria->nom}}</a></td>
            <td>
                <div style="display: flex; justify-content: space-between;">
                    <button type="button" class="btn btn-primary" onclick="window.location.href='/producte/{{$producte->id}}/veure'">Veure com usuari</button>
                    <button type="button" class="btn btn-warning" onclick="window.location.href='/producte/{{$producte->id}}/edit'">Editar</button>
                    <form action="/producte/{{$producte->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </td>
        </tr>

    </tbody>

</table>

<div style="display: flex; margin: auto; width: 90%">

    <div style="width: 25%; max-height: 300px; position: sticky; top: 80px;">
        <img src="{{$producte->imatge}}" style="width: 100%; object-fit: contain"/>
    </div>

    <div style="width: 75%; padding: 20px">
        <h3 style="text-align: center">Descripció</h3>

        <p style="margin: auto; text-align: center">
          {{$producte->descripcio}}
        </p>
    </div>

</div>
@endsection