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

        <!-- d3js -->
        <script src="https://d3js.org/d3.v3.min.js"></script>
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
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                          <li data-target="#myCarousel" data-slide-to="1"></li>
                          <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                          <div class="item active">
                            <img src="{{ asset('img/sample_image.jpg') }} " alt="Pic1">
                            <div class="carousel-desc">
                                <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Curabitur id sapien mauris. Nam eget mattis arcu.
                                Maecenas vel erat leo. Curabitur porta, nisl ut ultrices consequat, nibh orci efficitur diam, eget molestie arcu ex vitae justo.
                                </p>
                            </div>
                          </div>

                          <div class="item">
                            <img src="{{ asset('img/sample_image.jpg') }}" alt="Pic2">
                            <div class="carousel-desc">
                                <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Curabitur id sapien mauris. Nam eget mattis arcu.
                                Maecenas vel erat leo. Curabitur porta, nisl ut ultrices consequat, nibh orci efficitur diam, eget molestie arcu ex vitae justo.
                                </p>
                            </div>
                          </div>

                          <div class="item">
                            <img src="{{ asset('img/sample_image.jpg') }}" alt="Pic3">
                            <div class="carousel-desc">
                                <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Curabitur id sapien mauris. Nam eget mattis arcu.
                                Maecenas vel erat leo. Curabitur porta, nisl ut ultrices consequat, nibh orci efficitur diam, eget molestie arcu ex vitae justo.
                                </p>
                            </div>
                          </div>
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                          <span class="glyphicon glyphicon-chevron-left"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                          <span class="glyphicon glyphicon-chevron-right"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>

                    </div>
                </div>
            </div>

            <div class="row" style="margin-top:20px">
               <!-- threats -->
               <div class="col-md-4">
                    <h4> Threats </h4>
                    @include ('partials.threats')
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

<style>
.carousel-inner > .item > img {
  width:360px;
  height:200px;
}

.carousel-inner > .item > .carousel-desc {
  height: 200px;
  background: #f8f8ff;
  padding:20px;
}

.carousel-control.left, .carousel-control.right {
    background-image: none
}
</style>
