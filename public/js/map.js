var palleteScales = d3.scale.linear()
.domain([27, 894])
.range(["#ffebee", "#b71c1c"]);

var dataset = {};

var main_legend_active = "0";

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
      .center([120, 5])
      .rotate([4.4, 0])
      .scale(750)
      .translate([element.offsetWidth / 2, element.offsetHeight / 2]);
    var path = d3.geo.path()
      .projection(projection);
    return {path: path, projection: projection};
  },
  geographyConfig: {
   popupTemplate: function(geography, data) {
      return '<div class="hoverinfo"><b>' + geography.properties.name + '</b><br/>' +
      'Threatened species: ' + data.numberOfThings + '</div>';
    },
    highlightFillColor: '#ffef66',
  },
});

function redrawThreat(json) {
  d3.select('#chart').selectAll("svg").remove();
    width = 300;
    height = 200;
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
}

function redrawPopulationTrend(populationUrl) {
  d3.select('#population-chart').selectAll("svg").remove();

  svg = d3.select("#population-chart").append("svg")
    .attr("width", 400)
    .attr("height", 210)
    .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

  tooltip = d3.select("body").append("div")
    .attr("class", "tooltip")
    .style("opacity", 0);

  drawStackedBar(populationUrl);
  updateStackBar();
}

