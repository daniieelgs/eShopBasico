@extends('layouts.layout') 

@section('contenidor')

//Creamos los elementis 
<table class="table table-dark table-hover" style="width: 90%; margin: 30px auto; border-radius: 30px; border: 1px solid white;"> 
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Admin</th>
            <th scope="col"><button type="button" class="btn btn-success" onclick="window.location.href = '/usuari/create'">Crear</button></th>
        </tr>
    </thead>
    <tbody>

        @forelse ($usuaris as $usuari)       
            <tr>
                <th scope="row">{{$usuari->id}}</th>
                <td>{{$usuari->name}}</td>
                <td>{{$usuari->email}}</td>
                <td><input type="checkbox" @if($usuari->admin) checked @endif></td>
                <td>
                    <div style="display: flex; justify-content: space-between;">
                        <button type="button" class="btn btn-warning" onclick="window.location.href='/usuari/{{$usuari->id}}/edit'">Editar</button>
                        <form action="/usuari/{{$usuari->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <div class="alert alert-info" role="alert">
                ¡No hi han més usuaris per mostrar!
            </div>
        @endforelse

    </tbody>

</table>
@endsection

@section('js')
    <script>
        document.querySelectorAll('input[type="checkbox"]').forEach(n => n.addEventListener('click', e => {
            e.stopPropagation();
            e.preventDefault();
        }));
    </script>
@endsection