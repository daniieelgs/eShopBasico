@extends('layouts.layout')

@section('contenidor')
    
<a href="/categoria" style="margin: 10px;">Vuere totes les categories</a>
<table class="table table-dark table-hover" style="width: 90%; margin: 30px auto; border-radius: 30px; border: 1px solid white;">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
            <th scope="col">Productes</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>


        <tr>
            <th scope="row">{{$categoria->id}}</th>
            <td>{{$categoria->nom}}</td>
            <td>{{count($categoria->productes)}}</td>
            <td>
                <div style="display: flex; justify-content: space-between;">
                    <button type="button" class="btn btn-primary" onclick="window.location.href='/categoria/{{$categoria->id}}/productes'">Veure com usuari</button>
                    <button type="button" class="btn btn-warning" onclick="window.location.href='/categoria/{{$categoria->id}}/edit'">Editar</button>
                    <form action="/categoria/{{$categoria->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </td>
        </tr>

    </tbody>



    <div>
        <table class="table table-dark table-hover" style="width: 90%; margin: 30px auto; border-radius: 30px; border: 1px solid white;">

            <h2 style="text-align: center">Productes</h2>

            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Descripció</th>
                    <th scope="col">Imatge</th>
                    <th scope="col">Preu</th>
                    <th scope="col">
                        <form action="/producte/create">
                            @csrf
                            <input type="hidden" name="categoria_id" id="categoria_id" value="{{$categoria->id}}">
                            <button type="submit" class="btn btn-success">Afegir</button>
                        </form>
                    </th>
                </tr>
            </thead>
            <tbody>

                @forelse ($productes as $producte)       
                    <tr>
                        <th scope="row">{{$producte->id}}</th>
                        <td>{{$producte->nom}}</td>
                        <td style="max-width: 30vw; overflow: hidden; white-space: nowrap; text-overflow: ellipsis">{{$producte->descripcio}}</td>
                        <td><img src="{{$producte->imatge}}" width="40px"; height="40px;"/></td>
                        <td>{{$producte->preu}}€</td>
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
    </div>

</table>

@endsection