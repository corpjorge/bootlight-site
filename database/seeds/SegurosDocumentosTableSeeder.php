<?php

use Illuminate\Database\Seeder;
use App\Model\Seguro\Seguros_documento;

class SegurosDocumentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //hogar
        $user = new Seguros_documento();
        $user->seguros_producto_id = "1";
        $user->nombre = "formulario autorizacion ley de proteccion de datos";
        $user->tipo = "pdf";
        $user->save();

        $user = new Seguros_documento();
        $user->seguros_producto_id = "1";
        $user->nombre = "formulario autorizacion ley de proteccion de datos (asegurado)";
        $user->tipo = "pdf";
        $user->save();

        $user = new Seguros_documento();
        $user->seguros_producto_id = "1";
        $user->nombre = "Cedula Colaborado";
        $user->save();

        $user = new Seguros_documento();
        $user->seguros_producto_id = "1";
        $user->nombre = "Cedula Propietario";
        $user->save();

        //soap
        $user = new Seguros_documento();
        $user->seguros_producto_id = "2";
        $user->nombre = "formulario autorizacion ley de proteccion de datos";
        $user->tipo = "pdf";
        $user->save();

        $user = new Seguros_documento();
        $user->seguros_producto_id = "2";
        $user->nombre = "formato de solicitud soat";
        $user->tipo = "pdf";
        $user->save();

        $user = new Seguros_documento();
        $user->seguros_producto_id = "2";
        $user->nombre = "Tarjeta de propiedad";
        $user->save();

        $user = new Seguros_documento();
        $user->seguros_producto_id = "2";
        $user->nombre = "Soat";
        $user->save();

        $user = new Seguros_documento();
        $user->seguros_producto_id = "2";
        $user->nombre = "Cedula";
        $user->save();

        //Vehiculo nuevo
        $user = new Seguros_documento();
        $user->seguros_producto_id = "3";
        $user->nombre = "formulario autorizacion ley de proteccion de datos";
        $user->tipo = "pdf";
        $user->save();

        $user = new Seguros_documento();
        $user->seguros_producto_id = "3";
        $user->nombre = "formato de inclusion auto";
        $user->tipo = "pdf";
        $user->save();

        $user = new Seguros_documento();
        $user->seguros_producto_id = "3";
        $user->nombre = "Factura Proforma";
        $user->save();

        $user = new Seguros_documento();
        $user->seguros_producto_id = "3";
        $user->nombre = "Cedula del asegurado";
        $user->save();

        $user = new Seguros_documento();
        $user->seguros_producto_id = "3";
        $user->nombre = "Cedula";
        $user->save();

        //Vehiculo Usado
        $user = new Seguros_documento();
        $user->seguros_producto_id = "4";
        $user->nombre = "formulario autorizacion ley de proteccion de datos";
        $user->tipo = "pdf";
        $user->save();

        $user = new Seguros_documento();
        $user->seguros_producto_id = "4";
        $user->nombre = "formato de inclusion auto";
        $user->tipo = "pdf";
        $user->save();

        $user = new Seguros_documento();
        $user->seguros_producto_id = "4";
        $user->nombre = "Soat";
        $user->save();

        $user = new Seguros_documento();
        $user->seguros_producto_id = "4";
        $user->nombre = "Tarjeta de propiedad";
        $user->save();

        $user = new Seguros_documento();
        $user->seguros_producto_id = "3";
        $user->nombre = "Contrato compra venta";
        $user->save();

        $user = new Seguros_documento();
        $user->seguros_producto_id = "4";
        $user->nombre = "Cedula colaborador";
        $user->save();

    }
}
