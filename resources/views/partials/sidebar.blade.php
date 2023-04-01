<div class="div-sidebar ">

    <div id="divSidebar">
        <div>
            <nav class="div-menu-sidebar div-nivel-1" id="sidebar">
                <div class="sidebar-header text-center">
                    <a href="{{ route('vista.informes.home') }}" class="link-recargar">
                        <h6 style="color: white">Menú Principal <span><svg xmlns="http://www.w3.org/2000/svg" width="26"
                                    height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                    <path fill-rule="evenodd"
                                        d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                                </svg></span> </h6>
                    </a>

                    <strong> <img style="width: 40%;  height: 40%;" src="{{ asset('vendor/img/modelo.png') }}"
                            alt=""></strong>
                </div>



                <div>
                    <x-menuMovil/>
                </div>



            </nav>
        </div>


    </div>
    


  

    <div class="vista-movil-activo shadow">


        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

            <x-dropdownEmpresas />

            <li class="nav-item  mx-4">

                <span class="" style="color: rgb(0, 0, 0);font-size: 15px!important; "
                    href="#"><b>{{ session('empresaNombre') }}</b></span>

            </li>

            <li class="nav-item   btn btn-danger btn-sm btn-sm-custom ">

                <a class="" style="color: rgb(247, 240, 240)" href="{{ route('logout') }}"><b>Salir</b>
                </a>

            </li>

        </ul>

    </div>


</div>

</div>
