    <div id="main">
      <div id="sequence"></div>
      <div id="chart">
        <div id="explanation" style="visibility: hidden;">
          <span id="percentage"></span><br/>
          are threatened by this threat
        </div>
      </div>
    </div>
    {{-- <div id="sidebar">
      <input type="checkbox" id="togglelegend"> Legend<br/>
      <div id="legend" style="visibility: hidden;"></div>
    </div> --}}
    <script type="text/javascript" src="{{ asset('js/sunburst.js') }}"></script>
    <script type="text/javascript">
      // Hack to make this example display correctly in an iframe on bl.ocks.org
      d3.select(self.frameElement).style("height", "700px");
    </script>
