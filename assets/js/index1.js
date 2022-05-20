$(function(e) {
    'use strict'


    // RECENT ORDERS
    var myCanvas = document.getElementById("recentorders");
    myCanvas.height = "225";
    var myChart = new Chart(myCanvas, {
        type: 'bar',
        data: {
            labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            datasets: [{
                label: 'This Month',
                data: [27, 50, 28, 50, 28, 30, 22],
                backgroundColor: '#61c9fc',
                borderWidth: 2,
                hoverBackgroundColor: '#61c9fc',
                hoverBorderWidth: 0,
                borderColor: '#61c9fc',
                hoverBorderColor: '#61c9fc',
                borderDash: [5, 2],
            }, {
                label: 'This Month',
                data: [32, 58, 68, 65, 40, 68, 58],
                backgroundColor: '#f38ff3',
                borderWidth: 2,
                hoverBackgroundColor: '#f38ff3',
                hoverBorderWidth: 0,
                borderColor: '#f38ff3',
                hoverBorderColor: '#f38ff3',
                borderDash: [5, 2],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            },
            tooltips: {
                enabled: false,
            },
            scales: {
                yAxes: [{
                    display: false,
                    gridLines: {
                        display: false,
                        drawBorder: false,
                        zeroLineColor: 'rgba(142, 156, 173,0.1)',
                        color: "rgba(142, 156, 173,0.1)",
                    },
                    scaleLabel: {
                        display: false,
                    },
                    ticks: {
                        beginAtZero: true,
                        stepSize: 25,
                        suggestedMin: 0,
                        suggestedMax: 100,
                        fontColor: "#8492a6",
                        userCallback: function(tick) {
                            return tick.toString() + '%';
                        }
                    },
                }],
                xAxes: [{
                    display: false,
                    barPercentage: 0.4,
                    barValueSpacing: 0,
                    barDatasetSpacing: 0,
                    barRadius: 0,
                    stacked: false,
                    ticks: {
                        beginAtZero: true,
                        fontColor: "#8492a6",
                    },
                    gridLines: {
                        color: "rgba(142, 156, 173,0.1)",
                        display: false
                    },

                }]
            },
            legend: {
                display: false
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        }
    });

    // SALES CHART

    // CHARTJS SALES CHART CLOSED

    // DATA TABLE
    $('#data-table').DataTable({
        "order": [
            [0, "desc"]
        ],
        order: [],
        columnDefs: [{ orderable: false, targets: [0, 4, 5] }],
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        }
    });

    // SELECT2
    $('.select2').select2({
        minimumResultsForSearch: Infinity
    });

    // WORLD MAP MARKER
    $('#world-map-markers1').vectorMap({
        map: 'world_mill_en',
        scaleColors: ['#6c5ffc', '#e82646', '#05c3fb'],

        normalizeFunction: 'polynomial',

        hoverOpacity: 0.7,

        hoverColor: false,

        regionStyle: {

            initial: {

                fill: '#edf0f5'
            }
        },
        markerStyle: {
            initial: {
                r: 6,
                'fill': '#6c5ffc',
                'fill-opacity': 0.9,
                'stroke': '#fff',
                'stroke-width': 9,
                'stroke-opacity': 0.2
            },

            hover: {
                'stroke': '#fff',
                'fill-opacity': 1,
                'stroke-width': 1.5
            }
        },
        backgroundColor: 'transparent',
        markers: [{
            latLng: [40.3, -101.38],
            name: 'USA',
        }, {
            latLng: [22.5, 1.51],
            name: 'India'
        }, {
            latLng: [50.02, 80.55],
            name: 'Bahrain'
        }, {
            latLng: [3.2, 73.22],
            name: 'Maldives'
        }, {
            latLng: [35.88, 14.5],
            name: 'Malta'
        }, ]
    });

});

function getCssValuePrefix() {
    'use strict'

    var retuenValue = ''; //default to standard syntax
    var prefixes = ['-o-', '-ms-', '-moz-', '-webkit-'];

    // Create a temporary DOM object for testing
    var dom = document.createElement('div');

    for (var i = 0; i < prefixes.length; i++) {
        // Attempt to set the style
        dom.style.background = prefixes[i] + 'linear-gradient(#ffffff, #000000)';

        // Detect if the style was successfully set
        if (dom.style.background) {
            retuenValue = prefixes[i];
        }
    }

    dom = null;
    dom.remove();

    return retuenValue;
}