d3.selectAll('.datamaps-subunit').on('click', function(country) {
  d3.selectAll('.datamaps-subunit').style("opacity", 0.2);
  d3.select(this).style("opacity", 1);

  switch (country.id) {
        case "BRN": countryCode = 'BN'; break;
        case "IDN": countryCode = 'ID'; break;
        case "KHM": countryCode = 'KH'; break;
        case "TLS": countryCode = 'TL'; break;
        case "LAO": countryCode = 'LA'; break;
        case "MYS": countryCode = 'MY'; break;
        case "MMR": countryCode = 'MM'; break;
        case "PHL": countryCode = 'PH'; break;
        case "SGP": countryCode = 'SG'; break;
        case "THA": countryCode = 'TH'; break;
        case "VNM": countryCode = 'VN'; break;
        default: break;
  }

  updateStackBar();

  if (threatUrl.includes("country")) {
    code = threatUrl.split('country=')[1].substring(0,2);
    threatUrl = threatUrl.replace(code, countryCode);
  } else {
    if (threatUrl == baseUrl) {
      threatUrl = baseUrl + '?country=' + countryCode;
    } else {
      threatUrl = threatUrl + '&country=' + countryCode;
    }
  }

  if (typeUrl.includes("country")) {
    code = typeUrl.split('country=')[1].substring(0,2);
    typeUrl = typeUrl.replace(code, countryCode);
  } else {
    if (typeUrl == baseTypeUrl) {
      typeUrl = baseTypeUrl + '?country=' + countryCode;
    } else {
      typeUrl = typeUrl + '&country=' + countryCode;
    }
  }

  d3.json(threatUrl, function(json) {
    redrawThreat(json);
  });

  d3.json(typeUrl, function(err, res) {
    d3.select('#treemap').selectAll("svg").remove();
      if (!err) {
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

  if (threatUrl.includes("category")) {
    code = threatUrl.split('country=')[1].substring(0,2);

    if (threatUrl.includes('?country')) {
      threatUrl = threatUrl.replace('country=' + code + '&', '');
    } else {
      threatUrl = threatUrl.replace('&country=' + code, '');
    }
  } else {
    threatUrl = baseUrl;
  }

  if (typeUrl.includes("category")) {
    code = typeUrl.split('country=')[1].substring(0,2);
    if (typeUrl.includes('?country')) {
      typeUrl = typeUrl.replace('country=' + code + '&', '');
    } else {
      typeUrl = typeUrl.replace('&country=' + code, '');
    }
  } else {
    typeUrl = baseTypeUrl;
  }

  d3.json(threatUrl, function(json) {
    redrawThreat(json);
  });

  d3.json(typeUrl, function(err, res) {
    d3.select('#treemap').selectAll("svg").remove();
      if (!err) {
        var data = res;
        main({title: ""}, {key: "All Types", values: data});
      }
  });

  d3.selectAll('.popCountry')
    .transition()
    .duration(500)
    .style("opacity", 1);
});

$('#legendCR').on("click", function (d) {
  if (main_legend_active === "0") { //nothing selected, turn on this selection
    d3.select(this).select('rect')
      .style("stroke", "black")
      .style("stroke-width", 2);
    main_legend_active = "legendCR";

    if (threatUrl == baseUrl) {
      threatUrl = baseUrl + "?category=CR";
    } else {
      threatUrl = threatUrl + "&category=CR";
    }

    if (typeUrl == baseTypeUrl) {
      typeUrl = baseTypeUrl + "?category=CR";
    } else {
      typeUrl = typeUrl + "&category=CR";
    }

    populationUrl = basePopulationUrl + "?category=CR";

    d3.select('#legendEN').style('opacity', 0.2);
    d3.select('#legendVU').style('opacity', 0.2);
  } else { //deactivate
    if (main_legend_active === "legendCR") {
      d3.select(this).select('rect')
        .style("stroke", "none");
      main_legend_active = "0";

      if (threatUrl.includes("country")) {
        if (threatUrl.includes("?category")) {
          threatUrl = threatUrl.replace("category=CR?", '');
        } else {
          threatUrl = threatUrl.replace("&category=CR", '');
        }
      } else {
        threatUrl = baseUrl;
      }

      if (typeUrl.includes("country")) {
        if (typeUrl.includes("?category")) {
          typeUrl = typeUrl.replace("category=CR?", '');
        } else {
          typeUrl = typeUrl.replace("&category=CR", '');
        }
      } else {
        typeUrl = baseTypeUrl;
      }

      populationUrl = basePopulationUrl;

      d3.select('#legendEN').style('opacity', 1);
      d3.select('#legendVU').style('opacity', 1);
    }
  }
  d3.json(threatUrl, function(json) {
      redrawThreat(json);
  });

  d3.json(typeUrl, function(err, res) {
    d3.select('#treemap').selectAll("svg").remove();
      if (!err) {
        var data = res;
        main({title: ""}, {key: "All Types", values: data});
      }
  });

  redrawPopulationTrend(populationUrl);
});

$('#legendEN').on("click", function (d) {
  if (main_legend_active === "0") { //nothing selected, turn on this selection
    d3.select(this).select('rect')
      .style("stroke", "black")
      .style("stroke-width", 2);
    main_legend_active = "legendEN";

    if (threatUrl == baseUrl) {
      threatUrl = baseUrl + "?category=EN";
    } else {
      threatUrl = threatUrl + "&category=EN";
    }

    if (typeUrl == baseTypeUrl) {
      typeUrl = baseTypeUrl + "?category=EN";
    } else {
      typeUrl = typeUrl + "&category=EN";
    }

    populationUrl = basePopulationUrl + "?category=EN";

    d3.select('#legendCR').style('opacity', 0.2);
    d3.select('#legendVU').style('opacity', 0.2);
  } else { //deactivate
    if (main_legend_active === "legendEN") {
      d3.select(this).select('rect')
        .style("stroke", "none");
      main_legend_active = "0";

      if (threatUrl.includes("country")) {
        if (threatUrl.includes("?category")) {
          threatUrl = threatUrl.replace("category=EN?", '');
        } else {
          threatUrl = threatUrl.replace("&category=EN", '');
        }
      } else {
        threatUrl = baseUrl;
      }

      if (typeUrl.includes("country")) {
        if (typeUrl.includes("?category")) {
          typeUrl = typeUrl.replace("category=EN?", '');
        } else {
          typeUrl = typeUrl.replace("&category=EN", '');
        }
      } else {
        typeUrl = baseTypeUrl;
      }

      populationUrl = basePopulationUrl;

      d3.select('#legendCR').style('opacity', 1);
      d3.select('#legendVU').style('opacity', 1);
    }
  }
  d3.json(threatUrl, function(json) {
      redrawThreat(json);
  });

  d3.json(typeUrl, function(err, res) {
    d3.select('#treemap').selectAll("svg").remove();
      if (!err) {
        var data = res;
        main({title: ""}, {key: "All Types", values: data});
      }
  });

  redrawPopulationTrend(populationUrl);
});

$('#legendVU').on("click", function (d) {
  if (main_legend_active === "0") { //nothing selected, turn on this selection
    d3.select(this).select('rect')
      .style("stroke", "black")
      .style("stroke-width", 2);
    main_legend_active = "legendVU";

    if (threatUrl == baseUrl) {
      threatUrl = baseUrl + "?category=VU";
    } else {
      threatUrl = threatUrl + "&category=VU";
    }

    if (typeUrl == baseTypeUrl) {
      typeUrl = baseTypeUrl + "?category=VU";
    } else {
      typeUrl = typeUrl + "&category=VU";
    }

    populationUrl = basePopulationUrl + "?category=VU";

    d3.select('#legendEN').style('opacity', 0.2);
    d3.select('#legendCR').style('opacity', 0.2);
  } else { //deactivate
    if (main_legend_active === "legendVU") {
      d3.select(this).select('rect')
        .style("stroke", "none");
      main_legend_active = "0";

      if (threatUrl.includes("country")) {
        if (threatUrl.includes("?category")) {
          threatUrl = threatUrl.replace("category=VU?", '');
        } else {
          threatUrl = threatUrl.replace("&category=VU", '');
        }
      } else {
        threatUrl = baseUrl;
      }

      if (typeUrl.includes("country")) {
        if (typeUrl.includes("?category")) {
          typeUrl = typeUrl.replace("category=VU?", '');
        } else {
          typeUrl = typeUrl.replace("&category=VU", '');
        }
      } else {
        typeUrl = baseTypeUrl;
      }

      populationUrl = basePopulationUrl;

      d3.select('#legendEN').style('opacity', 1);
      d3.select('#legendCR').style('opacity', 1);
    }
  }
  d3.json(threatUrl, function(json) {
      redrawThreat(json);
  });

  d3.json(typeUrl, function(err, res) {
    d3.select('#treemap').selectAll("svg").remove();
      if (!err) {
        var data = res;
        main({title: ""}, {key: "All Types", values: data});
      }
  });

  redrawPopulationTrend(populationUrl);
});
