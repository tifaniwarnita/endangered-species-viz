var palleteScales = d3.scale.linear()
.domain([27, 894])
.range(["#ffebee", "#b71c1c"]);
var dataset={};

$.getJSON('species/data', function(json){
    $.each(json, function (i, item){
      var iso = item.Country, value = item.Count;
      var iso2;
      switch(iso){
        case "BN":
                  iso2 = "BRN";
                  break;
        case "ID":
                  iso2 = "IDN";
                  break;
        case "KH":
                  iso2 = "KHM";
                  break;
        case "TL":
                  iso2 = "TLS";
                  break;
        case "LA":
                  iso2 = "LAO";
                  break;
        case "MY":
                  iso2 = "MYS";
                  break;
        case "MM":
                  iso2 = "MMR";
                  break;
        case "PH":
                  iso2 = "PHL";
                  break;
        case "SG":
                  iso2 = "SGP";
                  break;
        case "TH":
                  iso2 = "THA";
                  break;
        case "VN":
                  iso2 = "VNM";
                  break;
        default:
          break;
      }
      if (value=="0"){} else
      {
        dataset[iso2] = {fillColor: palleteScales(value), numberOfThings: value};
        zoom.updateChoropleth(dataset);
      };
    });
});

var zoom = new Datamap({
  element: document.getElementById("zoom_map"),
  scope: 'world', 
  fills: {
    defaultFill: '#afa99a',
  },
  data: dataset,
  dataType: 'json',
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
      'Jumlah threatened ' + data.numberOfThings + '</div>';
    },
    highlightFillColor: '#2196F3',
  },

  //insert on click function
  done: function(datamap){
    datamap.svg.selectAll('.datamaps-subunit').on('click', function(geography){
      // change the alert with other function for onclick
      var localdata = datamap.options.data[geography.id];
      changeColor(geography.id, localdata.numberOfThings);
    });
  },
});

function changeColor(colourid, value1){
  var dataset2 = {};
  
  dataset2[colourid] = {fillColor: palleteScales(value1), numberOfThings: value1};
  zoom.updateChoropleth(dataset2, {reset: true});
}