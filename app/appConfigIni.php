<?php


function empresasParametro()
{

    return [
        ['code' => '01','name' => 'SAURIOS LTDA'],
        ['code' => '02','name' => 'RENACIMIENTO S.A.S.'],
        ['code' => '03','name' => 'TERRALONTANA LTDA'],
        ['code' => '05','name' => 'PARTICIPAR ANDINA S.A.S'],
        ['code' => '06','name' => 'ANDES BEEF LTDA'],
        ['code' => '07','name' => 'CARIBBEAN BEEF LTDA']

    ];
}  


function loginEmpresas()
{

    return [
        '01' => '01- Saurios',
        '02' => '02 - Renacimiento',
        '03' => '03 - Terralontana',
        '05' => '05 - Participar',
        '06' => '06 - Andes',
        '07' => '07 - Caribbean',
    ];
}


function selectCambioEmpresa()
{



    return [
        '01' => '01- SAURIOS LTDA',
        '02' => '02 - RENACIMIENTO S.A.S.',
        '03' => '03 - TERRALONTANA LTDA',
        '05' => '05 - PARTICIPAR ANDINA S.A.S',
        '06' => '06 - ANDES BEEF LTDA',
        '07' => '07 - CARIBBEAN BEEF LTDA',
    ];
}

function opcionesMenuActivas($des)
{

    $arr = [
        'Informes de Contabilidad' => true,
        'Informes de Inventarios' => true,
        'Informes de Cartera' => true,
        'Informes de Cuentas por Pagar' => true,
        'Informes de Tesorería' => true,
        'Informes de Transporte' => false
    ];

    return $arr[$des];
}



