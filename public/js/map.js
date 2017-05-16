var palleteScales = d3.scale.linear()
.domain([27, 894])
.range(["#ffebee", "#b71c1c"]);
var dataset={};

var b = {
  w: 100, h: 30, s: 3, t: 10
};

initializeMainBreadcrumb();
var g = d3.select("#mainsequence").select("#trail");
g.append("svg:polygon")
      .attr("points", MainBreadcrumbPoints)
      .style("fill", "#B9DCEE");

g.append("svg:text")
      .attr("x", (b.w + b.t) / 2)
      .attr("y", b.h / 2)
      .attr("dy", "0.35em")
      .attr("text-anchor", "middle")
      .text("South East Asia");

function initializeMainBreadcrumb() {
  // Add the svg area.
  var trail = d3.select("#mainsequence").append("svg:svg")
      .attr("width", 500)
      .attr("height", 50)
      .attr("id", "trail");
}

// Generate a string that describes the points of a breadcrumb polygon.
function MainBreadcrumbPoints(d, i) {
  var points = [];
  points.push("0,0");
  points.push(b.w + ",0");
  points.push(b.w + b.t + "," + (b.h / 2));
  points.push(b.w + "," + b.h);
  points.push("0," + b.h);
  if (i > 0) { // Leftmost breadcrumb; don't include 6th vertex.
    points.push(b.t + "," + (b.h / 2));
  }
  return points.join(" ");
}


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
