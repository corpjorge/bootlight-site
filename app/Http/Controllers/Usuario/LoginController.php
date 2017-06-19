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


      $url = "https://fonsodi.com.co/WebServices/WSlogin.asmx/Logeo?pEntidad=FONSODI&pIdentificacion=".$request->cedula."&pClave=".$request->password."&pTipoUsuario=2";
      $response_xml_data = file_get_contents($url);
      $xml = simplexml_load_string($response_xml_data);

      if($xml == 'true'){

        $usuario_cedula = Users_detalle::where('cedula',$request->cedula)->first();

        if (empty($usuario_cedula)) {

          $url_datos = "https://fonsodi.com.co/WebServices/WSEstadoCuenta.asmx/ConsultarDatoBasicosPersona?pEntidad=FONSODI&pIdentificador=".$request->cedula."&pTipo=Identificacion";
          $response_xml_datos = file_get_contents($url_datos);
          $xml_datos = simplexml_load_string($response_xml_datos);

          if ($xml_datos->estado != 'A') {
            session()->flash('message', 'Datos inválidos');
            return redirect('login');
          }

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

          $url_datos = "https://fonsodi.com.co/WebServices/WSEstadoCuenta.asmx/ConsultarDatoBasicosPersona?pEntidad=FONSODI&pIdentificador=".$request->cedula."&pTipo=Identificacion";
          $response_xml_datos = file_get_contents($url_datos);
          $xml_datos = simplexml_load_string($response_xml_datos);

          if ($xml_datos->estado != 'A') {
            session()->flash('message', 'Datos inválidos');
            return redirect('login');
          }

          $usuario = User::where('id',$usuario_cedula->usuario->id)->first();
          $usuario->name    = $xml_datos->primer_nombre.' '.$xml_datos->segundo_nombre.' '.$xml_datos->primer_apellido.' '.$xml_datos->segundo_apellido;
          $usuario->email   = $xml_datos->email;
          $usuario->social_name   = '';
          $usuario->social_id   = '';
          $usuario->avatar   = '';
          $usuario->password= bcrypt($xml_datos->clavesinencriptar);
          $usuario->role_id = 10;
          $usuario->save();

          $usuario_cedula->user_id = $usuario_cedula->usuario->id;
          $usuario_cedula->cedula  = $xml_datos->identificacion;
          $usuario_cedula->cod_persona = $xml_datos->cod_persona;
          $usuario_cedula->fecha_nacimiento = $xml_datos->fecha_nacimiento;
          $usuario_cedula->almacen = '';
          $usuario_cedula->cuidad = $xml_datos->nomciudadresidencia;
          $usuario_cedula->genero = $xml_datos->genero;
          $usuario_cedula->direccion = $xml_datos->direccion;
          $usuario_cedula->estado_vinculacion = $xml_datos->estado;
          $usuario_cedula->estado_civil_id = $xml_datos->codestadocivil;
          $usuario_cedula->save();

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
    $url_datos = "https://fonsodi.com.co//WebServices/WSEstadoCuenta.asmx/ConsultarDatoBasicosPersona?pEntidad=FONSODI&pIdentificador=".$usuario->cedula."&pTipo=Identificacion";
    $response_xml_datos = file_get_contents($url_datos);
    $xml_datos = simplexml_load_string($response_xml_datos);

    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
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


    <div class="card text-center">
      <div class="card-header">
        INGRESANDO AL ESTADO DE CUENTA
      </div>
      <div class="card-block">
        <center>
      <div style=" top: 42%; left: 44%;" class="loader"></div>
    </center>
    <br>
        <p class="card-text">Estamos direccionándolo al estado de cuenta.</p>
        <br>
        <a href="home" class="btn btn-danger">Cancelar</a>
      </div>
      <div class="card-footer text-muted">
        Cargando
        <div class="progress">
          <div  id="bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
        </div>
      </div>
    </div>

    <script>
      var progreso = 0;
      var idIterval = setInterval(function(){
        // Aumento en 10 el progeso
        progreso +=10;
        $('#bar').css('width', progreso + '%');

      //Si llegó a 100 elimino el interval
        if(progreso == 100){
       clearInterval(idIterval);
      }
      },1000);
    </script>

    <form name="formulario" action="https://fonsodi.com.co/atencion/Default.aspx" method="post">
        <input type="hidden" id="pIdentificacion" name="pIdentificacion" value="<?php echo $usuario->cedula ?>"/>
        <input type="hidden" id="pClave" name="pClave" value="<?php echo $xml_datos->clavesinencriptar; ?>"/>
    </form>
    <script type="text/javascript">
    	document.formulario.submit();
    </script>

    <?php




  }

}
