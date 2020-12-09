function DefaultType(div, res)
{
//alert(res);
var arr=res.split("~");
//Highcharts.setOptions(Highcharts.themeDarkGreen);
Highcharts.setOptions(Highcharts.themeBlack);
 var options = {
    chart: {
	 renderTo: div,
	 reflow: true,
	  type: 'line'
           // zoomType: 'x'
        },
    
        title: {
            text: 'Date-wise Trend - by Departments',
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
	
	