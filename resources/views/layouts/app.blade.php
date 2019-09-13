<html>
    <head> 
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
            <script type="text/javascript" src="{{ URL::asset('js/main.js') }}"></script>
            <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}" />
            <meta name="viewport" content="width=device-width, user-scalable=no">
        <title>@yield('title')</title>
    </head>
    <body>
       <header> 
            <img src="/img/logo-exito.png" alt="" class="logo">            
            <h2 class="header">¡Ahora la promo la puedes escoger tú!</h2>
       </header>
        <div class="container">
            @yield('content')
        </div>
        <footer>  
            <div class="contentFooter">
                <p>2019 Éxito @ marca registrada de Grupo Éxito</p>
                <p><a href="" class="show_terms">Ver términos y condiciones</a></p>
            </div>            
        </footer>
    </body>
</html>