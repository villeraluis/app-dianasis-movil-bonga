<?php


function cambioBaseDatos($bd_name=null)
{
    try {
        if ($bd_name && $bd_name == 'bddianasis_svr') {
            Illuminate\Support\Facades\Config::set('database.connections.mysql.database', 'bddianasis_svr');



            /* Illuminate\Support\Facades\Config::set('database.connections.mysql.database', 'bddianasis_svr');
            Illuminate\Support\Facades\Config::set('database.connections.mysql.host', '190.242.119.44');
            Illuminate\Support\Facades\Config::set('database.connections.mysql.port', '4000');
            Illuminate\Support\Facades\Config::set('database.connections.mysql.username', 'udianasis');
            Illuminate\Support\Facades\Config::set('database.connections.mysql.password', 'ANTONIO1'); */
        } else {
            //Illuminate\Support\Facades\Config::set('database.connections.mysql.database', 'bddianasis_' . session('Empresa'));
            // Illuminate\Support\Facades\Config::set('database.connections.mysql.database', 'bddianasis_sotracor');
            Illuminate\Support\Facades\Config::set('database.connections.mysql.database', 'bddianasis_svr');
            //91e20a270161.sn.mynetname.net DB_PORT=2841
        }
        Illuminate\Support\Facades\DB::purge('mysql');
    } catch (Exception $e) {
        return 'error al conectar a base de datos';
    }
}

function esMoneda($int)
{
    return '$ ' . number_format($int, 0);
}



function esMoneda2dec($float, $with_cero=true)
{
    if ($float==0&&$with_cero==false) {
        return '';
    }

    if (is_numeric($float)) {
        return  number_format($float, 2, '.', ',');
    } else {
        return  number_format(0, 2, '.', ',');
    }
}

function esMoneda0dec($float, $with_cero=true)
{
    if ($float==0&&$with_cero==false) {
        return '';
    }
    if (is_numeric($float)) {
        return  number_format($float, 0);
    } else {
        return  number_format(0, 0);
    }
}



function mesActual($int)
{
    $Meses = array(
         'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
         'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    );


    return $Meses[$int - 1];
}


function numDias($fecha_inicial, $fecha_final)
{
    $dias = (strtotime($fecha_inicial) - strtotime($fecha_final)) / 86400;
    $dias = abs($dias);
    $dias = floor($dias);
    return $dias;
}


function porcentaje($total, $actual)
{
    if (is_numeric($total) && is_numeric($actual) && $total != 0) {
        $porcentaje = ($actual / $total) * 100;

        return  number_format($porcentaje, 1, '.', ',');
    } else {
        return  number_format(0, 1, '.', ',');
    }
}

function variacion($actual, $anterior)
{
    if (is_numeric($actual) && is_numeric($anterior)) {
        $variacion = ($actual - $anterior);
        return  number_format($variacion, 1, '.', ',');
    } else {
        return  number_format(0, 1, '.', ',');
    }
}


function variacionSinFormato($actual, $anterior)
{
    if (is_numeric($actual) && is_numeric($anterior)) {
        return ($actual - $anterior);
    } else {
        return  0;
    }
}

function diffFechas($fecha_inicial, $fecha_final)
{
    $diff = date_diff(date_create($fecha_inicial), date_create($fecha_final));

    return $diff->format("%r%a");
}


function vTipoComprobante($pos)
{
    $ar = [
         "7", //' ingreso a banco
         "8", // egreso de banco
         "9", //' recibo de caja
         "10", // ' egreso de caja
         "11", //' ventas
         "12", // ' compras
         "13", //' devoluciones en venta
         "14", // ' devoluciones en compra
         "15", // ' ND cartera
         "16", // ' NC cartera
         "17", // ' ND proveedores
         "18", // ' NC proveedores
         "19", // ' Documentos Contabilizad
         "20", // ' caja menor
         "21", // ' nomina
         "99", // ' general
         "22", // ' planilla de combustible
         "25", // ' Cotizaciones
         "23", // ' Documento Soporte

    ];

    return $ar[$pos];
}

function nombre_dia_por_fecha($fecha)
{
    $dia = date('w', strtotime($fecha));
    $dia = $dia;
    $dia = ($dia == 7) ? 0 : $dia;
    $dias = array('DOMINGO', 'LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO');
    return $dias[$dia];
}

function promedio($total, $cantidad)
{
    if (is_numeric($total) && is_numeric($cantidad) && $cantidad != 0) {
        $porcentaje = ($total / $cantidad);

        return  number_format($porcentaje, 1, '.', ',');
    } else {
        return  number_format(0, 1, '.', ',');
    }
}

function imprimirNumero($numero, $with_zero=false)
{
    if ($numero==0&&!$with_zero) {
        return '';
    }

    return $numero;
}
