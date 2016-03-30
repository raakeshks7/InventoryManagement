$(function(){
  $.ajax({
    url: 'http://localhost/DashboardProj/owner_dashboard.php',
    type: 'GET',
    
    success : function(data) {
      chartData = data;
      var chartProperties = {
        "caption": "Hauling Comapnies Used by Outlets",
        "xAxisName": "Zone",
        "yAxisName": "Outlet Count",
        "rotatevalues": "1",
        "theme": "zune"
      };
      apiChart = new FusionCharts({
        type: 'Line',
        renderAt: 'chart-container',
        width: '550',
        height: '350',
        dataFormat: 'json',
        dataSource: {
          "chart": chartProperties,
          "data": chartData
        }
      });
      apiChart.render();
    }
  });
});