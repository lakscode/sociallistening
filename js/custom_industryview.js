function dynamicIndustryViewChart(div, res)
{
//alert(res);
var arr=res.split("~");
/*
alert(arr[0]);
alert(arr[1]);
alert(arr[2]); */  
//Highcharts.setOptions(Highcharts.themeDarkBlue);
Highcharts.setOptions(Highcharts.themeBlack);	
 $('#' + div).highcharts({
    chart: {
	   type: 'bar',
//            zoomType: 'x'
        },
        title: {
            text: 'Distribution by Industry View ',
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
							//alert(this.series.name);
									initStorageItems();
									localStorage.setItem("indview",this.series.name);	
									localStorage.setItem("brand", '');	
									localStorage.setItem("ifunction_date", this.x);									
								viewMenu(e, this.x);
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
            name:arr[0],
            data: eval(arr[1])
        },
		{
            name: arr[2],
            data: eval(arr[3])
        }
		]
    });
	}
	
	