$(function() {
    $(document).ready(function(event) {
        $('[data-toggle="popover"]').popover();

        var ctx4 = document.getElementById("pieChart").getContext("2d");
        var data4 = [
            {
                value: 300,
                color:"#F25656",
                highlight: "#FD7A7A",
                label: "Red"
            },
            {
                value: 50,
                color: "#22BAA0",
                highlight: "#36E7C8",
                label: "Green"
            },
            {
                value: 100,
                color: "#F2CA4C",
                highlight: "#FBDB6E",
                label: "Yellow"
            }
        ];
        var myDoughnutChart = new Chart(ctx4).Doughnut(data4,{
            segmentShowStroke : true,
            segmentStrokeColor : "#fff",
            segmentStrokeWidth : 2,
            animationSteps : 100,
            animationEasing : "easeOutBounce",
            animateRotate : false,
            animateScale : false,
            legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
            responsive: true
        });

        document.getElementById('legends').innerHTML = myDoughnutChart.generateLegend();

        var ctx2 = document.getElementById("lineChart").getContext("2d");
        var data2 = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(220,220,220,0.5)",
                    strokeColor: "rgba(220,220,220,0.8)",
                    highlightFill: "rgba(220,220,220,0.75)",
                    highlightStroke: "rgba(220,220,220,1)",
                    data: [65, 59, 80, 81, 56, 55, 40]
                },
                {
                    label: "My Second dataset",
                    fillColor: "rgba(34,186,160,0.5)",
                    strokeColor: "rgba(34,186,160,0.8)",
                    highlightFill: "rgba(34,186,160,0.75)",
                    highlightStroke: "rgba(34,186,160,1)",
                    data: [28, 48, 40, 19, 86, 27, 90]
                }
            ]
        };
        
        var chart2 = new Chart(ctx2).Bar(data2, {
            scaleBeginAtZero : true,
            scaleShowGridLines : true,
            scaleGridLineColor : "rgba(0,0,0,.05)",
            scaleGridLineWidth : 1,
            scaleShowHorizontalLines: true,
            scaleShowVerticalLines: true,
            barShowStroke : true,
            barStrokeWidth : 2,
            barDatasetSpacing : 1,
            legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            responsive: true
        });
    });
})