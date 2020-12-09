function Role4Graph2(div, res)
{
//alert(res);
var arr=res.split("~");
/*
alert(arr[0]);
alert(arr[1]);
alert(arr[2]); */  
//Highcharts.setOptions(Highcharts.themeDarkBlue);
Highcharts.setOptions(Highcharts.themeBlack);	
 var options = {
    chart: {
	 renderTo: div,
	   type: 'area',
       //     zoomType: 'x'
        },
        title: {
            text: 'Patient Experience View',
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
									localStorage.setItem("brand", localStorage.getItem("sourcebrand"));	
									localStorage.setItem("ifunction_date", this.x);		
									localStorage.setItem("Role4Graph2",this.series.name);										
								viewMenu(e, this.x);
                            }
                        }
                    },
                    marker: {
                        lineWidth: 1
                    }
                }
            },

series: [
		]
    };
	var i=0;
	for(i=0; i<arr.length;i+=2)
	{
		options.series.push({
			name: arr[i],
			data: eval(arr[i+1]) //[3, 4, 2]
		}) ;
	}
	//alert(options);
	var chart = new Highcharts.Chart(options);
}
	
	