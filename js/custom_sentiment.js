function dynamicSentimentChart(div, res)
{
//alert(res);
var arr=res.split("~");
	//Highcharts.setOptions(Highcharts.themeDarkUnica3D);
 $('#' + div).highcharts({
         chart: {
            type: 'pyramid',
            marginRight: 100
        },
        title: {
            text: 'Distribution by Sentiments',
            x: -50
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b> ({point.y:,.0f})',
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                    softConnector: true
                },   
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
        legend: {
            enabled: false
        },
        series: [{
            name: 'Sentiments',
            data: eval(res)
        }]
    });
	}
	
	