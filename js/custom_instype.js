function dynamicInsTypesChart(div, res)
{
//alert(res);
var arr=res.split("~");
	//Highcharts.setOptions(Highcharts.themeDarkGreen);
Highcharts.setOptions(Highcharts.themeBlack);
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
            tickInterval: 1 * 24 * 3600 * 1000, // one week
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
							
									var brand=localStorage.getItem("brand");
									initStorageItems();
									localStorage.setItem("brand", brand);	
									
									localStorage.setItem("itype_date", this.x);
									localStorage.setItem("itype", this.series.name);
								viewMenu(e, this.y);
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
            name:"Life",
            data: eval(arr[0]),
			//dashStyle: 'longdash',
			lineWidth: 2,
			shadow:true,
            color: '#FF0000'
        },
		{
            name: "Health",
            data: eval(arr[1]),
			lineWidth: 2,
			shadow:true,
            color: '#00137F'
        }
		,
		{
            name: "Auto",
            data: eval(arr[2]),
			lineWidth: 2,
			shadow:true,
            color: '#007F0E'
        }
		]
    });
	}
	
	