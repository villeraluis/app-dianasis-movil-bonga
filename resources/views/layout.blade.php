@include('partials.header')

<body>
    <style>
        nav {
            background: #000000 url(img/fondo_header-3.jpg) repeat center center;
        }

        html {
            min-height: 100%;
            position: relative;
        }


        footer {
            background-color: black;
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 40px;
            color: white;
        }

        .btn-dange {
            background: -webkit-linear-gradient(left, #912a2a 30%, #ce3c3c 100%);
            ;
            /* #cb3933; */
            border-radius: 0.1px;

        }

        .cmn-divfloat {
            position: fixed !important;
            bottom: 15px;
            left: 45px;
        }

        .cmn-divfloattop {
            position: fixed !important;
            top: 5px;
            right: 15px;
            z-index: 2;
        }

        .cmn-btncircle2 {
            width: 40px !important;
            height: 40px !important;
            padding: 6px 0px;
            border-radius: 25px;
            font-size: 18px;
            text-align: center;
        }

        .cmn-btncircle {
            width: 80px !important;
            height: 40px !important;
            padding: 6px 0px;
            border-radius: 25px;
            font-size: 18px;
            text-align: center;
        }
    </style>

    {{-- <div  class="cmn-divfloat">
        <a href="#span-top" class="btn btn-primary cmn-btncircle">
            <i class="fa fa-arrow-left"></i>
        </a>
    </div> --}}
    <div  class="cmn-divfloattop">
        
        <a href="{{ route('logout') }}" class=" cmn-btncircle2">X</a>
    </div>

    

    <section class="h-100" style="background-color: #fafafa;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">

                    <div class="card  mb-2">
                        <div class="text-end">
                            
                        </div>


                        <div class="text-center">
                            <h3 class=""><a href="">
                                    <img src="{{ asset('vendor/img/bonga_logo_96.png') }}" height="80"
                                        width="auto">
                                </a></h3>

                        </div>




                    </div>


                    @yield('content')

                </div>
            </div>
        </div>
    </section>
</body>
@include('partials.footer')


@yield('scripts')

</html>
