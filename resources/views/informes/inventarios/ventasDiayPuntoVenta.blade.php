@extends('layout')

@section('content')

    <style>
        #tablaResultados>tbody>tr>td {
            padding: 0px 5px !important;
        }
    </style>

        @php
            $date=request()->dateSelect??null;
        @endphp

    <div  class="cmn-divfloat">
        <a href="{{route('vista.informes.selecionar_empresa',$date)}}" class="btn btn-danger btn-dange cmn-btncircle">
            <i class="fa fa-arrow-left"></i>
        </a>
    </div>
    

    <div class="border rounded">

        <div class="row mb-1 text-center pt-2">
            <h5>{{ $nombre_empresa }}</h5>
            <h5>{{ $dia }}/ {{ $mes }}/{{$year }}</h5>  
            <h5><b>Informe de Ventas</b></h5>  
        </div>


        <table class="table table-striped table-hover table-sm" id="tablaResultados">
            <thead>
                <tr>
                    <th scope="col">Punto de Venta</th>
                    <th scope="col">Día</th>
                    <th scope="col" class="text-end">Cantidad</th>
                    <th scope="col" class="text-end">Venta</th>
                </tr>
            </thead>
            <tbody>
    
                @foreach ($datos as $dato)
                    @if ($dato['type'] == 'p0')
                        <tr class="tr-totales pad-1">
                            <td>{{ $dato['nombre_punto_de_venta'] }}</td>
                            <td>{{ $dato['n_dia'] }}</td>
                            <td class="text-end">{{ imprimirNumero($dato['cantidad_ventas_diarias']) }}</td>
                            <td class="text-end">{{ esMoneda0dec($dato['total_ventas_diarias'], false) }}</td>
                        </tr>
                    @elseif($dato['type'] == 'p1')
                        <tr class="pad-1">
                            <td>{{ $dato['nombre_punto_de_venta'] }}</td>
                            <td>{{ $dato['n_dia'] }}</td>
                            <td class="text-end">{{ imprimirNumero($dato['cantidad_ventas_diarias']) }}</td>
                            <td class="text-end">{{ esMoneda0dec($dato['total_ventas_diarias'], false) }}</td>
                        </tr>
                    @elseif($dato['type'] == 'h1')
                        <tr class="movi">
                            <td>{{ $dato['nombre_punto_de_venta'] }}</td>
                            <td>{{ $dato['n_dia'] }}</td>
                            <td class="text-end">{{ imprimirNumero($dato['cantidad_ventas_diarias']) }}</td>
                            <td class="text-end">{{ esMoneda0dec($dato['total_ventas_diarias'], false) }}</td>
    
                        </tr>
                    @endif
                @endforeach
    
            </tbody>
        </table>

    </div>
    
@endsection
