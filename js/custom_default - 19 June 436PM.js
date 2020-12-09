function dynamicCompetitionChart(div, res)
{
//alert(res);
var arr=res.split("~");
/*alert(arr[0]);
alert(arr[1]);
alert(arr[2]); */
	
 $('#' + div).highcharts({
    
        title: {
            text: 'Date-wise Trend - Insurance Types',
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
                series: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function (e) {
							
								localStorage.setItem("company", this.series.name);
								viewMainMenu(e, this.y);
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
	
	