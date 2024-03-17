<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password | {{ env('APP_NAME') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/auth.css') }}">

    <style>
        #bg {
            background: url('{{ asset('assets/bg.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        .vertical-center {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .round-left {
            border-top-left-radius: 0.75rem;
            border-bottom-left-radius: 0.75rem;
        }

        .round-right {
            border-top-right-radius: 0.75rem;
            border-bottom-right-radius: 0.75rem;
        }

        @media (min-width: 576px) {
            .pad {
                margin-left: 1rem;
                margin-right: 1rem;
            }
         }
    </style>
</head>

<body>
    <div id="bg">
        <div class="row justify-content-center vertical-center">
            <div class="col-md-6 col-lg-8 col-sm-12">
                <div class="mt-5">
                    <div class="row mx-3">
                        <div class="col-md-6 d-none d-md-block d-lg-block bg-dark opacity-75 round-left shadow">
                            <div class="pt-3 px-3">
                                <h5 class="my-3 text-white">Sistem Informasi Penyelenggaraan Bangunan Gedung</h5>
                                <br><br>
                                <span class="d-block text-white" style="height: 8rem">
                                Aplikasi penunjang proses penyelenggaraan bangunan Gedung sebagai aplikasi pendukung Sistem Informasi Bangunan Gedung (SIMBG) 
                                </span>
                                <h5 class="my-3 text-white">Dinas Pekerjaan Umum dan Penataan Ruang Kabupaten Tegal</h5>
                            </div>
                        </div>
                        <div class="col-md-6 bg-white round-right shadow">
                            <div class="p-3">
                                <div class="d-flex justify-content-between px-3 py-3">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Shield_of_Tegal_Regency.svg/1200px-Shield_of_Tegal_Regency.svg.png" style="height: 2.5rem; width:2.5rem;">
                                    <h2 class="my-auto">SIP BANGED                                
                                    </h2>
                                    <img src="{{ asset('assets/logo.png') }}" style="height: 2.5rem; width:2.5rem;">
                                </div>                                
                                <h6 class="px-3">Lupa Password</h6>                          
                                <form action="{{ route('forget') }}" method="post">
                                    @csrf
                                    <div class="form-group position-relative has-icon-left mb-4">
                                        <input type="email" class="form-control form-control-xl"
                                            value="{{ old('email') }}" name="email" placeholder="Email">
                                        <div class="form-control-icon">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                        @error('email')
                                            <div class='small text-danger text-left'>{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">                
                                        <div class="captcha">
                                          <span class="w-100">{!! captcha_img() !!}</span>
                                          <button type="button" class="btn btn-danger btn-sm" class="reload" id="reload"><i class="bi bi-arrow-clockwise"></i></button>                                      
                                        </div>
                                        <input type="text" name="captcha" placeholder="Enter Captcha" class="form-control my-3" id="captcha" required>
                                        @error('captcha')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                    </div>             
                                    <p>Sudah punya akun ?&nbsp;
                                        <a href="{{route('login')}}" class="badge bg-dark rounded-pill">Login</a>
                                    </p>                 
                                    <button class="btn btn-warning rounded-pill fw-bold">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('assets/extensions/jquery/jquery.min.js')}}"></script>

    <script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>

</body>

</html>
