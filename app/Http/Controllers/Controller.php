<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empresa;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function selecionarEmpresa($date=null)
    {
        return view('select_empresa',compact('date'));
    }


    public function selecionarInformes(Request $request)
    {
        //dateSelect
        //optionEmpresa
        $request->validate([
            //las empresas solo 01,02,03,05,06,07
            'optionEmpresa' => 'required|string|in:01,02,03,05,06,07',
        ]);


        $codEmpresa = $request->optionEmpresa;
        $gruposVenta= $this->getGrupoPuntosVentasSrv();

        $nombre_empresa = array_filter(empresasParametro(), function ($item) use ($codEmpresa) {
            return $item['code'] == $codEmpresa;
        });

        $nombre_empresa = array_values($nombre_empresa)[0]['name'];

        return view('informes.inventarios.index', compact('gruposVenta', 'codEmpresa', 'nombre_empresa'));
    }


    public function cargaEmpresa($codEmpresa)
    {
        $temp= session('Empresa');
        session(['Empresa' => $codEmpresa]);

        cambioBaseDatos();
        try {
            $empresa = Empresa::where('empcodi', $codEmpresa)->first();
            session(['empresaNombre' => $empresa->empnomb]);
        } catch (Exception $e) {
            session(['Empresa' => $temp]);

            return 'error al conectar a base de datos';
        }


        return redirect()->route('vista.informes.home');
    }



    public function getTerceros()
    {
        cambioBaseDatos();
        $terceros = Cliente::select('clinit', 'CliStNombreCliente')->get();

        return  view('components.modalTerceros', compact('terceros'));
        // return $terceros;
    }


    //obtiene los grupos de puntos de ventas para la base de datos srv en la bonga
    public function getGrupoPuntosVentasSrv()
    {
        cambioBaseDatos('bddianasis_svr');

        $grupos= DB::table('grupopuntosventas')->get();
        return  $grupos;
    }

    //obtien la lista de agencias de ventas para la base de datos srv en la bonga
    public function getAgenciasVentasSrv()
    {
        cambioBaseDatos('bddianasis_svr');

        $agenciaventas= DB::table('agenciaventas')->get();
        return  $agenciaventas;
    }

    //obtiene los  puntos de ventas para la base de datos srv en la bonga
    public function getPuntosVentasSrv()
    {
        cambioBaseDatos('bddianasis_svr');
        $puntosventas= DB::table('puntosventas')->get();
        return  $puntosventas;
    }




    public function dataBuscarFiltros($type, $data = null)
    {
        switch($type) {
            case 'resposables':
                return $this->searchResposables();
                break;
            case 'agencia':
                return $this->searchAgencias();
                break;
            case 'puntosRec':
                if ($data != null) {
                    return $this->searchPuntosRec($data);
                }
                break;
            case 'conceptos':
                return $this->searchConceptos();
                break;
            case 'conductores':
                return $this->searchConductores($data);
                break;
            case 'marcas':
                return $this->searchMarca();
                break;
            case 'clases':
                return $this->searchClase();
                break;
            case 'ceCosto':
                return $this->searchCentroCostoInfo();
                break;
            case 'capacidad':
                return $this->searchCapacidad();
                break;
            case 'linea':
                return $this->searchLinea();
                break;
            case 'nivel':
                return $this->searchNivel();
                break;
            case 'propietario':
                return $this->searchPropietario();
                break;
            case 'combustible':
                return $this->searchCombustible();
                break;
            case 'grupopuntosventassrv':
                return $this->getGrupoPuntosVentasSrv();
                break;
            case 'agenciaventassrv':
                return $this->getAgenciasVentasSrv();
                break;
            case 'puntosventassrv':
                return $this->getPuntosVentasSrv();
                break;
            default:
                return null;
                break;
        }
    }




    public function searchResposables()
    {
        cambioBaseDatos();
        $empresa = session('Empresa');
        $sql = "SELECT A.*, B.CliStNombreCliente FROM GENTUSUARIOS A 
       INNER JOIN CLIENTES B ON (A.UsuIdStNitCliente = B.CliNit AND B.CliEmpr = '$empresa') ";
        $datos = DB::select($sql);

        return $datos;
    }


    public function searchAgencias()
    {
        cambioBaseDatos();
        $empresa = session('Empresa');

        $sql = "SELECT AgeIdStAgencia,AgeStDescripcion FROM TRANAGENCIAS WHERE AgeIdStEmpresa = '$empresa'";
        $datos = DB::select($sql);
        return $datos;
    }

    public function searchPuntosRec($agencia = null)
    {
        cambioBaseDatos();
        $empresa = session('Empresa');
        if ($agencia != null) {
            $sql = "SELECT PtrIdStPuntoRecaudo,PtrStDescripcion FROM TRANPUNTORECAUDOS WHERE PtrIdStEmpresa = '$empresa' 
        AND PtrIdStAgencia = '$agencia' AND PtrStEstado = 'A' ";
            $datos = DB::select($sql);
            return $datos;
        }
    }


    public function searchConceptos()
    {
        cambioBaseDatos();
        $sql = "SELECT CrdIdStConceptoRecaudo,CrdStDescripcion FROM TRANCONCEPTOSRECAUDOS WHERE CrdIdStEmpresa = '05' AND CrdStEstado = 'A'";
        $datos = DB::select($sql);
        return $datos;
    }


    public function searchConductores($placa = null)
    {
        cambioBaseDatos();
        $empresa = session('Empresa');

        if ($placa != null) {
            $sql = "SELECT DISTINCT VcdIdStConductor,CliStNombreCliente FROM TRANVEHICULOCONDUCTOR A 
            INNER JOIN CLIENTES B ON (A.VcdIdStEmpresa = B.CliEmpr AND A.VcdIdStConductor = B.CliNit) 
            WHERE (A.VcdIdStEmpresa = '$empresa' AND VcdIdStPlacaVehiculo = '$placa')";
        } else {
            $sql = "SELECT DISTINCT VcdIdStConductor,CliStNombreCliente FROM TRANVEHICULOCONDUCTOR A
            INNER JOIN CLIENTES B ON (A.VcdIdStEmpresa = B.CliEmpr AND A.VcdIdStConductor = B.CliNit) ";
        }

        $datos = DB::select($sql);
        return $datos;
    }






    public function searchCentroCostoInfo()
    {
        cambioBaseDatos();
        $empresa = session('Empresa');
        $sql = "SELECT A.CenNomb,B.* FROM CENTROSC A 
                INNER JOIN SCENTROS B ON (A.CenEmpr  = B.SceEmpr AND A.CenCodi = B.SceCent) 
                WHERE CenEmpr = '$empresa' ORDER BY CenCodi,SceCodi";
        return  DB::select($sql);
    }


    public function conCentroCostoCodi()
    {
        cambioBaseDatos();
        $x = ''; // Mid(PlaCentroCosto.Text, 1, 2);
        $y = ''; // Mid(PlaCentroCosto.Text, 3, 6);
        $empresa = session('Empresa');
        $sql = "SELECT * FROM SCENTROS WHERE (SceEmpr = '$empresa' AND SceCent = '$x' AND SceCodi = '$y') ";

        return  DB::select($sql);
    }









    public function searchPropietario()
    {
        cambioBaseDatos();
        $empresa = session('Empresa');
        $sql = "SELECT DISTINCT A.VpoIdStPropietario as TmaIdStCodigo, B.CliStNombreCliente as TmaStDescripcionUna FROM TRANVEHICULOPROPIETARIOS A 
                INNER JOIN CLIENTES B ON (A.VpoIdStEmpresa = B.cliempr AND A.VpoIdStPropietario = B.clinit) 
                WHERE A.VpoIdStEmpresa = '$empresa' AND A.VpoStPrincipal = '1' ";
        return  DB::select($sql);
    }
}
