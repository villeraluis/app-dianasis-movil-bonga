<?php

namespace App\Http\Controllers\inventarios\informes;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Comprobante;
use App\Models\FormaPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformeVentasDiaAndPvController extends Controller
{
    public function viewVentasDiaAndPV()
    {
        cambioBaseDatos('bddianasis_svr');

        $yearSelect=['2021','2022','2023','2024','2025','2026','2027','2028','2029','2030'];


        return view('inventarios.informes.ventasDiayPuntoV.index', compact('yearSelect'));
    }


    public function viewConsultaInformeDiaYPV(Request $request)
    {
        cambioBaseDatos('bddianasis_svr');

        $request->validate([
            'optionEmpresa' => 'required|string|in:02,03,05,06,07',
            'dateSelect' => 'required|date',
        ]);

        $datos= $this->consultaInforme($request);

        $codEmpresa=$request->optionEmpresa;

        $nombre_empresa = array_filter(empresasParametro(), function ($item) use ($codEmpresa) {
            return $item['code'] == $codEmpresa;
        });

        $nombre_empresa = array_values($nombre_empresa)[0]['name'];

        $mes= mesActual(date('m', strtotime($request->dateSelect)));

        $year=date('Y', strtotime($request->dateSelect));

        $dia=date('d', strtotime($request->dateSelect));

        return view('informes.inventarios.ventasDiayPuntoVenta', compact('datos', 'nombre_empresa', 'mes', 'year','dia'));
    }


    public function consultaInforme($request)
    {
        cambioBaseDatos('bddianasis_svr');

        /*
         ejemplo de datos que llegan
        "codEmpresa" => "02"
        "dateSelect" => "2023-03-10"
        "grupoVenta" => "1" */

        $date=$request->dateSelect;

        $codEmpresa=$request->optionEmpresa;


        $IdStEmpresa = '02';//session('Empresa');
        $year = date('Y', strtotime($date));
        $mes = date('m', strtotime($date));
        $dia = date('d', strtotime($date));
        $tipoComprobanteVentas=vTipoComprobante(4);
        $vTipoComprobante4=vTipoComprobante(4);
        $vTipoComprobante6=vTipoComprobante(6);



        //PUNTOS DE VENTAS
        $consulta1 = "SELECT A.*, B.MpvInValor FROM PUNTOSVENTAS A 
            LEFT OUTER JOIN METASPORPUNTODEVENTA B ON (A.PveIdStEmpresa = B.MpvIdStEmpresa and A.PveIdInPuntoVenta = B.MpvIdInPuntoVenta AND  B.MpvInAno = '$year' and B.MpvInMes = '$mes')
            WHERE (PveIdStEmpresa = '$IdStEmpresa' and PveIdInPuntoVenta <> 1 AND PveIdInAgencia ='$codEmpresa' ) ORDER BY PveIdInGrupoPuntoVenta,PveStNombre";

        $puntos_de_venta =collect(DB::select($consulta1)) ;
        //convertir array a collection


        //cantidad dias del mes
        $can_dias_del_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $year);
        //agregar cero a los meses menores a 10
        $mes_b=$mes;
        if ($mes_b < 10) {
            $mes_b = '0'. $mes_b;
        }

        //array de fechas completas

        $final_cantidad_ventas=0;
        $final_total_ventas=0;


        ///recorrer los puntos de venta
        $ventas_diarias_collect=collect();

        foreach ($puntos_de_venta as $punto_de_venta) {
            $filtro2= " AND PveIdInAgencia ='$codEmpresa' AND VenIdInPuntoVenta='$punto_de_venta->PveIdInPuntoVenta'";

            $consulta2="SELECT * FROM VENTAS A 
               INNER JOIN PUNTOSVENTAS B ON (A.VenIdStEmpresa = B.PveIdStEmpresa AND A.VenIdInPuntoVenta = B.PveIdInPuntoVenta $filtro2) 
               WHERE (VenIdStEmpresa = '$IdStEmpresa' AND VenIdStTipoComprobante = '$tipoComprobanteVentas' AND VenStEstadoRegistro = 'A'
               AND YEAR(VenDaFechaDoc) = '$year' AND MONTH(VenDaFechaDoc) = '$mes') AND DAY(VenDaFechaDoc) <= '$dia' ";

            $ventas = collect(DB::select($consulta2));

            //ventas diarias
            $punto_de_venta->ventas = $ventas;

            //DEVOLUCIONES EN VENTAS
            $consulta4="SELECT A.* FROM VENTAS A 
            INNER JOIN PUNTOSVENTAS B ON (A.VenIdStEmpresa = B.PveIdStEmpresa 
            AND A.VenIdInPuntoVenta = B.PveIdInPuntoVenta  $filtro2) 
            WHERE (A.VenIdStEmpresa = '$IdStEmpresa' AND A.VenIdStTipoComprobante = '$vTipoComprobante6' 
            AND A.VenStEstadoRegistro = 'A' AND 
            YEAR(A.VenDaFechaDoc) = '$year' AND MONTH(A.VenDaFechaDoc) = '$mes' AND DAY(VenDaFechaDoc) <= '$dia') ORDER BY A.VenObjectIDVentas";

            $devoluciones = DB::select($consulta4);


            foreach ($devoluciones as $devolucion) {
                //buscar la devolucion en ventas y eliminarla de la coleccion de ventas
                $ventas=$ventas->filter(function ($item) use ($devolucion) {
                    return  $item->VenInFactura != $devolucion->VenInFactura;
                });
            }

            //datos que se muestran en la tabla
            $cantidad_ventas=$ventas->count();

            if ($cantidad_ventas>0) {
                $total_ventas=$ventas->sum('VenInValor')-$ventas->sum('VenInDescuento');
                $promedio_ventas =promedio($total_ventas, $cantidad_ventas);

                //extraer datos de ventas diarias
                $ventas_diarias_collect->push([
                    'type'=>'p1',
                    'nombre_punto_de_venta'=>$punto_de_venta->PveStNombre,
                    'n_dia'=>'AC',
                    'cantidad_ventas_diarias'=>$cantidad_ventas,
                    'total_ventas_diarias'=>$total_ventas,


                ]);


                //sumar los totales finales
                $final_cantidad_ventas+=$cantidad_ventas;
                $final_total_ventas+=$total_ventas;


                //ventas del dia

                $n_dia=$dia;

                $ventas_diarias = $ventas->where('VenDaFechaDoc', $date);
                $cantidad_ventas_diarias=$ventas_diarias->count();
                $total_ventas_diarias=$ventas_diarias->sum('VenInValor')-$ventas_diarias->sum('VenInDescuento');



                $ventas_diarias_collect->push([
                    'type'=>'h1',
                    'nombre_punto_de_venta'=>$punto_de_venta->PveStNombre,
                    'n_dia'=>$n_dia,
                    'cantidad_ventas_diarias'=>$cantidad_ventas_diarias,
                    'total_ventas_diarias'=>$total_ventas_diarias,

                ]);
            }
        }



        //agregar los totales finales
        $ventas_diarias_collect->prepend(
            [
                'type'=>'p0',
                'nombre_punto_de_venta'=>'TOTALES',
                'n_dia'=>'',
                'cantidad_ventas_diarias'=>$final_cantidad_ventas,
                'total_ventas_diarias'=>$final_total_ventas,

            ]
        );

        return $ventas_diarias_collect;
    }
}
