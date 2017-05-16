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
    <body class="background-img">
        <div class="container">
            <!-- title -->
            <div class="page-header">
                <h1> Threatened Animals of Southeast Asia</h1>
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
                            <img src="{{ asset('img/asian_elephant.jpg') }} " alt="Pic1">
                            <div class="carousel-desc">
                                <h4><i>Elephas maximus ssp. sumatranus</i></h4>
                                <p>
                                Due to conversions of forests into human settlement and agricultural areas, many of the Sumatran Elephant populations have come into serious conflicts with human. As the results, many wild elephants have been removed from the wild, or directly killed. In addition to killing related to conflicts, elephants are also targets of illegal killing for their ivory. Now, Sumatran Elephant lives only in seven provinces, many of which are under increased pressure of habitat loss and imminent conflicts with human.
                                </p>
                            </div>
                          </div>

                          <div class="item">
                            <img src="{{ asset('img/green_sawfish.jpg') }}" alt="Pic2">
                            <div class="carousel-desc">
                                <h4><i>Pristis zijsron</i></h4>
                                <p>
                                Fishing is the primary threat to Green Sawfish. The large, toothed rostrum is easily entangled in fishing nets and other gear. In particular, inshore gillnet and trawl fisheries, which are common and intensive throughout much of the range of Green Sawfish, pose the greatest threat. Other threats to Green Sawfish include habitat loss (particularly loss of intertidal areas, and coastal development), pollution, loss of genetic diversity and climate change. However, relative to fishing, these threats are unlikely to substantially affect global status.
                                </p>
                            </div>
                          </div>

                          <div class="item">
                            <img src="{{ asset('img/pseudibis_davisoni.jpg') }}" alt="Pic3">
                            <div class="carousel-desc">
                                <h4>Pseudibis davisoni</h4>
                                <p>
                                It has declined as a result of habitat loss, through logging, widespread piecemeal clearance of lowland forest, conversion of wetlands for agriculture (most of the Mekong floodplain in southern Laos has been converted to rice-paddy) and agro-industrial and infrastructure development (BirdLife International 2010). Habitat loss has been compounded by hunting of adult birds, eggs and chicks for food, and disturbance, leading to the loss of secure feeding, roosting and nesting areas (T. Clements in litt. 2007)
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
                    @include ('partials.treemap')
                </div>

               <!-- population trend -->
               <div class="col-md-4">
                    <h4> Population Trend</h4>
                    @include('partials.population')
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
