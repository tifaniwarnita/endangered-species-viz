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
      .center([120, 6.5])
      .rotate([4.4, 0])
      .scale(680)
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
  console.log(country);
  d3.selectAll('.datamaps-subunit').style("opacity", 0.2);
  d3.select(this).style("opacity", 1);
  var countryCode;
  switch (country.id) {
        case "BRN": countryCode = 'BN'; break;
        case "IDN": countryCode = 'ID'; break;
        case "KHM": countryCode = 'KH'; break;
        case "TLS": countryCode = 'TL'; break;
        case "LAO": countryCode = 'LA'; break;
        case "MYS": countryCode = 'MY'; break;
        case "MMR": countryCode = 'MM'; break;
        case "PHL": countryCode = 'PH'; break;
        case "SGD": countryCode = 'SG'; break;
        case "THA": countryCode = 'TH'; break;
        case "VNM": countryCode = 'VN'; break;
        default: break;
  }

  d3.selectAll('.popCountry')
    .transition()
    .duration(500)
    .style("opacity", 0.2);

  d3.selectAll('.country' + countryCode)
    .transition()
    .duration(500)
    .style("opacity", 1);

  threatUrl = baseUrl + '?country=' + countryCode;
  typeUrl = baseTypeUrl + '?country=' + countryCode;

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

  d3.json(typeUrl, function(err, res) {
    d3.select('#treemap').selectAll("svg").remove();
      if (!err) {
        console.log(res);
        var data = res;
        main({title: ""}, {key: "All Types", values: data});
      }
  });

  $("#countrytrail").text(countries[countryCode]).show();
});

$("#seatrail").click(function() {
  $("#countrytrail").hide();
  d3.selectAll('.datamaps-subunit')
    .transition()
    .duration(500)
    .style("opacity", 1);

  threatUrl = baseUrl;
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

  d3.json(baseTypeUrl, function(err, res) {
    d3.select('#treemap').selectAll("svg").remove();
      if (!err) {
        console.log(res);
        var data = res;
        main({title: ""}, {key: "All Types", values: data});
      }
  });

  d3.selectAll('.popCountry')
    .transition()
    .duration(500)
    .style("opacity", 1);
});


