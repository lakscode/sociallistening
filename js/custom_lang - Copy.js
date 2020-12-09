function dynamicLangChart(div, res)
{
//alert(res);
var arr=res.split("~");
	//Highcharts.setOptions(Highcharts.themeDarkUnica);
	Highcharts.setOptions(Highcharts.themeBlack);
 $('#' + div).highcharts({
        chart: {
            type: 'area'
        },
        title: {
            text: 'Distribution by Language'
        },
        subtitle: {
           // text: 'Source: <a href="http://thebulletin.metapress.com/content/c4120650912x74k7/fulltext.pdf">' +
             //   'thebulletin.metapress.com</a>'
        },
        xAxis: {
            categories: eval(arr[0])
        },
        yAxis: {
            title: {
                text: 'No. of Posts'
            },
            labels: {
                formatter: function () {
                    return this.value;
                }
            }
        },
        tooltip: {
            pointFormat: '{point.key} <b>{point.y:,.0f}</b>'
        },
        plotOptions: {
		        series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function (e) {
						localStorage.setItem("lang",this.category);	
						viewMenu(e,this.y);
					
                        }
                    }
                }
				}
        },
        series: [{
            name: 'Language',
            data: eval(arr[1])
        }]
    });
}
	
	
	