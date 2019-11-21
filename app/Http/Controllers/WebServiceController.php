<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\AdminUser;
use JWTAuth,JWTGuard;
use App\Consumo;
use App\Cupo;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator, DB, Hash, Mail,Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use App\Model\Usuario\Users_detalle;
use App\Model\Usuario\Telefono;
use App\User;

/**
 * Class AdminHomeController
 * @package App\Http\Controllers
 */

class WebServiceController extends Controller
{
  use AuthenticatesUsers;

  protected $guard = 'admin_user';
  private $cedula;
  private $email;
  private $celular;
  private $direccion_entrega;
  private $direccion_facturacion;
  private $valor_compra;
  private $fecha;

  /**
     * API Login, on success return JWT Auth token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

     protected function guard()
     {
         return Auth::guard($this->guard);
     }

     public function createKeyStore($length = 6){
        $str = "";
       	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
       	$max = count($characters) - 1;
       	for ($i = 0; $i < $length; $i++) {
       		$rand = mt_rand(0, $max);
       		$str .= $characters[$rand];
       	}
       	return $str;
     }

    private function obtenerCupo($cedula){
        $cupoCount = \App\Cupo::where('cedula','=',$cedula)->count();
        if($cupoCount > 0){
          $cupoData = \App\Cupo::where('cedula','=',$cedula)->first();
        }else{
          $cupoData = ['status' => 'user_not_exist'];
        }
        return $cupoData;
    }

    public function obtenerCupoWebService(Request $request){
      $credentials = $request->only('email', 'password');
      try {
         //attempt to verify the credentials and create a token for the user
         if ($token = $this->guard()->attempt($credentials)) {
           $cupo = $this->obtenerCupo($request->cedula);
           if($cupo['status'] == 'user_not_exist' ){
             return response()->json(['status' => 'user_not_exist'], 200);
           }else{
             return $cupo;
           }

         }else{
           return response()->json(['status' => 'invalid_credentials'], 401);
         }
       } catch (JWTException $e) {
           // something went wrong whilst attempting to encode the token
           return response()->json(['status' => 'could_not_create_token'], 500);
       }
    }

    public function obtenerComprasWebService(Request $request){
      $credentials = $request->only('email', 'password');
      try {
         //attempt to verify the credentials and create a token for the user
         if ($token = $this->guard()->attempt($credentials)) {
           $consumoCount = \App\Consumo::where('cedula','=',$request->cedula)->count();
           if($consumoCount > 0){
             $consumoData = \App\Consumo::where('cedula','=',$request->cedula)->get();
           }else{
             $consumoData = ['status' => 'data_not_report'];
           }
           return $consumoData;

         }else{
           return response()->json(['status' => 'invalid_credentials'], 401);
         }
       } catch (JWTException $e) {
           // something went wrong whilst attempting to encode the token
           return response()->json(['status' => 'could_not_create_token'], 500);
       }
    }

    public function actualizarCupo($cedula,$cupoValue){
      $cupoData = \App\Cupo::where('cedula','=',$cedula)->first();
      //Cupo Model
      $newCupo = $cupoData['cupo'] - $cupoValue;
      $cupo = \App\Cupo::find($cupoData['id']);
      $cupo->cupo = $newCupo;
      $cupo->save();
      return $cupo;
    }

    public function guardarConsumo(Request $request){

        $credentials = $request->only('email', 'password');

        try {
           // attempt to verify the credentials and create a token for the user
           if ($token = $this->guard()->attempt($credentials)) {

             $cupo = $this->obtenerCupo($request->cedula);
             if($cupo['status'] == 'user_not_exist'){
               return response()->json(['status' => 'user_not_exist']);
             }else{
               $valor_cupo = $cupo['cupo'];
               if($request->valor_compra > $valor_cupo){
                 return response()->json(['status' => 'quota_insuffisant']);
               }else{

                 $dataToken = $this->createKeyStore(10);
                 $consumo = new Consumo;
                 $consumo->token = $dataToken;
                 $consumo->cedula = $request->cedula;
                 $consumo->email = $request->email_data;
                 $consumo->celular = $request->celular;
                 $consumo->direccion_entrega = $request->direccion_entrega;
                 $consumo->direccion_facturacion = $request->direccion_facturacion;
                 $consumo->valor_compra = $request->valor_compra;
                 $consumo->fecha = date("Y-m-d");
                 $consumo->save();



                 if ($consumo->save()) {
                    $stat = $this->actualizarCupo($consumo->cedula,$consumo->valor_compra);
                    return $stat;
                   //return response()->json(['success' => '200', 'id' => $consumo->token]);
                 }else{
                   return response()->json(['error' => -1]);
                 }
               }

             }


           }else{
             return response()->json(['error' => 'invalid_credentials'], 401);
           }
       } catch (JWTException $e) {
           // something went wrong whilst attempting to encode the token
           return response()->json(['error' => 'could_not_create_token'], 500);
       }


    }

    protected function sendLoginResponse(Request $request, string $token)
    {
        //$this->clearLoginAttempts($request);
        return $this->authenticated($request, $this->guard()->user(), $token);
    }

    protected function authenticated(Request $request, $user, string $token)
    {
        return response()->json([
            'token' => $token,
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json([
            'message' => Lang::get('auth.failed'),
        ], 401);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return 'Bye...';
    }

    public function login_service(Request $request)
    {
        $this->Validate($request,[
            'cedula' => 'required|numeric',
            'password' => 'required|string',
        ]);


        $url = "http://190.145.4.62/WebServices/WSlogin.asmx/Logeo?pEntidad=FONSODI&pIdentificacion=".$request->cedula."&pClave=".$request->password."&pTipoUsuario=2";
        $url = str_replace(" ", "%20", $url);
        $response_xml_data = file_get_contents($url);
        $xml = simplexml_load_string($response_xml_data);

        if($xml == 'true'){

          $usuario_cedula = Users_detalle::where('cedula',$request->cedula)->first();

          if (!empty($usuario_cedula)) {
            $url_datos = "http://190.145.4.62/WebServices/WSEstadoCuenta.asmx/ConsultarDatoBasicosPersona?pEntidad=FONSODI&pIdentificador=".$request->cedula."&pTipo=Identificacion";
            $response_xml_datos = file_get_contents($url_datos);
            $xml_datos = simplexml_load_string($response_xml_datos);

            if ($xml_datos->estado != 'A') {
              session()->flash('message', 'Datos inválidos');
              return redirect('login');
            }


            $json = json_encode($xml_datos);
            $array = json_decode($json,TRUE);
            //return $array;

            $data = [
              'account_number' => (string)$xml_datos->cod_persona,
              'user_name' => (string)$xml_datos->email,
              'display_name' => (string)$xml_datos->primer_nombre.' '.$xml_datos->primer_apellido,
              'avatar' => 'Abigail',
              'first_name' => (string)$xml_datos->primer_nombre,
              'last_name' => (string)$xml_datos->primer_apellido,
              'email' => (string)$xml_datos->email,
              'active' => true,
              'identification' => (integer)$xml_datos->identificacion,
              'billing' => [array('country_locale' => 'CO',
                'state' => (string)$xml_datos->nomciudadresidencia,
                'city' => (string)$xml_datos->nomciudadresidencia,
                'address' =>  (string)$xml_datos->direccion,
                'zip_code' => (string)$xml_datos->codciudadresidencia,
                'phone_1' => (string)$xml_datos->telefono,
                'phone_2' => (string)$xml_datos->telefonoempresa) ],
              'shipping' => [array('country_locale' => 'CO',
                'state' => (string)$xml_datos->nomciudadresidencia,
                'city' => (string)$xml_datos->nomciudadresidencia,
                'address' =>  (string)$xml_datos->direccion,
                'zip_code' => (string)$xml_datos->codciudadresidencia,
                'phone_1' => (string)$xml_datos->telefono,
                'phone_2' => (string)$xml_datos->telefonoempresa)]
            ];

            return response()->json($data);


          }

        }else{
            
            $data = [
              'status' => 'login_error',
            ];

            return response()->json($data);
        }

    }

    public function getdatajson(){
       /*"account_number": "AC12HF3456", (string)
       "user_name": "email@midominio.com", (string)
       "display_name": "PEPITO PEREZ", (string)
       "avatar":"http://image.ws3.com/avatar.png", (string)
       "first_name": "Pepito", (string)
       "last_name": "Perez", (string)
       "email": "email@midominio.com", (string)
       "active": true, (boolean)
       "identification": "1049874563", (string)*/


        /*"country_locale": "US", (string) // Country code (ISO 3166)
        "state": "FLORIDA", (string)
        "city": "DORAL", (string)
        "address": "1770 NW 96 AVE", (string)
        "zip_code": "33172",(string)
        "phone_1": "4450000000", (string)
        "phone_2": "3112000000" (string)*/


      $data = [
        'account_number' => 'Abigail',
        'user_name' => 'Abigail',
        'display_name' => 'Abigail',
        'avatar' => 'Abigail',
        'first_name' => 'Abigail',
        'last_name' => 'Abigail',
        'email' => 'Abigail',
        'active' => true,
        'identification' => 'Abigail',
        'billing' => [
          'country_locale' => 'Abigail',
          'state' => 'CA',
          'city' => 'CA',
          'address' => 'CA',
          'zip_code' => 'CA',
          'phone_1' => 'CA',
          'phone_2' => 'CA'
        ],
        'shipping' => [
          'country_locale' => 'Abigail',
          'state' => 'CA',
          'city' => 'CA',
          'address' => 'CA',
          'zip_code' => 'CA',
          'phone_1' => 'CA',
          'phone_2' => 'CA'
        ]
      ];

      return response()->json($data);
    }



}
