
jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + 
                                                $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + 
                                                $(window).scrollLeft()) + "px");
    return this;
}

$(function () {


    $('#container').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Browser market shares at a specific website, 2014'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {	
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            },
			        series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function () {
						$(subchart).center();
						document.getElementById('subchart').style.display="block";
						subchart();
                           // alert('value: ' + this.y);
                        }
                    }
                }
				}

        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [
                ['Firefox',   45.0],
                ['IE',       26.8],
                {
                    name: 'Chrome',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['Safari',    8.5],
                ['Opera',     6.2],
                ['Others',   0.7]
            ]
        }]
    });
});

function subchart()
{
 $('#subchart').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Browser market shares at a specific website, 2014'
        },
        plotOptions: {	
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            },
			        series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function () {
						createDynamicChart(this.y);
                           // alert('value: ' + this.y);
                        }
                    }
                }
				}

        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [
                ['Firefox',   45.0],
                ['IE',       26.8],
                {
                    name: 'Chrome',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['Safari',    8.5],
                ['Opera',     6.2],
                ['Others',   0.7]
            ]
        }]
    });
	}
	
	function createDynamicChart(val)
	{
	var id="temp" + Math.floor((Math.random() * 10) + 1);
	var div = document.createElement('div');
	div.id=id;
	alert(id);
	div.className="ui-widget-content divData";
	div.style.backgroundColor = 'green';
	div.innerHTML=val;
	$('#chartcontainer').append(div);

	$("#" + id).append('<img src="images/close.png"  title="Close" style="margin-top:-15px;margin-right:-15px; float:right;right: 0;width:24px;height:24px;" onclick="popupclose(\'' + id  + '\')" />');
	$("#" + id).append('<button onclick="popupclose(\'' + id  + '\')> sdgdsg</button>');
	var div1 = document.createElement('div');
	div1.id=id+"sub";
	div.className="subchart draggable";
	$("#" + id).append(div1);
	$("#" + id).draggable();
	alert(val);
	dynamicChart(id+"sub");
	document.getElementById(id).style.display="block";
	}
	
	
	function dynamicChart(div)
{
 $('#' + div).highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Browser market shares at a specific website, 2014'
        },
        plotOptions: {	
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            },
			        series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function () {
						createDynamicChart(this.y);
                        }
                    }
                }
				}

        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [
                ['Firefox',   45.0],
                ['IE',       26.8],
                {
                    name: 'Chrome',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['Safari',    8.5],
                ['Opera',     6.2],
                ['Others',   0.7]
            ]
        }]
    });
	
		
	}
	