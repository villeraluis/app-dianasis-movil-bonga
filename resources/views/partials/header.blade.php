<!DOCTYPE html>
<html lang="es">
@routes

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dianasis Web</title>



    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700&display=fallback">


    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('vendor/img/modelo.png') }}" sizes="180x180">
    <link rel="icon" href="{{ asset('vendor/img/modelo.png') }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ asset('vendor/img/modelo.png') }}" sizes="16x16" type="image/png">
    <link rel="icon" href="{{ asset('vendor/img/modelo.png') }}">


    <!-- css princpal de bootstrap -->
    <link rel="stylesheet" href="{{ asset('vendor/libs/bootstrap-5/css/bootstrap.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href=" {{ asset('vendor/libs/fontAwesome/css-font-awesome/all.min.css') }}">

    <!-- Jquery -->
    <script src=" {{ asset('vendor/libs/jquery/jquery.min.js') }}"></script>

    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link href="{{ asset('vendor/libs/sel2/select2-bootstrap-5-theme.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- datatables -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendor/libs/datatables/DataTables-1.11.3/css/dataTables.bootstrap5.css') }}" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendor/libs/datatables/Responsive-2.2.9/css/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendor/libs/datatables/Select-1.3.3/css/select.bootstrap5.css') }}" />



    <script type="text/javascript" src="{{ asset('vendor/libs/datatables/DataTables-1.11.3/js/jquery.dataTables.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ asset('vendor/libs/datatables/DataTables-1.11.3/js/dataTables.bootstrap5.js') }}"></script>

    <script type="text/javascript"
        src="{{ asset('vendor/libs/datatables/Responsive-2.2.9/js/dataTables.responsive.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('vendor/libs/datatables/Responsive-2.2.9/js/responsive.bootstrap5.js') }}"></script>






    <script type="text/javascript" src="{{ asset('vendor/libs/datatables/Select-1.3.3/js/dataTables.select.js') }}">
    </script>

    <script type="text/javascript"
        src="{{ asset('vendor/libs/datatables/FixedColumns-4.0.0/js/dataTables.fixedColumns.min.js') }}">
    </script>
    <!-- chart js -->
    <script src="{{ asset('vendor/libs/chartjs/chart.js') }}"></script>
    <script src="{{ asset('vendor/libs/chartjs/hammer.js') }}"></script>
    <script src="{{ asset('vendor/libs/chartjs/chartjs-plugin-zoom.js') }}"></script>
    <script src="{{ asset('vendor/libs/chartjs/confChart.js') }}?v=<?php echo time(); ?>"></script>


    {{-- table export --}}
    {{-- <script src="{{ asset('vendor/libs/tableExport/FileSaver.min.js') }}"></script>
    <script src="{{ asset('vendor/libs/tableExport/xlsx.core.min.js') }}"></script>
    <script src="{{ asset('vendor/libs/tableExport/tableexport.js') }}"></script> --}}

    {{-- table  2 ecxel --}}
    <script src="{{ asset('vendor/libs/tableExport/table2excel.min.js') }}"></script>


    <!-- Custom js for this template -->
    <script src="{{ asset('vendor/js/jsDianasis.js') }}?v=<?php echo time(); ?>"></script>

    <!-- Custom styles for this template -->
    <link href="{{ asset('vendor/css/cssDianasis.css') }}?v=<?php echo time(); ?>" rel="stylesheet">


</head>
