function dynamicSemiCircleChart(div, res)
{
 $('#' + div).highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Source<br>shares',
            align: 'center',
            verticalAlign: 'middle',
            y: 50
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%']
            }
			,
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
            name: 'Source share',
            innerSize: '50%',
            data: eval(res)
        }]
    });
}

