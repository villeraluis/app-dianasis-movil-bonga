<?php

function esMoneda($int)
{
     return '$ ' . number_format($int, 0);
}



function cambioBaseDatos()
{
     try {
          Illuminate\Support\Facades\Config::set('database.connections.mysql.database', 'bddianasis_' . session('Empresa'));
          //Illuminate\Support\Facades\Config::set('database.connections.mysql.database', 'bddianasis_03');
          // Illuminate\Support\Facades\Config::set('database.connections.mysql.database', 'bddianasis_con_datos' );
          Illuminate\Support\Facades\DB::purge('mysql');
     } catch (Exception $e) {

          return 'error al conectar a base de datos';
     }
}



function esMoneda2dec($float)
{

     if(is_numeric($float)){
          return  number_format($float, 2, '.', ',');
     }else{
          return  number_format(0, 2, '.', ',');
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

     if(is_numeric($total) && is_numeric($actual) && $total!=0 ){
          $porcentaje = ($actual / $total) * 100;

          return  number_format($porcentaje, 1, '.', ',');
     }else{
          return  number_format(0, 1, '.', ','); 
     }

     
}

function variacion($actual,$anterior){

     if(is_numeric($actual) && is_numeric($anterior)){
          $variacion = ($actual - $anterior) ;
          return  number_format($variacion, 1, '.', ',');
     }else{

          return  number_format(0, 1, '.', ','); 
     }
}


function variacionSinFormato($actual,$anterior){

     if(is_numeric($actual) && is_numeric($anterior)){
          return  ($actual - $anterior) ;  
     }else{
          return  0; 
     }
}
