<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/polla/Brasil.ico')}}">
    <title>Apoye y Gane</title>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{asset('css/kit.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome/css/font-awesome.css')}}">
</head>

<body class="profile-page">
<header>
    <nav>
        <a href="{{url('home')}}"><img src="{{asset('img/Brasil.jpg')}}" alt="" id="logo-1"></a>
        <ul>
            <li><a href="">Bienvenido a APOYANDO Y GANANDO</a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
        </ul>
        <img src="{{asset('img/Brasil.jpg')}}" alt="" id="logo">
        <ul>
            <li><a href=""></a></li>
            <li><a href="">{{strtoupper(Auth::user()->name)}}</a></li>
            <li><a href="{{url('home')}}">REGRESAR</a></li>
        </ul>
    </nav>
</header>
<div class="page-header header-filter" data-parallax="true"
     style="background-image: url('../img/Copa.jpg');"></div>
<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="col-6 ml-auto mr-auto">
                    <div class="profile">
                        <div class="avatar">
                            <!--img src="../img/Brasil.jpg" alt="Circle Image" class="img-raised rounded-circle img-fluid"-->
                            <br><br><br><br>
                        </div>
                    </div>
                </div>
            </div>
            @if($errors->any())
                <div class="alert alert-danger">
                    <div class="container">
                        <div class="alert-icon">
                            <i class="material-icons">error_outline</i>
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="material-icons">clear</i></span>
                        </button>
                        <b>Hubo errores al diligenciar el formulario</b>
                    </div>
                </div>
            @endif
            @if(Session::has('message'))
                <div class="alert alert-success">
                    <div class="container">
                        <div class="alert-icon">
                            <i class="material-icons">check</i>
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="material-icons">clear</i></span>
                        </button>
                        <b>{{Session::get('message')}}</b>
                    </div>
                </div>
            @endif

            <p style="text-align: center;"><h3><b>VALOR DE PARTICIPACIÓN $10.000. Recuerde que puede realizar dos predicciones por participación, elija su primera opción y luego ingrese a completar su segunda elección.</b></p></h3>
            <div class="row">
                <div class="col-10 ml-auto mr-auto">
                    <div class="card">
                        <div class="card-header-info">
                            <h3 style="text-align: center;">Predicción Final Copa America Brasil 2019</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button class="btn btn-outline-info" style="right: 0; left: auto;"
                                                data-toggle="modal" data-target="#myModal">
                                            Reglamento
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <form action="{{route('predictions.store')}}" method="POST" name="form">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Numero de Cuotas</label>
                                            <select name="coutas" id="" class="form-control" required>
                                                <option value="">..::Seleccione::..</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tienda</label>
                                            <select name="tienda_id" id="" class="form-control" required>
                                                <option value="">..::Seleccione::..</option>
                                                @foreach ($tiendas as $tienda)
                                                <option value="{{$tienda->id}}">{{$tienda->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Número Celular</label>
                                            <input type="number" class="form-control" name="celular" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <input type="hidden" class="form-control" name="cod_asociado" value="{{ $usuario->cod_persona }}">
                                <input type="hidden" class="form-control" name="cedula" value="{{ $usuario->cedula }}">
                                        
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Campeón</label>
                                            <select name="campeon_id" id="campeon_id" class="form-control" required>
                                                <option value="">..::Seleccione::..</option>
                                                @foreach($campeones as $pais)
                                                    <option value="{{$pais->id}}">{{$pais->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Sub-Campeón</label>
                                            <select name="subcampeon_id" id="subcampeon_id" class="form-control" required>
                                                <option value="">..::Seleccione::..</option>
                                                @foreach($subcampeones as $pais)
                                                    <option value="{{$pais->id}}">{{$pais->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Goles Campeón</label>
                                            <input type="number" class="form-control" name="campeon_goles" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Goles Sub-Campeón</label>
                                            <input type="number" class="form-control" name="subcampeon_goles" required >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="true"
                                                       name="terminos" checked required>
                                                Autorización: Protección de datos y el descuento por nómina
                                                <span class="form-check-sign">
                                                    <span class="check"></span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <button class="btn btn-info btn-block" type="button"  onclick="validar()">Enviar Registro</button>
                            </form>
                            <br>
                            <p><b>* SOLO SE PUEDE TENER COMO MÁXIMO DOS PARTICIPACIONES </b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>TÉRMINOS Y CONDICIONES “POLLA: APOYANDO Y GANANDO”
COPA AMERICA BRASIL 2019
</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">clear</i>
                </button>
            </div>
            <div class="modal-body">
                <hr>
                <p>La Polla “APOYANDO Y GANANDO” es una actividad de bienestar e integración, que busca que los participantes pronostiquen las selecciones de futbol participantes en el partido de la final de la COPA AMÉRICA BRASIL 2019, acertando el CAMPEON y SUBCAMPEON. Esta actividad es exclusiva para los asociados del FONDO DE EMPLEADOS DE SODIMAC COLOMBIA – FONSODI, los cuales podrán participar a nivel nacional a través de la página web 
                    <a href="www.fonsodi.com">www.fonsodi.com</a> ingresando a la oficina virtual, en donde se encuentra 
                    toda la información de dicha actividad.

                    A continuación detallamos los términos y condiciones:

                <p><b>Primera:</b> Nombre del Evento. “POLLA: APOYANDO Y GANANDO”.</p>
                <p><b>Segunda:</b> Responsable: El organizador y responsable de la Polla es FONSODI, quien para efectos del presente documento se denominará ORGANIZADOR.
                </p>
                <p><b>Tercera:</b> Participantes en el evento: Podrán participar todos los asociados activos, que se inscriban durante las fechas estipuladas.
                </p>
                <p><b>Cuarta:</b> Vigencia del Evento: La Polla: “APOYANDO Y GANANDO” iniciará el martes 04 de junio con la inscripción de los participantes, y terminará el 12 de julio con la entrega del premio al ganador o ganadores de la misma.
                </p>

                <p><b>Inscripciones:</b> Martes 04 de junio desde las 3:00pm hasta el domingo 17 de junio a las 11:59 pm de 2019.</p>
                <p>Los participantes serán publicados el martes 19 de junio en <a href="www.fonsodi.com">www.fonsodi.com</a>
                </p>
                <p>El 04 de julio serán publicados los asociados que acertaron con los equipos en el partido de la final.</p>
                <p>El 08 de Julio serán publicado el ganador o los ganadores de la polla.</p>
                <p>El 12 de Julio será entregado el premio.</p>
                <p><b>Quinta:</b> Inscripciones:</p>

                <p><b>Valor por inscripciones:</b> $ 10.000 pesos M/cte. (Se podrán realizar máximo dos (2) inscripciones por asociado)</p>
                <p><b>Forma de pago:</b> El valor de inscripción se podrá diferir a un máximo de dos cuotas. </p>
                <p><b> Inscripción:</b> Los asociados deberán inscribirse en <a href="www.fonsodi.com">www.fonsodi.com</a>
                    , ingresando a la oficina virtual, en el módulo “apoyando y ganando”, diligenciando el formulario de participación y autorizando el descuento por nómina del valor de la polla. La inscripción es voluntaria, por lo que el asociado debe registrar su información personal y dar respuesta a las preguntas de seguridad. Tiene el carácter de sensible y con ella no se afecta o se vulnera el derecho a la intimidad en cumplimiento de la Ley 1581 de 17 de octubre de 2012, de Protección de Datos de Carácter Personal y su normativa de desarrollo, hemos implementado procedimientos y políticas para tratar, recolectar, almacenar, usar, procesar y/o compartir datos personales, que serán incorporados en una base de datos de propiedad del ORGANIZADOR.</p>
                <p><b>Parágrafo 1:</b> Entre los asociados que se inscriba se rifara 1 Balón oficial de la copa América de Brasil. Una vez termine la etapa de la inscripción.  </p>
                <p><b>Parágrafo 2:</b> La rifa se llevará a cabo en las instalaciones de FONSODI una vez se termine la etapa de las inscripciones. </p>
                <p><b>Sexta:</b> Dinámica: los asociados una vez inscritos deberán escoger las dos (2) selecciones de Futbol de su preferencia acertando el partido de la final de la COPA AMERICA BRASIL 2019 y adicional deben indicar el marcador de dicho partido final.
                </p>
                <p><b>Parágrafo 1:</b> El asociado puede tener la posibilidad de escoger dos posibles finales con una sola inscripción.  </p>
                <p><b>Parágrafo 2:</b> Este marcador se utilizará en caso de haber varios ganadores que acierten con el partido de la final, 
                como ítem definitivo para la entrega del premio. </p>
                <p><b> Séptima: Premiación:</b> el valor del premio es de $ 600.000 m/cte., el cual se entregará al asociado que haya acertado el partido de la final indicando cual será el Campeón y el subcampeón. 
                </p>
                <p><b> Parágrafo 1:</b> En caso de existir más de un (1) ganador se definirá entre ellos por el marcador del partido, colocado en el momento de la inscripción. Y si entre ellos hay varios asociados que acierten el mismo marcador, se dividirá el premio equitativamente entre los ganadores.
                </p>
                <p><b>Parágrafo 2: </b> En caso de que no exista un ganador, del dinero aportado por cada inscripción será, abonado el 60% del valor de la inscripción a un ahorro a la vista para cada asociado participante.
                </p>
                <p><b> Octavo:</b> Entes de Control y Vigilancia: El ORGANIZADOR se encargará del control de la actividad, de su publicidad, de las inscripciones, de la información captada a través de la página web, y de la entrega de los premios. Así mismo EL ORGANIZADOR tendrá como ente de Vigilancia al comité de control social, quienes se encargarán de garantizar la transparencia y desarrollo de la actividad.
                </p>

                <p>Todos estos términos y restricciones podrán ser modificados y comunicados a todos los asociados durante la vigencia de la actividad, sin perjuicio alguno para el ORGANIZADOR.
En constancia se firma en Bogotá a los Veintisiete (27) días del mes de mayo de 2019 y tendrá vigencia hasta 12 de julio con la entrega del cuando se entregue el premio.

                </p>
                <hr>
                <p class="text-center"><b>MAGALY GALVIS ZULETA-
                        GERENTE
                    </b></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->
<footer class="footer ">
    <div class="container">
        <div class="copyright">
            &copy; 2019
            por
            <b>FYCLS Ingeniería</b>
        </div>
    </div>
</footer>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/popper.js')}}"></script>
<script src="{{asset('js/kit.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>
<script>
    $(document).ready(function () {
        
        var scroll;
        $(window).scroll(function () {
            scroll = $(window).scrollTop();
            if (scroll > 60) {
                $("#logo").css({
                    "margin-top": "5px",
                    "width": "50px",
                    "height": "50px"
                });
                $("header").css({
                    "background-color": "#a21309"
                });
            } else {
                $("#logo").css({
                    "margin-top": "250px",
                    "width": "125px",
                    "height": "125px"
                });
                $("header").css({
                    "background-color": "transparent"
                });
            }
        });
    });
    
    function validar(){
        var campeon = $('select[name="campeon_id"]').val();
        var subcampeon = $('select[name="subcampeon_id"]').val();
        var goles_campeon = $('input[name="campeon_goles"]').val();
        var goles_subcampeon = $('input[name="subcampeon_goles"]').val();
        
        if (campeon == subcampeon){
              alert('Los equipos deben de ser diferentes...');
        }else if (goles_campeon < goles_subcampeon){
              alert('El campeon debe de tener mas goles...');
        }else{
              document.form.submit();
        }
        
    }
    
    
</script>
</body>
</html>