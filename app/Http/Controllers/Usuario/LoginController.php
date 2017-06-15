<?php

namespace App\Http\Controllers\Usuario;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Usuario\Users_detalle;
use App\Model\Usuario\Telefono;

use Auth;

class LoginController extends Controller
{
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function login_ws(Request $request)
  {
      $this->Validate($request,[
          'cedula' => 'required|numeric',
          'password' => 'required|string',
      ]);


      $url = "http://50.63.15.92:420/WebServices/WSlogin.asmx/Logeo?pEntidad=FONSODI&pIdentificacion=".$request->cedula."&pClave=".$request->password."&pTipoUsuario=2";
      $response_xml_data = file_get_contents($url);
      $xml = simplexml_load_string($response_xml_data);

      // echo $xml->clavesinencriptar;

      if($xml == 'true'){

        $usuario_cedula = Users_detalle::where('cedula',$request->cedula)->first();

        if (empty($usuario_cedula)) {
          $url_datos = "http://50.63.15.92:420/WebServices/WSEstadoCuenta.asmx/ConsultarDatoBasicosPersona?pEntidad=FONSODI&pIdentificador=".$request->cedula."&pTipo=Identificacion";
          $response_xml_datos = file_get_contents($url_datos);
          $xml_datos = simplexml_load_string($response_xml_datos);

          $user = new User;
          $user->name    = $xml_datos->primer_nombre.' '.$xml_datos->segundo_nombre.' '.$xml_datos->primer_apellido.' '.$xml_datos->segundo_apellido;
          $user->email   = $xml_datos->email;
          $user->social_name   = '';
          $user->social_id   = '';
          $user->avatar   = '';
          $user->password= bcrypt($xml_datos->clavesinencriptar);
          $user->role_id = 10;
          $user->save();
          $iduser = $user->id;

          $users_detalle = new Users_detalle;
          $users_detalle->user_id = $iduser;
          $users_detalle->cedula  = $xml_datos->identificacion;
          $users_detalle->cod_persona = $xml_datos->cod_persona;
          $users_detalle->fecha_nacimiento = $xml_datos->fecha_nacimiento;
          $users_detalle->almacen = '';
          $users_detalle->cuidad = $xml_datos->nomciudadresidencia;
          $users_detalle->genero = $xml_datos->genero;
          $users_detalle->direccion = $xml_datos->direccion;
          $users_detalle->estado_vinculacion = $xml_datos->estado;
          $users_detalle->estado_civil_id = $xml_datos->codestadocivil;
          $users_detalle->hobby = '';
          $users_detalle->save();

          $telefono = new Telefono;
          $telefono->user_id = $iduser;
          $telefono->tipo = 'telefono';
          $telefono->numero = $xml_datos->telefono;
          $telefono->save();

          $usuario = User::where('id',$user->id)->first();
          auth()->login($usuario);
          return redirect()->To('home');

        }
        else{
          $usuario = User::where('id',$usuario_cedula->usuario->id)->first();
          auth()->login($usuario);
          return redirect()->To('home');
        }

      }
      else{
          session()->flash('message', 'Datos inválidos');
          return redirect('login');
      }

  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function loginAtencion()
  {


    $usuario = Users_detalle::where('user_id',Auth::user()->id)->first();
    $url_datos = "http://50.63.15.92:420/WebServices/WSEstadoCuenta.asmx/ConsultarDatoBasicosPersona?pEntidad=FONSODI&pIdentificador=".$usuario->cedula."&pTipo=Identificacion";
    $response_xml_datos = file_get_contents($url_datos);
    $xml_datos = simplexml_load_string($response_xml_datos);

    ?>
    <style>
    .loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #3498db;
      width: 120px;
      height: 120px;
      -webkit-animation: spin 2s linear infinite;
      animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    </style>


    <div style="position: absolute; top: 42%; left: 44%;" class="loader"></div>

    <form name="formulario" action="http://50.63.15.92:420/atencion/Default.aspx" method="post">
        <input type="hidden" id="pIdentificacion" name="pIdentificacion" value="<?php echo $usuario->cedula ?>"/>
        <input type="hidden" id="pClave" name="pClave" value="<?php echo $xml_datos->clavesinencriptar; ?>"/>
    </form>
    <script type="text/javascript">
    	document.formulario.submit();
    </script>
    <?php




  }

}
