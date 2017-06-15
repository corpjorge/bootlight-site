<!DOCTYPE html>
<html lang="es">
  <head>
		<title>Clasificados</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<style>
body {
  min-height: 75rem; /* Can be removed; just added for demo purposes */
}

.navbar {
  margin-bottom: 0;
}

.jumbotron {
  padding-top: 6rem;
  padding-bottom: 6rem;
  margin-bottom: 0;
  background-color: #fff;
}

.jumbotron p:last-child {
  margin-bottom: 0;
}

.jumbotron-heading {
  font-weight: 300;
}

.jumbotron .container {
  max-width: 40rem;
}

.album {
  min-height: 50rem; /* Can be removed; just added for demo purposes */
  padding-top: 3rem;
  padding-bottom: 3rem;
  background-color: #ffffff;
}

.card {
  float: left;
  width: 50%;
	height: 300px;
  padding: 5px;
  margin-bottom: 2rem;
  border: 0;
}

.card > img {
  margin-bottom: .75rem;
}

.card-text {
  font-size: 85%;
}

footer {
  padding-top: 3rem;
  padding-bottom: 3rem;
}

footer p {
  margin-bottom: .25rem;
}

</style>

  </head>
  <body>
      <div class="container">
        <p><br>
          <a href="http://portal.fonsodi.com/" target="_blank" class="btn btn-primary">Publica tu clasificado</a>
        </p>
      </div>

    <div class="album text-muted">
      <div class="container">
        @foreach ($clasificados as $clasificado)
        @if($clasificado->estado_id == 1)
        <div class="row"  >
          <div class="card">
            <?php  $url = Storage::url($clasificado->imagen)?>
            <img src="{{$url}}" alt="" style="width: 100%;">
					</div>
					<div class="card">

            <h2>{{$clasificado->titulo}}</h2><br>
						  <p class="card-text">{{$clasificado->descripcion}}</p>
              <p class="card-text">{{$clasificado->contacto}}</p>
          </div>
				</div>
				<br><br><hr><br>
        @endif
        @endforeach

        </div>

      </div>
    </div>

  </body>
</html>
