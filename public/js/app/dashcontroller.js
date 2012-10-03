function DashController ($scope){
	/**
	 * Initial call to set up our perfomance board
	 * @return {[type]} [description]
	 */
	var start = function (){
		$(".bar").peity("bar",{
			colour : "#F90"
		});
		
		$(".bar_good").peity("bar",{
			colour: "#459D1C"
		});

		$(".bar_bad").peity("bar",{
			colour: "#BA1E20"
		});
	}

	$scope.incomingTickets = [];

	$scope.outgoingTickets = [];

	for (var i = 0; i < 5; i++) {
		var obj = {
			id : i +1,
			title : "title_" + (i + 1),
			ticketStatus : "Open",
			ticketType : "Bug"
		}
		
		$scope.incomingTickets.push(obj);
		$scope.outgoingTickets.push(obj);
	}

	var graphEl = "pie_div";
	var pieChart;
	var graphCaptions = {
		title : "Summary Of Tickets"
	}
	var initializeGraph = function() {
        var self;
        self = this;
        pieChart = new Highcharts.Chart({
          chart: {
            renderTo: graphEl,
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            // events: {
            //   load: fetchData()
            // }
          },
          title: {
            text: graphCaptions.title
          },
          plotOptions: {
            pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              dataLabels: {
                enabled: false
              }
            }
          },
           series: [{
                type: 'pie',
                name: 'Tickets',
                data: [
                    ['Resolved',   66.66],
                    {
                        name: 'Uresolved',
                        y: 33.33,
                        sliced: true,
                        selected: true
                    }
                    
                ]
            }]
        });
     }
     var fetchData = function() {
        // var url = 'getPieSummary'  ;
        // $.ajax({
        //   url: url,
        //   success: function(res) {
        //     pieChart.addSeries(res["data"]);
        //   }
        // });
      }

	//make calls
	start();
	initializeGraph();
	
}