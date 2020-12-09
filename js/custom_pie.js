	
function dynamicPieChart(div, res)
{
 $('#' + div).highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Browser market shares at a specific website, 2014'
        },
        plotOptions: {	
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            },
			        series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function (e) {
						viewMenu(e,this.y);
						//createDynamicPieChart(this.y);
						
                        }
                    }
                }
				}

        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: eval(res)
        }]
    });
	
		
	}