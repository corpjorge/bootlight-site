<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Simulador\SimuladorLinea;
use App\Model\Simulador\SimuladorTasa;

class SimuladorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lineas = SimuladorLinea::all();
        $tasas = SimuladorTasa::all();
        return view('adminlte::usuario.simulador.simulador',[ 'lineas' => $lineas, 'tasas' => $tasas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $tasa = SimuladorTasa::where('simulador_linea_id', '=', $request->linea)
                             ->where('plazo_inicial', '<=', $request->meses)
                             ->where('plazo_final', '>=', $request->meses)->firstOrFail();

       $this->Validate($request,[
           'linea' => 'required|',
           'meses' => 'required|numeric',
           'monto1' => 'required|numeric',
       ]);

    $monto=str_replace(',','',$request->monto1);
    $anual = $tasa->valor/100;
    $mes = round(($anual/1), 6);

    if($request->meses == 0){
      $cuota = $request->monto1;
    	$inicial = $monto;
    	$final 	 = $monto;
    	$mesa = 0;
    	$total = $cuota;


    }else{
      $cuota = $monto / ((pow((1+$mes),  $request->meses)-1)/($mes*pow((1+$mes),  $request->meses)));
    	$inicial = $monto;
    	$final 	 = $monto;
      $mesa = 0;
    	$total = $cuota *  $request->meses;
    }
      $interesT= $total - $monto;
      $nombretasa = $tasa->simuladortasa_linea->name;
      $idline = $tasa->simuladortasa_linea->id;
      $valortasa = $tasa->valor;
      $meses = $request->meses;

      return view('adminlte::usuario.simulador.simulador_resultado',
      [ 'monto' => $monto, 'total' => $total,
        'interesT' => $interesT, 'meses' => $meses, 'final' => $final,
        'mes' => $mes, 'cuota' => $cuota, 'mesa' => $mesa, 'nombretasa' => $nombretasa,
        'valortasa' => $valortasa, 'idline' => $idline,
      ]);

    }

    public function invoice(Request $request)
      {

        $tasa = SimuladorTasa::where('simulador_linea_id', '=', $request->linea)
                               ->where('plazo_inicial', '<=', $request->meses)
                               ->where('plazo_final', '>=', $request->meses)->firstOrFail();

       $monto=str_replace(',','',$request->monto1);
       $anual = $tasa->valor/100;
       $mes = round(($anual/12), 6);
       if($request->meses == 0){

        $cuota = $request->monto1;
       	$inicial = $monto;
       	$final 	 = $monto;
       	$mesa = 0;
       	$total = $cuota;

       }else{

         $cuota = $monto / ((pow((1+$mes),  $request->meses)-1)/($mes*pow((1+$mes),  $request->meses)));
       	 $inicial = $monto;
       	 $final 	 = $monto;
         $mesa = 0;
       	 $total = $cuota *  $request->meses;

       }
         $interesT= $total - $monto;
         $nombretasa = $tasa->simuladortasa_linea->name;
         $idline = $tasa->simuladortasa_linea->id;
         $valortasa = $tasa->valor;
         $meses = $request->meses;

        $view =  \View::make('adminlte::usuario.simulador.simulador_resultado_pdf', [ 'monto' => $monto, 'total' => $total,
          'interesT' => $interesT, 'meses' => $meses, 'final' => $final,
          'mes' => $mes, 'cuota' => $cuota, 'mesa' => $mesa, 'nombretasa' => $nombretasa,
          'valortasa' => $valortasa, 'idline' => $idline,
        ]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //return $pdf->stream('simulador');
        return $pdf->download('simulador.pdf');

      }
}
