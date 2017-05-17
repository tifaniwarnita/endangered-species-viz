var margin = {top: 0, right: 20, bottom: 30, left: 40};
var width = 400 - margin.left - margin.right;
var height = 210 - margin.top - margin.bottom;

var x = d3.scale.ordinal()
    .rangeRoundBands([0, width], .1);

var y = d3.scale.linear()
    .rangeRound([height, 0]);

var color = d3.scale.ordinal()
    .range(["#d2696a", "#5bbfb5", "#b1d5e5", "#e3d1c7"]);

var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom");

var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left")
    .tickFormat(d3.format(".2s"));

var svg = d3.select("#population-chart").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

var active_link = "0"; //to control legend selections and hover
var legendClicked; //to control legend selections
var legendClassArray = []; //store legend classes to select bars in plotSingle()
var y_orig; //to store original y-posn

var tooltip = d3.select("body").append("div")
    .attr("class", "tooltip")
    .style("opacity", 0);

var countries;
$.getJSON('population/countries', function(json){
    countries = json;
});

var updateStackBar;
var basePopulationUrl = '/population/data';
var populationUrl = basePopulationUrl;
drawStackedBar(populationUrl);

function drawStackedBar(populationUrl) {
d3.json(populationUrl, function(data) {
  var orderedKey = ["Decreasing", "Stable", "Increasing", "Unknown"];
  color.domain(orderedKey);

  data.forEach(function(d) {
    var mycountry = d.Country; //add to stock code
    var y0 = 0;
    //d.population = color.domain().map(function(name) { return {name: name, y0: y0, y1: y0 += +d[name]}; });
    d.population = color.domain().map(function(name) { return {mycountry:mycountry, name: name, y0: y0, y1: y0 += +d[name]}; });
    d.total = d.population[d.population.length - 1].y1;
  });

  data.sort(function(a, b) { return b.total - a.total; });

  x.domain(data.map(function(d) { return d.Country; }));
  y.domain([0, d3.max(data, function(d) { return d.total; })]);

  // HARDCODE height buat redraw
  height = 180;

  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis)
    .append("text")
      .attr("y", -38)
      .attr("dy", ".71em")
      .style("text-anchor", "middle")
      .attr("transform", "translate(" + (width/2) + ", 60)")
      .text("Country");


  svg.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("y", -38)
      .attr("dy", ".71em")
      .style("text-anchor", "middle")
      .attr("transform", "translate(-2, " + (height/2)+ ") rotate(-90)")
      .text("Population");

  var country = svg.selectAll(".country")
      .data(data)
    .enter().append("g")
      .attr("class", "g")
      .attr("transform", function(d) { return "translate(" + "0" + ",0)"; });
      //.attr("transform", function(d) { return "translate(" + x(d.Country) + ",0)"; })

  country.selectAll("rect")
      .data(function(d) {
        return d.population;
      })
    .enter().append("rect")
      .attr("width", x.rangeBand())
      .attr("y", function(d) { return y(d.y1); })
      .attr("x",function(d) { //add to stock code
          return x(d.mycountry)
        })
      .attr("height", function(d) { return y(d.y0) - y(d.y1); })
      .attr("class", function(d) {
        classLabel = d.name.replace(/\s/g, ''); //remove spaces
        return "class" + classLabel + " " + "country" + d.mycountry + " popCountry";
      })
      .style("fill", function(d) { return color(d.name); });

  country.selectAll("rect")
       .on("mouseover", function(d){
          var xPos = parseFloat(d3.select(this).attr("x"));
          var yPos = parseFloat(d3.select(this).attr("y"));
          var height = parseFloat(d3.select(this).attr("height"))

          d3.select(this).attr("stroke","blue").attr("stroke-width",0.8);

          showTooltip(d, this);

       })
       .on("mouseout",function(){
          svg.select(".tooltip").remove();
          d3.select(this).attr("stroke","pink").attr("stroke-width",0.2);
          hideTooltip();
        })


  var legend = svg.selectAll(".legend")
      .data(color.domain().slice().reverse())
    .enter().append("g")
      //.attr("class", "legend")
      .attr("class", function (d) {
        legendClassArray.push(d.replace(/\s/g, '')); //remove spaces
        return "legend";
      })
      .attr("transform", function(d, i) { return "translate(0," + i * 20 + ")"; });

  //reverse order to match order in which bars are stacked
  legendClassArray = legendClassArray.reverse();

  legend.append("rect")
      .attr("x", width - 18)
      .attr("width", 18)
      .attr("height", 18)
      .style("fill", color)
      .attr("id", function (d, i) {
        return "id" + d.replace(/\s/g, '');
      })
      .on("mouseover",function(){

        if (active_link === "0") d3.select(this).style("cursor", "pointer");
        else {
          if (active_link.split("class").pop() === this.id.split("id").pop()) {
            d3.select(this).style("cursor", "pointer");
          } else d3.select(this).style("cursor", "auto");
        }
      })
      .on("click",function(d) {
        if (calculateActiveLegend() == 4 && isFirst) { // all selected but first
            for (var key in activeLegend) {
              activeLegend[key] = 0;
            }
            activeLegend[d] = 1;
            isFirst = false;
        } else if (calculateActiveLegend() == 4 && !isFirst) {
            activeLegend[d] = 0;
        } else if (calculateActiveLegend() == 1 && activeLegend[d] == 1) { // return to normal state
            for (var key in activeLegend) {
              activeLegend[key] = 1;
            }
        } else {
            if (activeLegend[d] == 1) { // already active
              activeLegend[d] = 0;
            } else {
              activeLegend[d] = 1;
            }
        }

        updateLegend();
        updateStackBar();

      });

  function updateLegend() {
    for (var key in activeLegend) {
      if (activeLegend[key] == 0) { // not active
        d3.select("#id" + key)
            .style("opacity", 0.2)
      } else { // active
        d3.select("#id" + key)
          .style("opacity", 1)
      }
    }
  }

  var y_superbase = [];
  var base_height = 0;

  country.selectAll("rect").forEach(function (d, i) {
    base_height = Number(d3.select(d[0]).attr("y")) + Number(d3.select(d[0]).attr("height"));
    y_superbase.push(base_height);
  })

  country.selectAll("rect").forEach(function (d, i) {
    //get height and y posn of base bar and selected bar
    var h_keep = d3.select(d[0]).attr("height");
    var y_keep = d3.select(d[0]).attr("y");

    var h_base = d3.select(d[0]).attr("height");
    var y_base = d3.select(d[0]).attr("y");

    var h_shift = h_keep - h_base;
    var y_new = y_base - h_shift;

  });

  updateStackBar = function update() {
    if (calculateActiveLegend() == 1) {
        var idx = 0;
        for (var key in activeLegend) {
            if (activeLegend[key] == 0) { // not active
                d3.selectAll(".class" + key)
                    .transition()
                    .duration(500)
                    .style("opacity", 0);
            } else { // active
                country.selectAll("rect").forEach(function (d, i) {
                    //get height and y posn of base bar and selected bar
                    var h_keep = d3.select(d[idx]).attr("height");
                    var y_new = base_height - h_keep;

                    //adjusting country
                    var currentCountry = d[idx]["__data__"]["mycountry"];
                    if (countryCode == "NULL") {
                        d3.select(d[idx])
                            .transition()
                            .ease("bounce")
                            .duration(1000)
                            .delay(750)
                            .attr("y", y_new)
                            .style("opacity", 1);
                    } else {
                        if (currentCountry == countryCode) {
                            d3.select(d[idx])
                                .transition()
                                .ease("bounce")
                                .duration(1000)
                                .delay(750)
                                .attr("y", y_new)
                                .style("opacity", 1);
                        } else {
                            d3.select(d[idx])
                                .transition()
                                .ease("bounce")
                                .duration(1000)
                                .delay(750)
                                .attr("y", y_new)
                                .style("opacity", 0.2);
                        }
                    }
                });
            }
            idx++;
        }
    } else {
        var idx = 0;
        var bar_height = y_superbase.slice();
        for(var i = 0; i < y_superbase.length; i++) {
            bar_height[i] = 0;
        }
        var is_active = true;
        for (var key in activeLegend) {
            if (activeLegend[key] == 0) { // not active
                d3.selectAll(".class" + key)
                    .transition()
                    .duration(500)
                    .style("opacity", 0);
            } else { // active
                country.selectAll("rect").forEach(function (d, i) {
                    //restore shifted bars to original posn
                    var h_keep = d3.select(d[idx]).attr("height");
                    bar_height[i] += Number(h_keep);
                    var y_new = base_height - bar_height[i];

                    var currentCountry = d[idx]["__data__"]["mycountry"];
                    // adjusting country
                    if (countryCode == "NULL") {
                        d3.select(d[idx])
                            .transition()
                            .duration(750)
                            .delay(500)
                            .attr("y", y_new)
                            .style("opacity", 1);
                    } else {
                        if (currentCountry == countryCode) {
                            d3.select(d[idx])
                                .transition()
                                .duration(750)
                                .delay(500)
                                .attr("y", y_new)
                                .style("opacity", 1);
                        } else {
                            d3.select(d[idx])
                                .transition()
                                .duration(750)
                                .delay(500)
                                .attr("y", y_new)
                                .style("opacity", 0.2);
                        }
                    }
                });
            }
            idx++;
        }
    }

  }

  function getVpPos(el) {
    if(el.parentNode.nodeName === 'svg') {
        return el.parentNode.getBoundingClientRect();
    }
    return getVpPos(el.parentNode);
}

  legend.append("text")
      .attr("x", width - 24)
      .attr("y", 9)
      .attr("dy", ".35em")
      .style("text-anchor", "end")
      .text(function(d) { return d; });

  function calculateActiveLegend() {
      var result = 0;
      for (var key in activeLegend) {
        result += activeLegend[key];
      }
      return result;
  }

  function restorePlot(d) {

    country.selectAll("rect").forEach(function (d, i) {
      //restore shifted bars to original posn
      d3.select(d[idx])
        .transition()
        .duration(500)
        .attr("y", y_orig[i]);
    })

    //restore opacity of erased bars
    for (i = 0; i < legendClassArray.length; i++) {
      if (legendClassArray[i] != class_keep) {
        if (countryCode == "NULL") {
          d3.selectAll(".class" + legendClassArray[i])
            .transition()
            .duration(500)
            .delay(250)
            .style("opacity", 1);
        } else {
          d3.selectAll(".class" + legendClassArray[i])
            .transition()
            .duration(500)
            .delay(250)
            .style("opacity", 0.2);
          d3.selectAll('.country' + countryCode)
            .transition()
            .duration(500)
            .delay(250)
            .style("opacity", 1);
        }
      }
    }

  }

  function plotSingle(d) {

    class_keep = d.id.split("id").pop();
    idx = legendClassArray.indexOf(class_keep);

    //erase all but selected bars by setting opacity to 0
    for (i = 0; i < legendClassArray.length; i++) {
      if (legendClassArray[i] != class_keep) {
        d3.selectAll(".class" + legendClassArray[i])
          .transition()
          .duration(500)
          .style("opacity", 0);
      }
    }

    //lower the bars to start on x-axis
    y_orig = [];
    country.selectAll("rect").forEach(function (d, i) {

      //get height and y posn of base bar and selected bar
      h_keep = d3.select(d[idx]).attr("height");
      y_keep = d3.select(d[idx]).attr("y");
      //store y_base in array to restore plot
      y_orig.push(y_keep);

      h_base = d3.select(d[0]).attr("height");
      y_base = d3.select(d[0]).attr("y");

      h_shift = h_keep - h_base;
      y_new = y_base - h_shift;

      //reposition selected bars
      d3.select(d[idx])
        .transition()
        .ease("bounce")
        .duration(500)
        .delay(250)
        .attr("y", y_new);

    })
  }

  function showTooltip(d, obj) {
    event = document.onmousemove || window.event; // IE-ism

    // If pageX/Y aren't available and clientX/Y are,
    // calculate pageX/Y - logic taken from jQuery.
    // (This is to support old IE)
    if (event.pageX == null && event.clientX != null) {
        eventDoc = (event.target && event.target.ownerDocument) || document;
        doc = eventDoc.documentElement;
        body = eventDoc.body;

        event.pageX = event.clientX +
            (doc && doc.scrollLeft || body && body.scrollLeft || 0) -
            (doc && doc.clientLeft || body && body.clientLeft || 0);
        event.pageY = event.clientY +
            (doc && doc.scrollTop  || body && body.scrollTop  || 0) -
            (doc && doc.clientTop  || body && body.clientTop  || 0 );
    }
    // Calculate the absolute left and top offsets of the tooltip. If the
    // mouse is close to the right border of the map, show the tooltip on
    // the left.
    var left = event.pageX + 25;
    if ((window.innerWidth - left) < 200) {
        left = window.innerWidth - 200;
    }
    var top = event.pageY + 25;
    if ((top - window.outerHeight) > 40) {
        top -= 50;
    }
    var delta = d.y1 - d.y0;

    var tooltipText = createTooltip(countries[d.mycountry], d.name, delta);

    // Show the tooltip (unhide it) and set the name of the data entry.
    // Set the position as calculated before.
    tooltip.classed('hidden', false)
        .attr("style", "left:" + left + "px; top:" + top + "px")
        .html(tooltipText);
  }

  function createTooltip(countryName, type, value) {
      var tooltipHtml = '';
      tooltipHtml += '<div>';
      tooltipHtml += '<div class="tooltip-title">' + countryName + '</div>';
      tooltipHtml += type + ': ' + value + ' species';
      tooltipHtml += '</div>';
      return tooltipHtml;
  }

  function hideTooltip() {
    tooltip.classed('hidden', true);
  }
});
}
