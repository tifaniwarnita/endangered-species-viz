var margin = {top: 40, right: 20, bottom: 30, left: 40},
    width = 400 - margin.left - margin.right,
    height = 280 - margin.top - margin.bottom;

var x = d3.scale.ordinal()
    .rangeRoundBands([0, width], .1);

var y = d3.scale.linear()
    .rangeRound([height, 0]);

var color = d3.scale.ordinal()
    .range(["#ED9798", "#B7E2B2", "#E4E9D5", "#B9DCEE"]);

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

d3.json('/population/data', function(data) {
  var orderedKey = ["Decreasing", "Stable", "Unknown", "Increasing"];
  color.domain(orderedKey);

  data.forEach(function(d) {
    var mycountry = d.Country; //add to stock code
    var y0 = 0;
    //d.population = color.domain().map(function(name) { return {name: name, y0: y0, y1: y0 += +d[name]}; });
    d.population = color.domain().map(function(name) { return {mycountry:mycountry, name: name, y0: y0, y1: y0 += +d[name]}; });
    d.total = d.population[d.population.length - 1].y1;
    console.log(JSON.stringify(d))
  });

  data.sort(function(a, b) { return b.total - a.total; });

  x.domain(data.map(function(d) { return d.Country; }));
  y.domain([0, d3.max(data, function(d) { return d.total; })]);

  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis);

  svg.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("dy", ".71em")
      .style("text-anchor", "end");
      //.text("Population");

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
        return "class" + classLabel;
      })
      .style("fill", function(d) { return color(d.name); });

  country.selectAll("rect")
       .on("mouseover", function(d){

          var delta = d.y1 - d.y0;
          var xPos = parseFloat(d3.select(this).attr("x"));
          var yPos = parseFloat(d3.select(this).attr("y"));
          var height = parseFloat(d3.select(this).attr("height"))

          d3.select(this).attr("stroke","blue").attr("stroke-width",0.8);

          svg.append("text")
          .attr("x",xPos)
          .attr("y",yPos +height/2)
          .attr("class","tooltip")
          .text(d.name +": "+ delta); 
          
       })
       .on("mouseout",function(){
          svg.select(".tooltip").remove();
          d3.select(this).attr("stroke","pink").attr("stroke-width",0.2);
                                
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
      .on("click",function(d){        

        if (active_link === "0") { //nothing selected, turn on this selection
          d3.select(this)           
            .style("stroke", "black")
            .style("stroke-width", 2);

            active_link = this.id.split("id").pop();
            plotSingle(this);

            //gray out the others
            for (i = 0; i < legendClassArray.length; i++) {
              if (legendClassArray[i] != active_link) {
                d3.select("#id" + legendClassArray[i])
                  .style("opacity", 0.5);
              }
            }
           
        } else { //deactivate
          if (active_link === this.id.split("id").pop()) {//active square selected; turn it OFF
            d3.select(this)           
              .style("stroke", "none");

            active_link = "0"; //reset

            //restore remaining boxes to normal opacity
            for (i = 0; i < legendClassArray.length; i++) {              
                d3.select("#id" + legendClassArray[i])
                  .style("opacity", 1);
            }

            //restore plot to original
            restorePlot(d);

          }

        } //end active_link check
                          
                                
      });

  legend.append("text")
      .attr("x", width - 24)
      .attr("y", 9)
      .attr("dy", ".35em")
      .style("text-anchor", "end")
      .text(function(d) { return d; });

  function restorePlot(d) {

    country.selectAll("rect").forEach(function (d, i) {      
      //restore shifted bars to original posn
      d3.select(d[idx])
        .transition()
        .duration(1000)        
        .attr("y", y_orig[i]);
    })

    //restore opacity of erased bars
    for (i = 0; i < legendClassArray.length; i++) {
      if (legendClassArray[i] != class_keep) {
        d3.selectAll(".class" + legendClassArray[i])
          .transition()
          .duration(1000)
          .delay(750)
          .style("opacity", 1);
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
          .duration(1000)          
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
        .duration(1000)
        .delay(750)
        .attr("y", y_new);
   
    })    
   
  } 

});