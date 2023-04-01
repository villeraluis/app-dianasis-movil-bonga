@extends('layout')

@section('content')
    <section class="vh-100" style="background-color: #fafafa;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1px;">
                        <div class="card-body px-5  pb-5">



                            <div class=" mb-4 text-center">





                                <div class="list-group">

                                    @if ($codEmpresa == '01')
                                        {{--  es la empresa saurios solo veran los de compras y ventas por periodo --}}
                                        <form action="{{ route('vista.informes.ver_informes.ventas') }}" method="POST"
                                            id="formGetVistaInformes">


                                            <button type="submit" data-empresa="01"
                                                class="btn btn-danger btn-dange m-1">Compras Por periodo</button>
                                        </form>
                                        <form action="{{ route('vista.informes.ver_informes.ventas') }}" method="POST"
                                            id="formGetVistaInformes">

                                            <button type="submit" data-empresa="01"
                                                class="btn btn-danger btn-dange m-1">Compras Por periodo</button>
                                        </form>
                                    @else
                                        <form action="{{ route('consulta.informe.ventas.diaypv') }}" method="GET"
                                            id="formGetVistaInformes">

                                            <input type="hidden" name="codEmpresa" value="{{$codEmpresa}}">

                                            <div class="mb-2">
                                                <label for="exampleFormControlInput1"
                                                    class=" form-label"><b>{{ $nombre_empresa }}</b></label>
                                            </div>

                                           

                                            <div class="mb-3 ">
                                                <label for="exampleFormControlInput1" class=" form-label"><b>Grupo de
                                                        Venta</b></label>
                                                <select class="form-select" name="grupoVenta"
                                                    aria-label="Default select example" required>
                                                    <option value="" selected>Seleccione Grupo de Venta</option>
                                                    @foreach ($gruposVenta as $grupo)
                                                        <option value="{{ $grupo->GpvIdInGrupoPuntoVenta }}">
                                                            {{ $grupo->GpvIdInGrupoPuntoVenta . ' - ' . $grupo->GpvStDescripcion }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <label for="" class="form-label"><b> Informe a Visualizar </b> </label>

                                            <button type="submit" data-empresa="01"
                                                class="col-12 btn btn-danger btn-dange m-1">Venta por Día y Punto de
                                                Venta</button>


                                        </form>




                                        <form action="{{ route('vista.informes.ver_informes.ventas') }}" method="POST"
                                            id="formGetVistaInformes">

                                            <button type="submit" data-empresa="01"
                                                class="col-12 btn btn-danger btn-dange m-1">Venta por Día de Punto de
                                                Venta</button>
                                        </form>
                                    @endif



                                </div>


                            </div>





                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
@endsection
