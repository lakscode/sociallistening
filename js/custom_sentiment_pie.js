function dynamicSentimentPieChart(div, res)
{
Highcharts.setOptions(Highcharts.themeBlack);
 $('#' + div).highcharts({
        chart: {
		type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            },
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Distribution by Sentiments'
        },
            tooltip: {
                pointFormat: '{point.y:.0f}:  <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {   innerSize: 100,
                depth: 45,
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                },
                  series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function (e) {
						localStorage.setItem("sentiment", "");
						if(this.name == "Neutral") localStorage.setItem("sentiment", "0");
						if(this.name == "Positive") localStorage.setItem("sentiment", "1");
						if(this.name == "Negative") localStorage.setItem("sentiment", "-1");
						
							
				//	alert(this.name);
						viewMenu(e,this.y);
	
                        }
                    }
                }
				}
            },
            series: [{
                type: 'pie',
                name: 'Sentiment',
                data:  eval(res)
				
            }]
        });
		
	
    }