<!DOCTYPE html>
<html lang="es">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Admin DIANASIS | Login</title>

    <link rel="stylesheet" href="{{ asset('vendor/libs/bootstrap-5/css/bootstrap.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href=" {{ asset('vendor/libs/fontAwesome/css-font-awesome/all.min.css') }}">

    <link rel="icon" href="https://www.dianasis.com/wp-content/uploads/2019/10/modelo.png" sizes="32x32">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style>
        .login-page,
        .register-page {
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            background: #ffffff !important;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
            height: 100vh;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .btn-dange {
            background: -webkit-linear-gradient(left, #912a2a 30%, #ce3c3c 100%);
            ;
            /* #cb3933; */
            border-radius: 0.1px;

        }
    </style>
</head>


<body>

    <section class="vh-100" style="background-color: #fafafa;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1px;">
                        <div class="card-body px-5  pb-5">

                            <form action="{{ route('dianasis.login') }}" method="POST">
                                @csrf

                                <div class="text-center">
                                    <h3 class="mb-5"><a href="">
                                            <img src="{{ asset('vendor/img/bonga_logo_96.png') }}" height="80" width="auto">
                                        </a></h3>

                                </div>



                                <div class=" mb-4 ">
                                    <label for="" class="form-label">Número de Identificación</label>
                                    <input type="number" name="cedulaUsuario" class="form-control form-control-sm"
                                         placeholder="Ingresa El numero de Identificacion"
                                         value="{{ old('cedulaUsuario') }}"
                                        autofocus required>
                                    
                                </div>
                                <div class="mb-4">
                                    <small style="color: #cd0000;">

                                        @php
                                            if (session('msg')) {
                                                echo session('msg');
                                            }
                                        @endphp
                                    </small>
                                </div>



                                <button class="col-12 btn btn-danger   btn-block btn-dange" type="submit">Ingresar</button>

                                <hr class="my-4">




                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</body>




</html>
