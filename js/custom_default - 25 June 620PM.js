function dynamicCompetitionChart(div, res)
{
//alert(res);
var arr=res.split("~");
/*alert(arr[0]);
alert(arr[1]);
alert(arr[2]); */
// Apply the theme
//Highcharts.setOptions(Highcharts.themeBlack);
	
 $('#' + div).highcharts({
    chart: {
            zoomType: 'x'
        },
        title: {
            text: 'Date-wise Trend - By Brands',
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
							//alert(this.y);
							//alert(this.x);
									localStorage.setItem("company","");
									localStorage.setItem("ifunction","");
									localStorage.setItem("itype","");
									localStorage.setItem("ifunction_date","");
									localStorage.setItem("itype_date","");	
									localStorage.setItem("sentiment","");
									localStorage.setItem("source","");		
									localStorage.setItem("lang","");	
									localStorage.setItem("site","");
								localStorage.setItem("company", this.series.name);
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
	
	
	
	