<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $idUs = $request->cedulaUsuario;
        cambioBaseDatos('bddianasis_svr');

        try {
            if (Usuario::where('UsuStIdUsuario', $idUs)->exists()) {
                $usuario = Usuario::where('UsuStIdUsuario', $idUs)->first();

                if ($usuario) {
                    if ($usuario->UsuStActivo == 'A') {
                        session(['idUsuario' => $usuario->UsuStIdUsuario]);

                        return self::redirectIformes();
                    } else {
                        return redirect()->back()->with('msg', 'El Usuario Esta Inactivo');
                    }
                }
            } else {
                return redirect()->route('login')->with('msg', 'Usuario no Encontrado');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('msg', 'Error al conectar con Base de Datos');
        }
    }


    private static function redirectIformes()
    {
        return redirect()->route('vista.informes.selecionar_empresa');
    }
}
