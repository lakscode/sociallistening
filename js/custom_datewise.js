
function dynamicDatewiseChart(div, res)
{
var arr=res.split("~");
 $('#' + div).highcharts({
    chart:{ backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
                stops: [
                    [0, 'rgb(255, 255, 255)'],
                    [1, 'rgb(200, 200, 255)']
                ]
            }},
        title: {
            text: 'Datewise Trend',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: eval(arr[0])
        },
        yAxis: {
            title: {
                text: 'No of Posts'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ''
        },
		  plotOptions: {
                series: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function (e) {
							//alert(this.y);
							//alert(this.x);
							viewMenu(e,this.y);
                            }
                        }
                    },
                    marker: {
                        lineWidth: 1
                    }
                }
            },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'No of Posts',
            data: eval(arr[1]),
			color: Highcharts.getOptions().colors[2]
        }
		]
    });
	
	}
	
	