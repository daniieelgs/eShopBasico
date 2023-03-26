<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tienda Mariama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
                </a>
        
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" style="display: flex; justify-content: center; align-items: center; gap: 10px; width: max-content; margin: 0!important">
                    <li><a href="/" class="nav-link px-2 @if(request()->path() == "/") text-secondary @else text-white @endif">Inici</a></li>
                    
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <strong>@if(isset($categoria)){{$categoria->nom}} | @endif Categories</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            @foreach ($categories as $categoria)
                                <li><a class="dropdown-item" href="/categoria/{{$categoria->id}}/productes">{{$categoria->nom}}</a></li>
                            @endforeach
                            @if(Auth::check() && Auth::user()->admin)
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/categoria">Editar</a></li>
                            @endif
                        </ul>
                    </div>

                    @if(Auth::check() && Auth::user()->admin)
                        <li><a href="/producte" class="nav-link px-2 @if(strpos(request()->path(), 'producte') === 0)) text-secondary @else text-white @endif">Productes</a></li>
                    @endif
                </ul>

                <h1 class="justify-content-center" style="margin: auto">Coffe Shop</h1>
        
                @if(Auth::check())
                    <div class="text-end">
                        <button type="button" class="btn btn-outline-light me-2" onclick="window.location.href = '/dashboard'">{{Auth::user()->name}}</button>
                        @if(Auth::user()->admin)
                            <div class="dropdown" style="display: inline-block">
                                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <strong>Gestionar</strong>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                    <li><a class="dropdown-item" href="/compte">Gestionar comptes</a></li>
                                    <li><a class="dropdown-item" href="/usuari">Gestionar usuaris</a></li>
                                </ul>
                            </div>
                        @else
                            <button type="button" class="btn btn-dark me-2" style="text-decoration: underline" onclick="window.location.href = '/compte'">Gestionar comptes</button>
                        @endif
                        <button type="button" class="btn btn-dark me-2" style="text-decoration: underline" onclick="window.location.href = '/producte/cesta'">Cesta @if(session('cesta') && !empty(session('cesta')))({{count(session('cesta'))}})@endif</button>
                    </div>
                @else
                    <div class="text-end">
                        <button type="button" class="btn btn-outline-light me-2" onclick="window.location.href = '/login'">Login</button>
                        <button type="button" class="btn btn-warning" onclick="window.location.href = '/register'">Sign-up</button>
                    </div>
                @endif


            </div>
        </div>
    </header>

    @if(session('alerta'))
        <div class="alert alert-success" role="alert">
            {{Session::pull('alerta')}}
        </div>
    @endif
      
    <div>
        @yield('contenidor')
    </div>

    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
          <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
            <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
          </a>
          <span class="mb-3 mb-md-0 text-muted">© by Mariama Tamba</span>
        </div>
    
        <a href="#" style="margin-right: 40px">Tornar amunt</a>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    @yield('js')

</body>
</html>