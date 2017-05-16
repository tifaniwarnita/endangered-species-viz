<link rel="stylesheet" type="text/css" href="{{ asset('css/breadcrumb.css') }}"/>
<div id="mainsequence">
    <div class="row">
        <div class="col-md-6">
            <ul class="steps steps-5">
              <li id="seatrail">South East Asia</li>
              <li id="countrytrail" hidden>Country</li>
            </ul>
        </div>
        <div id="mainlegend" class="col-md-6" style="padding-top: 5px">
        <svg width="300" height="25">
            <g class="mainlegend" transform="translate(0,0)" id="legendCR" >
                <rect x="2" y="1" width="20" height="20" style="fill: rgb(241, 93, 93); cursor: pointer;"></rect>
                <text x="25" y="10" dy=".35em" style="text-anchor: start;">Critically Endangered</text>
            </g>
            <g class="mainlegend" transform="translate(130,0)" id="legendEN" >
                <rect x="2" y="1" width="20" height="20" style="fill: rgb(210, 133, 97); cursor: pointer;"></rect>
                <text x="25" y="10" dy=".35em" style="text-anchor: start;">Endangered</text>
            </g>
            <g class="mainlegend" transform="translate(220,0)" id="legendVU" >
                <rect x="2" y="1" width="20" height="20" style="fill: rgb(227, 209, 199); cursor: pointer;"></rect>
                <text x="25" y="10" dy=".35em" style="text-anchor: start;">Vulnerable</text>
            </g>
        </svg>
        </div>
    </div>
</div>
<div id="zoom_map" style="position: relative; height: 400px;"></div>
<div id="check"></div>
<script src="//cdnjs.cloudflare.com/ajax/libs/topojson/1.6.9/topojson.min.js"></script>
<script type="text/javascript" src="{{ asset('js/datamaps.world.min.js') }}"></script>

<script type="text/javascript" src="{{asset('js/map.js')}}"></script>
