/* global Chart:false */

$(function () {
    $.ajax({
        url: "/chart-data",
        type: "GET",
        success: function (data) {
            var $visitorsChart = $("#visitors-chart");
            var visitorsChart = new Chart($visitorsChart, {
                type: "line",
                data: {
                    labels: data.map((entry) => entry.label),
                    datasets: [
                        {
                            type: "line",
                            data: data.map((entry) => entry.value),
                            backgroundColor: "transparent",
                            borderColor: "#007bff",
                            pointBorderColor: "#007bff",
                            pointBackgroundColor: "#007bff",
                            fill: false,
                        },
                    ],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect,
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect,
                    },
                    legend: {
                        display: false,
                    },
                    scales: {
                        yAxes: [
                            {
                                gridLines: {
                                    display: true,
                                    lineWidth: "4px",
                                    color: "rgba(0, 0, 0, .2)",
                                    zeroLineColor: "transparent",
                                },
                                ticks: $.extend(
                                    {
                                        beginAtZero: true,
                                        suggestedMax: 200,
                                    },
                                    ticksStyle
                                ),
                            },
                        ],
                        xAxes: [
                            {
                                display: true,
                                gridLines: {
                                    display: false,
                                },
                                ticks: ticksStyle,
                            },
                        ],
                    },
                },
            });
        },
        error: function (error) {
            console.error("Error fetching chart data:", error);
        },
    });
});

// lgtm [js/unused-local-variable]
