@extends('layout')

@section('content')

    <div class="card shadow-2-strong" >
        <div class="card-body px-5  pb-5">

            

            <form action="{{ route('consulta.informe.ventas.diaypv') }}" method="GET" id="formGetVistaInformes">



                <div class="mb-2 text-center">
                    <label for="exampleFormControlInput1" class=" form-label"><b>Fecha</b></label>
                    <input type="date" class="form-control" name="dateSelect" id="exampleFormControlInput1"
                        value="{{$date?? date('Y-m-d') }}">
                </div>

                <div class=" mb-4 text-center">
                    <label for="" class="form-label"><b> Empresa </b> </label>

                    <div class="list-group">
                        <button type="submit" data-empresa="02" class="btn btn-danger btn-dange m-1">Renacimiento</button>
                        <button type="submit" data-empresa="03" class="btn btn-danger btn-dange m-1">Terralontana</button>
                        <button type="submit" data-empresa="05" class="btn btn-danger btn-dange m-1">Participar</button>
                        <button type="submit" data-empresa="06" class="btn btn-danger btn-dange m-1">Andes</button>
                        <button type="submit" data-empresa="07" class="btn btn-danger btn-dange m-1">Caribbean</button>

                    </div>


                </div>


            </form>


        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.btn-dange').click(function(e) {
                e.preventDefault();
                var empresa = $(this).data('empresa');
                //eliminar el campo oculto si existe
                $('#optionEmpresa').remove();
                $('#formGetVistaInformes').append(
                    '<input type="hidden" id="optionEmpresa" name="optionEmpresa" value="' + empresa +
                    '">');
                $('#formGetVistaInformes').submit();
            });
        });
    </script>
@endsection
