function dynamicLangChart(div, res)
{
//alert(res);
var arr=res.split("~");
	//Highcharts.setOptions(Highcharts.themeDarkUnica);
	Highcharts.setOptions(Highcharts.themeBlack);
 $('#' + div).highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Distribution<br> by<br> Language',
            align: 'center',
            verticalAlign: 'middle',
            y: 0
        },
        tooltip: {
            pointFormat: '{point.y:.0f}:<b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
			pie: {   innerSize: 100,
                depth: 45,
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                },
				series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function (e) {
						//alert(this.name);
						localStorage.setItem("lang",this.name);	
						viewMenu(e,this.y);
					
                        }
                    }
                }
				}
        },
        series: [{
            type: 'pie',
            name: 'Languages',
            innerSize: '50%',
             data: eval(res)
        }]
    });
}

