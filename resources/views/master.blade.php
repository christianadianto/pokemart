<!DOCTYPE html>
<html>
<head>
    <title>PokeMart</title>
    <link rel="icon" href="{{asset('assets/logo.png')}}">
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" href="{{asset('css/bootstrap-grid.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-reboot.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="{{asset('js/tether.min.js')}}"></script>
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/generate-pokemon.js')}}"></script>
</head>
<body>
    <nav class="navbar navbar-toggleable-md navbar-inverse bg-nav">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="/"><img src="{{asset('assets/logo.png')}}" width="20" alt="PokeMart">
            <span>PokeMart</span>
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Register</a>
                </li>
                <li class="nav-item-user">
                    <span class="username"></span>
                </li>
                <li class="nav-item-user">
                    <a class="nav-link" href="/profile">Profile</a>
                </li>
                <li class="nav-item-user">
                    <a class="nav-link" href="/pokemon">Pokemon</a>
                </li>
                <li class="nav-item-user">
                    <a class="nav-link" href="/cart">Your Cart</a>
                </li>
                <li class="nav-item-user">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="bg-image container">
        <div class="row">
            <div class="col-6 pl-5">
                <img src="{{asset('assets/pikachu.png')}}" width="460" alt="">
            </div>
            @yield('content_here')
        </div>
    </div>
    <footer class="footer bg-nav text-white">
        <div class="container footer-font-size">
            PokeMart established 2017, powered by Pokemon Company
            <br>
            Copyright &copy; 2017. All Rights Reserved
            <div class="icon-size">
                <i class="fa fa-facebook-square"></i>
                <i class="fa fa-google-plus-square"></i>
                <i class="fa fa-twitter-square"></i>
                <i class="fa fa-github-square"></i>
                <i class="fa fa-instagram"></i>
            </div>
        </div>
    </footer>

    <script>
        $(document).ready(function() {
            var request = $.get('/checkUser');
            request.done(function(response) {
               if(response.check){
                   $('.nav-item').hide();
                   $('.nav-item-user').show();
                   $('.username').text(response.user.email);
               }
               else{
                   $('.nav-item').show();
                   $('.nav-item-user').hide();
               }
            });
        });
    </script>
</body>
</html>
