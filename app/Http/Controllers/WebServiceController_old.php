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
use Validator, DB, Hash, Mail,Auth;;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;

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
             $consumoData = ['status' => 'user_not_exist'];
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


}
