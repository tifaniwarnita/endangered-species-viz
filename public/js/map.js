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
      'Threated species: ' + data.numberOfThings + '</div>';
    },
    highlightFillColor: '#2196F3',
  },
});

d3.selectAll('.datamaps-subunit').on('click', function(country) {
  d3.selectAll('.datamaps-subunit').style("opacity", 0.2);
  d3.select(this).style("opacity", 1);
  switch (country.id) {
        case "BRN": threatUrl = baseUrl + '?country=BN'; break;
        case "IDN": threatUrl = baseUrl + '?country=ID'; break;
        case "KHM": threatUrl = baseUrl + '?country=KH'; break;
        case "TLS": threatUrl = baseUrl + '?country=TL'; break;
        case "LAO": threatUrl = baseUrl + '?country=LA'; break;
        case "MYS": threatUrl = baseUrl + '?country=MY'; break;
        case "MMR": threatUrl = baseUrl + '?country=MM'; break;
        case "PHL": threatUrl = baseUrl + '?country=PH'; break;
        case "SGD": threatUrl = baseUrl + '?country=SG'; break;
        case "THA": threatUrl = baseUrl + '?country=TH'; break;
        case "VNM": threatUrl = baseUrl + '?country=VN'; break;
        default: break;
  }

  d3.json(threatUrl, function(json) {
    d3.select('#chart').selectAll("svg").remove();
    width = 300;
    height = 240;
    radius = Math.min(width, height) / 2;

    vis = d3.select("#chart").append("svg:svg")
        .attr("width", width)
        .attr("height", height)
        .append("svg:g")
        .attr("id", "container")
        .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

    partition = d3.layout.partition()
        .size([2 * Math.PI, radius * radius])
        // .sort(function(a, b) { return d3.ascending(a.name, b.name); })
        .value(function(d) { return d.size; });

    arc = d3.svg.arc()
        .startAngle(function(d) { return d.x; })
        .endAngle(function(d) { return d.x + d.dx; })
        .innerRadius(function(d) { return Math.sqrt(d.y); })
        .outerRadius(function(d) { return Math.sqrt(d.y + d.dy); });
    createVisualization(json);
  });
});
