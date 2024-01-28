<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}}</title>    
    <link rel="shortcut icon" href="{{asset('assets/logo.png')}}" type="image/x-icon">     
    <link rel="stylesheet" href="{{asset('assets/compiled/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/compiled/css/app-dark.css')}}">
    <link rel="stylesheet" href="{{asset('assets/compiled/css/auth.css')}}">

    <style>
        #auth {                          
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.dev/svgjs' width='1440' height='560' preserveAspectRatio='none' viewBox='0 0 1440 560'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1202%26quot%3b)' fill='none'%3e%3crect width='1440' height='560' x='0' y='0' fill='rgba(255%2c 201%2c 40%2c 1)'%3e%3c/rect%3e%3cpath d='M0%2c631.671C114.314%2c610.135%2c181.088%2c496.931%2c278.358%2c433.134C374.404%2c370.14%2c506.103%2c356.197%2c567.762%2c259.288C631.59%2c158.97%2c646.962%2c25.255%2c609.719%2c-87.664C574.152%2c-195.5%2c447.382%2c-237.451%2c375.054%2c-324.986C300.225%2c-415.548%2c280.465%2c-550.162%2c178.854%2c-609.12C68.911%2c-672.913%2c-76.908%2c-707.896%2c-192.043%2c-654.037C-306.753%2c-600.376%2c-314.792%2c-440.203%2c-393.805%2c-341.234C-468.25%2c-247.986%2c-621.668%2c-209.912%2c-640.66%2c-92.113C-659.62%2c25.491%2c-532.749%2c112.349%2c-484.491%2c221.259C-435.479%2c331.871%2c-447.361%2c474.264%2c-355.046%2c552.463C-260.609%2c632.46%2c-121.625%2c654.584%2c0%2c631.671' fill='%23e3aa00'%3e%3c/path%3e%3cpath d='M1440 994.294C1524.603 988.5029999999999 1604.095 969.425 1682.747 937.721 1777.656 899.4639999999999 1886.775 874.745 1945.124 790.682 2006.483 702.282 2027.4679999999998 583.632 2000.9009999999998 479.355 1975.1599999999999 378.323 1888.963 305.836 1805.632 243.178 1734.257 189.51 1648.834 163.675 1560.838 148.464 1480.83 134.63400000000001 1402.027 143.539 1322.448 159.656 1235.949 177.17399999999998 1140.692 184.21699999999998 1077.931 246.265 1013.722 309.745 995.558 404.887 983.845 494.415 972.245 583.075 978.0830000000001 672.766 1011.267 755.796 1045.5529999999999 841.582 1094.18 927.573 1174.913 972.4839999999999 1253.994 1016.476 1349.717 1000.4739999999999 1440 994.294' fill='%23ffda6c'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1202'%3e%3crect width='1440' height='560' fill='white'%3e%3c/rect%3e%3c/mask%3e%3c/defs%3e%3c/svg%3e");
            background-size: cover;
        }
    </style>
</head>

<body>
    <div id="auth">       
        <div class="row justify-content-center">
            <div class="col-md-4 col-sm-12">
                <div class="mt-5 mx-5 card card-body shadow-sm">
                    <img src="{{asset('assets/logo.png')}}" class="w-25 mx-auto">                                     
                    <p class="auth-title text-center h1">SIP Banged</p> 
                    <br>
                    <p class="auth-subtitle mb-3 text-justify">Log in with your data that you entered during registration.</p>

                    @if(session('error'))
                    <div class="alert alert-danger" id="timeoutAlert" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('info'))
                    <div class="alert alert-success" id="timeoutAlert" role="alert">
                            {{ session('info') }}
                        </div>
                    @endif

                    <form action="{{route('sign')}}" method="post">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl" value="{{old('email')}}" name="email" placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            @error('email')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>           
                        <p>Belum punya akun ?
                            <a href="{{route('daftar')}}" class="badge bg-dark rounded-pill">Daftar</a>
                        </p>   
                        <button class="btn btn-warning fw-bold rounded-pill btn-block shadow-lg mt-3">Log in</button>
                    </form>
                </div>
            </div>   
        </div>
    </div>

        
@if(session('error'))
    <script>    
        var timeoutAlert = document.getElementById('timeoutAlert');    
        setTimeout(function() {
            timeoutAlert.style.display = 'none';
        }, 3000); 
    </script>
@endif

@if(session('info'))
    <script>    
        var timeoutAlert = document.getElementById('timeoutAlert');    
        setTimeout(function() {
            timeoutAlert.style.display = 'none';
        }, 3000); 
    </script>
@endif

</body>
</html>