console.log('hello')
function grafikPerPlastikOk(title, selector, label, pengumpulan, baseline, target, color){
    var ctx = document.getElementById(selector).getContext("2d");
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["x1", "x2", "x3", "x4", "x5"],
            datasets: [
            {
                label: "First",
                backgroundColor: 'white',
                borderColor: 'blue',
                borderWidth: {left:0, top: 5, right:0, bottom:0},
                data: [10, 20, 30, 54, 76],
                yAxisID: "bar-y-axis1",
                xAxisID: "bar-x-axis3",
                stack: 2
            },                  
            {
                label: "Fifth",
                backgroundColor: 'white',
                borderColor: 'green',
                borderWidth: {left:0, top: 5, right:0, bottom:0},
                data: [20, 10, 25, 36, 48],
                yAxisID: "bar-y-axis1",
                xAxisID: "bar-x-axis3",
                stack: 2
            },{
                label: "Sixth",
                backgroundColor: 'white',
                borderColor: 'red',
                borderWidth: {left:0, top: 5, right:0, bottom:0},
                data: [30, 40, 60, 70, 48],
                yAxisID: "bar-y-axis1",
                xAxisID: "bar-x-axis3",
                stack: 2
            },
            ]
        },
        options: {
            scales: {
                xAxes: [{
                    stacked: true,
                    id: "bar-x-axis1",
                    barThickness: 30,
                }, {
                    display: false,
                    stacked: true,
                    id: "bar-x-axis2",
                    barThickness: 70,
                    // these are needed because the bar controller defaults set only the first x axis properties
                    type: 'category',
                    categoryPercentage: 1.5,
                    barPercentage: 1,
                    gridLines: {
                        offsetGridLines: true
                    }
                },
                {
                    display: false,
                    stacked: true,
                    id: "bar-x-axis3",
                    barThickness: 70,
                    type: 'category',
                    categoryPercentage: 1,
                    barPercentage: 1,
                    gridLines: {
                        offsetGridLines: true
                    }
                }],

                yAxes: [{
                    id: "bar-y-axis1",
                    stacked: false,
                    ticks: {
                        beginAtZero: true,
                        max:100
                    },
                },
                {
                    id: "bar-y-axis2",
                    display:false,
                    stacked: true,
                    ticks: {
                        beginAtZero: true,
                        max:100
                    },
                }]

            }
        }
    });
}