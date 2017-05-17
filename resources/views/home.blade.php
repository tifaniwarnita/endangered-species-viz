<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Endangered Animal</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato|Roboto+Slab" rel="stylesheet">

        <!-- Stylesheet -->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('lib/bootstrap/dist/css/bootstrap.min.css') }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/grayscale.css') }}" rel="stylesheet">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="{{ asset('lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>

        <!-- d3js -->
        <script src="https://d3js.org/d3.v3.min.js"></script>


        <script src="{{ asset('js/smooth-scroll.min.js') }}"></script>

    </head>
    <body>
        <div id="background-carousel">
            <div id="hero" class="carousel slide carousel-fade" data-ride="carousel">
              <div class="carousel-inner carousel-hero">
                <div class="item active" style="background: url({{ asset('/img/hero/1.jpg') }}) no-repeat center scroll;"></div>
                <div class="item" style="background: url({{ asset('/img/hero/2.jpg') }}) no-repeat center scroll;"></div>
                <div class="item" style="background: url({{ asset('/img/hero/3.jpg') }}) no-repeat center scroll;"></div>
                <div class="item" style="background: url({{ asset('/img/hero/4.jpg') }}) no-repeat center scroll;"></div>
                <div class="item" style="background: url({{ asset('/img/hero/5.jpg') }}) no-repeat center scroll;"></div>
              </div>
            </div>
        </div>
        <div id="content-wrapper" class="intro">
            <div class="intro-body">
                <div class="container full-width">
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4 text-center">
                            <h1 class="brand-heading">Threatened Animals of Southeast Asia</h1>
                            <p class="intro-text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                            </p>
                            <a data-scroll href="#dashboard" class="btn btn-circle page-scroll">
                                <i class="fa fa-angle-double-down animated"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="height: 250px"></div>
        <div class="container" id="dashboard">
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
                        {{-- <ol class="carousel-indicators">
                          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                          <li data-target="#myCarousel" data-slide-to="1"></li>
                          <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol> --}}

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

            <script type="text/javascript" src="{{ asset('js/endangered-animals.js') }}"></script>

            <div class="row" style="margin-top:20px">
               <!-- class -->
                <div class="col-lg-4">
                    <h4> Class </h4>
                    @include ('partials.treemap')
                </div>

                <!-- threats -->
               <div class="col-lg-4">
                    <h4> Threats </h4>
                    @include ('partials.threats')
               </div>

               <!-- population trend -->
               <div id="population-trend" class="col-lg-4">
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

<script>
    smoothScroll.init();
</script>
