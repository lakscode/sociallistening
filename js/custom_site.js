
function dynamicSiteChart(div, res)
{
//alert(res);
Highcharts.setOptions(Highcharts.themeBlack);

var arr=res.split("~");
 $('#' + div).highcharts({
        chart: {
            type: 'column'
			/*,
			 backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
                stops: [
                    [0, 'rgb(255, 255, 255)'],
                    [1, 'rgb(200, 200, 255)']
                ]
            } */
        },
        title: {
            text: 'Distribution by Source Websites'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: eval(arr[0]),
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'No.of Posts'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">No of Posts: </td>' +
                '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            },
			        series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function (e) {
						//alert(this.category);
						localStorage.setItem("site",this.category);	
						viewMenu(e,this.y);
						//createDynamicPieChart(this.y);
						
                        }
                    }
                }
				}
        },
        series: [{
            name: 'Source Site',
            data: eval(arr[1]), 
			color: Highcharts.getOptions().colors[2]
			 
        }]
    });
}