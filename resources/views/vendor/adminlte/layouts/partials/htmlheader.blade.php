<head>
    <meta charset="UTF-8">
    <title> Portal </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dropzone-master/dist/dropzone.css') }}" rel="stylesheet" type="text/css" />
    <style>
	    .none{
	        display:none;
	    }
    </style>
    <script type="text/javascript" src="{{ asset('dropzone-master/dist/dropzone.js') }}"></script>

    <!--<script src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
