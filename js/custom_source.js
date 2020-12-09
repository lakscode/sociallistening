function dynamicSourceChart(div, res)
{
//alert(res);
var arr=res.split("~");
Highcharts.setOptions(Highcharts.themeBlack);
	//Highcharts.setOptions(Highcharts.themeSand);
 $('#' + div).highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Distribution by Source'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: eval(arr[0]),
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'No of Posts ',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' '
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            },
			        series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function (e) {
						localStorage.setItem("source",this.category);	
						viewMenu(e,this.y);
                        }
                    }
                }
				}
        },
     /*   legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        }, */
        credits: {
            enabled: false
        },
        series: [{
            name: 'No of Posts',
            data: eval(arr[1]),
			color: Highcharts.getOptions().colors[3]
        }]
    });
}
	