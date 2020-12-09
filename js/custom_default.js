function dynamicCompetitionChart(div, res)
{
//alert(res);
var arr=res.split("~");
/*alert(arr[0]);
alert(arr[1]);
alert(arr[2]); */
// Apply the theme
Highcharts.setOptions(Highcharts.themeBlack);
	
 $('#' + div).highcharts({
    chart: {
	reflow: true,
	  type: 'line'
           // zoomType: 'x'
        },
        title: {
            text: 'Distribution by Brands',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            //tickInterval: 14 * 24 * 3600 * 1000, // one week
			tickInterval: 24 * 3600 * 1000, // one week
                tickWidth: 0,
                gridLineWidth: 1,
				 type: 'datetime',
            dateTimeLabelFormats: { // don't display the dummy year
                month: '%e %b',
                year: '%b'
            }
        },
        yAxis: {
            title: {
                text: 'No of Posts'
            },
            min: 0
        },
        tooltip: {
            valueSuffix: ''
        },
		  plotOptions: {
		    /*area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                },
*/
                series: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function (e) {
							//alert(this.y);
							//alert(this.x);
									initStorageItems();
								localStorage.setItem("brand", this.series.name);
								viewMainMenu(e, this.x);
                            }
                        }
                    },
                    marker: {
                        lineWidth: 1
                    }
                }
            },

      /*  legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        }, */
 series: [{
            name: arr[0],
            data: eval(arr[1])
        },
		{
            name: arr[2],
            data: eval(arr[3])
        }
		,
		{
            name: arr[4],
            data: eval(arr[5])
        }
		]
    });
	}
	
	
	
	