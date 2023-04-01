<nav class="navbar fixed-top navbar-expand-lg navbar-light navbar-custom bg-light">

    <a class="link-recargar" href="">
        <img  src="{{ asset('vendor/img/head_navbar2.png') }}" alt="" style="height: 80px ;">

    </a>
    <span class="navbar-toggler normal ml-4 mr-2" role="button" data-toggle="collapse" id="btn-activa-menu"
        aria-controls="menudesplegable" aria-expanded="false" aria-label="Navigation" style="margin: 4px!important;">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
</span>



    <span class=" w-100"></span>


    <div class="collapse navbar-collapse" id="menudesplegable">

        <ul class=" navbar-nav me-auto mb-2 mb-lg-0">


            <x-dropdownEmpresas/>


            <li class="nav-item text-nowrap shadow ">

                <span class="nav-link" style="color: rgb(253, 253, 253)"
                    href="#"><b>{{ session('empresaNombre') }}</b></span>

            </li>

            <li class="nav-item text-nowrap mx-4  shadow" style="border-radius:0;background-color:rgb(253, 253, 253);">

                <a class="nav-link" style="color: rgb(165, 6, 6)" href="{{ route('logout') }}"> Salir </a>

            </li>

        </ul>


    </div>

</nav>

{{-- @include('contenido.componentes.menuMovil') --}}
