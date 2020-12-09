
function dynamicLineChart(div, res)
{
 $('#' + div).highcharts({
    
        title: {
            text: 'Date-wise Trend',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'No of Posts'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
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
							 

							/*var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
							var id= createOutline("posts" + random);
							var url="functions_php/Posts.php";
							var fName="posts";
							getData(url, id, fName); */
	
							viewMenu(e, this.y);
                               /* hs.htmlExpand(null, {
                                    pageOrigin: {
                                        x: e.pageX || e.clientX,
                                        y: e.pageY || e.clientY
                                    },
                                    //headingText: this.series.name,
                                    maincontentText: "<input type='button' value='View by Language' onclick='viewMenu(\"" +  this.y + "\")' />",
                                    width: 200
                                }); */
                            }
                        }
                    },
                    marker: {
                        lineWidth: 1
                    }
                }
            },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'CSC',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'Accenture',
            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
        }, {
            name: 'Emirates',
            data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
        }, {
            name: 'CTS',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }]
    });
	
	}
	
	