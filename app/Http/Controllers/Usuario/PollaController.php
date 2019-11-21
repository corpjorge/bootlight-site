<?php

namespace App\Http\Controllers\Usuario;

use DB;
use Mail;
use Auth;
use Illuminate\Http\Request;
use App\Model\Usuario\Polla;
use App\Model\Usuario\Users_detalle;
use App\Http\Controllers\Controller;
use App\Model\solicitudProducto\p_solicitud;
use App\Mail\SolicitudProducto\Polla as Email;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class PollaController extends Controller
{
    public function index()
    {
        return view('vendor.polla.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            
        $counts = Polla::select('count')
                    ->where('user_id',Auth::user()->id)
                    ->get();
           
          //dd($counts->count());
          /**
          * La variable $counts recupera las predicciones que tiene el usuario autenticado
          * En el condicional con la funcion count(), sumamos el campo count de la tabla pollas,
          * el cual se guarda con el valor de  1 cuando la prediccion llega a la base de datos.
          * Si el campo count suma 2 lo redericciona al home
          */
       
        if($counts->count() < 4){
            $usuario = Users_detalle::where('user_id',Auth::user()->id)->first();
            $tiendas = DB::table('tiendas')->get();
            $campeones = DB::table('campeons')->get();
            $subcampeones = DB::table('subcampeons')->get();
            return view('vendor.polla.create', compact('usuario', 'tiendas', 'campeones', 'subcampeones'));
            
        }else{
             return redirect()->back();
        }
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->Validate($request,[
            'campeon_id' => 'required',
            'campeon_goles' => 'required|numeric',
            'subcampeon_id' => 'required|distinct:$this->campeon_id',
            'subcampeon_goles' => 'required|numeric|min:$this->campeon_goles', 
            'coutas' => 'required|in:1,2'
        ]); 
        
        $polla = new Polla;
        $polla->campeon_id = $request->campeon_id;
        $polla->campeon_goles = $request->campeon_goles;
        $polla->subcampeon_id = $request->subcampeon_id;
        $polla->subcampeon_goles = $request->subcampeon_goles;
        $polla->cedula = $request->cedula;
        $polla->cod_asociado = $request->cod_asociado;
        $polla->celular = $request->celular;
        $polla->terminos = TRUE;
        $polla->coutas = $request->coutas;
        $polla->tienda_id = $request->tienda_id;
        $polla->user_id = Auth::user()->id;
        $polla->count++;
        $polla->save();
        
        $url_datos = "http://190.145.4.62/WebServices/WSEstadoCuenta.asmx/ConsultarDatoBasicosPersona?pEntidad=FONSODI&pIdentificador=".$request->cedula."&pTipo=Identificacion";
        $response_xml_datos = file_get_contents($url_datos);
        $xml_datos = simplexml_load_string($response_xml_datos);  
        $email = (string)$xml_datos->email; 
        Mail::send(new Email($email,$polla));
        
        session()->flash('message', 'Tu inscripción se efectuó correctamente');
       
        return redirect('home');
    }
    
    public function polla()
    {
        $pollas = Polla::all();
      
        foreach ($pollas as $polla) {

            $predictions[] = $tabla = [
                'Campeon' => $polla->campeon->name,
                'Goles campeon' => $polla->campeon_goles,
                'Subcampeon' => $polla->subcampeon->name,
                'Goles subcampeon' => $polla->subcampeon_goles,
                'Coutas' => $polla->coutas,
                'Codigo asociado' => $polla->cod_asociado,
                'Cedula asociado' => $polla->cedula,
                'Celular asociado' => $polla->celular,
                'Terminos' => $polla->terminos,
                'Tienda' => $polla->tienda->name,
                'Usuario' => $polla->user->name
            ];

        }         
        Excel::create('polla',function ($excel) use ($predictions) {
                $excel->sheet('usuarios',function ($sheet) use ($predictions) {
                        $sheet->fromArray($predictions);
                    }
                );
            }
        )->export('xls'); 
    }

}
