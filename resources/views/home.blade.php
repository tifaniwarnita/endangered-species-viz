<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Endangered Animal</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        

        <!-- Stylesheet -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('lib/bootstrap/dist/css/bootstrap.min.css') }}">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="{{ asset('lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    </head>
    <body>
        <div class="container">
           <!-- title -->
           <div class="page-header">
                <h1> Endangered Animals </h1>
                <p> of Southeast Asia </p>
           </div>

           <div class="row">
                <!-- map -->
                <div class="col-md-8">
                    @include ('partials.map')
                </div>
                
                <div class="col-md-4">
                    <div class="visible hidden-xs hidden-sm">
                        <!-- carousel -->
                        <div class="jumbotron">
                            <h2> Carousel </h2>
                        </div>
                        <!-- description -->
                        <div class="jumbotron">
                            <h3> Description </h3>
                        </div>
                    </div>
                </div>
           </div>

            <div class="row">
               <!-- threats -->
               <div class="col-md-4">
                    <h4> Threats </h4>
               </div>

               <!-- class -->
                <div class="col-md-4">
                    <h4> Class </h4>
                </div>

               <!-- population trend -->
               <div class="col-md-4">
                    <h4> Population </h4>
               </div>

            </div>

        </div>
    </body>
</html>
