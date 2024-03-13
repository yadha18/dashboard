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

$(function () {
    "use strict";

    var ticksStyle = {
        fontColor: "#495057",
        fontStyle: "bold",
    };

    var mode = "index";
    var intersect = true;

    var $salesChart = $("#sales-chart");

    $.ajax({
        url: "/get-baddebt-2021",
        method: "GET",
        success: function (response) {
            var namaSBU = response.map(function (data) {
                return data.namaSBU;
            });

            var jumlah = response.map(function (data) {
                return data.jumlah;
            });

            var salesChart = new Chart($salesChart, {
                type: "bar",
                data: {
                    labels: namaSBU,
                    datasets: [
                        {
                            backgroundColor: "#007bff",
                            borderColor: "#007bff",
                            data: jumlah,
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
                                        callback: function (value) {
                                            if (value >= 1000) {
                                                value /= 1000;
                                                value += "k";
                                            }
                                            return "$" + value;
                                        },
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
    });
});

// lgtm [js/unused-local-variable]
