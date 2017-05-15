<div id="zoom_map" style="position: relative; height: 400px;"></div>
<script src="//cdnjs.cloudflare.com/ajax/libs/topojson/1.6.9/topojson.min.js"></script>
<script type="text/javascript" src="{{ asset('js/datamaps.world.min.js') }}"></script>

<script>
var zoom = new Datamap({
  element: document.getElementById("zoom_map"),
  scope: 'world',
  // Zoom in on SEA
  setProjection: function(element) {
    var projection = d3.geo.equirectangular()
      .center([125, 7])
      .rotate([4.4, 0])
      .scale(650)
      .translate([element.offsetWidth / 2, element.offsetHeight / 2]);
    var path = d3.geo.path()
      .projection(projection);

    return {path: path, projection: projection};
  },
  geographyConfig: {
   popupTemplate: function(geography, data) {
      return '<div class="hoverinfo"><b>' + geography.properties.name + '</b><br/>' +
      'Jumlah threatened';
    }
  },
  fills: {
    defaultFill: '#afa99a',
    red: '#d32c38'
  },
  data: {
    BRN: {fillKey: 'defaultFill'},
    KHM: {fillKey: 'defaultFill'},
    TLS: {fillKey: 'defaultFill'},
    IDN: {fillKey: 'red'},
    LAO: {fillKey: 'defaultFill'},
    MYS: {fillKey: 'defaultFill'},
    MMR: {fillKey: 'defaultFill'},
    PHL: {fillKey: 'defaultFill'},
    SGP: {fillKey: 'defaultFill'},
    THA: {fillKey: 'defaultFill'},
    VNM: {fillKey: 'defaultFill'},
  }
});
</script>
