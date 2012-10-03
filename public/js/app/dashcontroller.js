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

	for (var i = 0; i < 7; i++) {
		var obj = {
			id : i +1,
			title : "title_" + (i + 1),
			ticketStatus : "Open",
			ticketType : "Bug"
		}
		
		$scope.incomingTickets.push(obj);
		$scope.outgoingTickets.push(obj);
	}

	var pieGraphEl = "pie_div";
	var pieChart;

	var stackChart;
	var stackGraphEl = "stack_div"
	var graphCaptions = {
		title : "Summary Of Tickets"
	}
	var initializePieGraph = function() {
        var self;
        self = this;
        pieChart = new Highcharts.Chart({
          chart: {
            renderTo: pieGraphEl,
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
    

    var initializeStackedGraph = function (){
    	stackChart = new Highcharts.Chart({
            chart: {
                renderTo: stackGraphEl,
                type: 'column'
            },
            title: {
                text: '% Success On Project Basis'
            },
            xAxis: {
                categories: ['Project 1', 'Project 2', 'Project 3', 'Project 4', 'Project 5']
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Amount of Work'
                }
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.series.name +': '+ this.y +' ('+ Math.round(this.percentage) +'%)';
                }
            },
            plotOptions: {
                column: {
                    stacking: 'percent'
                }
            },
                series: [{
                name: 'Resolved',
                data: [5, 3, 4, 7, 2]
            }, {
                name: 'Unresolved',
                data: [2, 2, 3, 2, 1]
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
	initializePieGraph();
	initializeStackedGraph();
	
}