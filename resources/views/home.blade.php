@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row cards">

    </div>
    <div class="row" id="grafikContainer">
    </div>
    @can('mitra-only')
    <div class="col-lg-12 col-md-12 chartWrapper">
        <div class="card">
            <div class="card">
                <div class="card-header">Grafik Kemitraan (Kg)</div>
                <div class="card-body chartAreaWrapper">
                    <canvas id="chartMitra" width="300" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endcan
</div>
</div>
</div>

{{-- modal html --}}
@if (session()->has('info'))
<div class="alert alert-success">hello</div>
@endif

@endsection
@section('scripts')
@parent
<script>
    let {users_beli, users_jual, user_count, buyer_count, supplier_count, jumlah_supplier, jumlah_buyer, jumlah_plastik, jumlah_pembelian, grafik = {}, total_tonase_beli,grafik_admin } = {!! json_encode($dasboard)!!}
    let Color1 = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 99, 132, 0.2)',
        ]
    let Color2 = [
        '#2980b9',
        '#2980b9',
        '#2980b9',
        '#2980b9',
        '#2980b9',
        '#2980b9',
        '#2980b9',
        '#2980b9',
        '#2980b9'
    ]

    let Color3 = [
        '#e74c3c',
        '#e74c3c',
        '#e74c3c',
        '#e74c3c',
        '#e74c3c',
        '#e74c3c',
        '#e74c3c',
        '#e74c3c',
        '#e74c3c',
    ]
  
   
    function grafik_user(data) {
        let grafik_user = { labels: [], pengumpulan: [], baseline: [], target: [] }
        data.forEach(element => {
            grafik_user.labels.push(element.nama_plastik)
            grafik_user.pengumpulan.push(element.pengumpulan)
            grafik_user.baseline.push(element.baseline)
            grafik_user.target.push(element.target)

        });
        return grafik_user;
    }
        const myoption = {
                responsive: true,
                legend: {
                position: 'bottom',
                display: true,
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Grafik'
                    }
                }
                ,
                scales: {
                    y: {
                        min: 0,
                    }
                },
				tooltips: {
					enabled: true
				},
				hover: {
					animationDuration: 1
				},
				animation: {
				duration: 1,
				onComplete: function () {
					let chartInstance = this.chart,
						ctx = chartInstance.ctx;
						ctx.textAlign = 'center';
						ctx.fillStyle = "rgba(0, 0, 0, 1)";
						ctx.textBaseline = 'bottom';
						this.data.datasets.forEach(function (dataset, i) {
							let meta = chartInstance.controller.getDatasetMeta(i);
							meta.data.forEach(function (bar, index) {
								let data = dataset.data[index];
								ctx.fillText(data, bar._model.x, bar._model.y - 5);
							});
						});
					}
				}
			};
    const basicOption = {
        responsive: true,
                legend: {
                position: 'bottom',
                display: true,
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                    }
                }
                ,
                scales: {
                    y: {
                        min: 0,
                    }
                },
                
    }
   
    function adminCard(val = 0, label = 'label', icon = 'info-box-icon', color = 'primary') {
        let parent = $('.cards');
        let child =
            ` <div class="col-lg-3 col-sm-6 col-md-4">
            <div class="info-box mb-3">
                <span class=" info-box-icon bg-${color} elevation-1"><i class="fas ${icon}"></i></span>
                <div class="info-box-content">
                    <small class="info-box-text">${label}</small>
                    <span class="info-box-number">${val}</span>
                </div>
            </div>
        </div>`
        parent.append(child)
    }
</script>
@can('admin-only')
<script>
    // jika admin
    adminCard(user_count, 'Jumlah User', 'fa-users', 'danger');
    adminCard(buyer_count, 'Jumlah Buyer', 'fa-chalkboard-teacher', 'secondary');
    adminCard(supplier_count, 'Jumlah Supplier', 'fa-address-card', 'info');
    // grafikBeratKategori('Grafik Penjualan', 'chartJual', users_jual)
    grafikPerUser(grafik_admin)
    function grafikPerUser(arr)
    {
        let bgColor = ['#9b59b6','#3498db','#e67e22','#2ecc71','#f39c12','#1abc9c','#c0392b'];
        let grafikContainer = $('#grafikContainer')
        console.log(arr)
        let user = Object.entries(arr)
        let userData = []
        for (let i = 0; i < user.length; i++){
            let val = Object.entries(user[i])
            console.log(val[1][1].baseline)
            grafikContainer.append(`  
            <div class="col-lg-6 col-md-12 chartWrapper">   
               <div class="card" id="">
                <div class="card-header">
                    Pengumpulan - ${user[i][0]}
                </div>
                <div class="card-body chartAreaWrapper">
                    <canvas id="chartBeli-${i}" width="300" height="150"></canvas>
                </div>
            </div>`)
        grafikPerPlastik(`Grafik Pengumpulan ${val[1][1].plastik}`,`chartBeli-${i}`, val[1][1].plastik ,val[1][1].pengumpulan, val[1][1].baseline, val[1][1].target, Color1)
      
        }
    }

    function grafikPerPlastik(title, selector, label, pengumpulan, baseline, target,color) {
        let ctx = document.getElementById(selector).getContext('2d');
        let myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                datasets: [{
                    type: 'bar',
                    label: 'Pengumpulan',
                    data: pengumpulan, //.map(function (n) { return n / 1000 }),
                    backgroundColor: Color1,
                    borderColor: 'red',
                    borderWidth:{ top:5, right:0, bottom:0, left:0 },
                },
                {
                    type: 'bubble',
                    label: 'Baseline',
                    lineTension: 0, 
                    data: baseline, //.map(function (n) { return n / 1000 }),
                    borderColor:  'lime',
                    borderWidth: 1
                    //backgroundColor: Color2,
                },
                {
                    type: 'bubble',
                    lineTension: 0, 
                    label: 'Target',
                    data: target, //.map(function (n) { return n / 1000 }),
                    borderColor:  'blue',
                    borderWidth: 1
                }],
                labels: label
            },
            options: {
                elements: {
                    line: {
                        fill: false
                    },
                },
                responsive: true,
                legend: {
                position: 'bottom',
                display: true,
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                    }
                }
                ,
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMax: Math.max(...pengumpulan, ...baseline, ...target)  + 10,
                            beginAtZero: true
                        }
                    }]
                },
                animation: {
				duration: 1,
				onComplete: function () {
					let chartInstance = this.chart,
						ctx = chartInstance.ctx;
						ctx.textAlign = 'center';
						ctx.fillStyle = "rgba(0, 0, 0, 1)";
						ctx.textBaseline = 'bottom';
						this.data.datasets.forEach(function (dataset, i) {
							let meta = chartInstance.controller.getDatasetMeta(i);
							meta.data.forEach(function (bar, index) {
								let data = dataset.data[index];
								ctx.fillText(data, bar._model.x, bar._model.y - 5);
							});
						});
					}
				}
                
         },
        },
        );
    }
    function getBerat(data = []) {
        let berats = []
        let labels = []
        let dataset = []
        const items = Object.entries(data)
        for (const item of items) {
            labels.push(item[0])
            berats.push(item[1])
        }
        dataset[0] = labels
        dataset[1] = berats
        return dataset
    }
    
    function grafikBerat() {
        let dataset = getBerat(users_beli)
        let ctx = document.getElementById('chartAdmin').getContext('2d');
        let myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dataset[0],
                datasets: [{
                    data: dataset[1],
                    borderWidth: 2,
                    backgroundColor: ['#ff0000', '#ff4000', '#ff8000', '#ffbf00', '#ffbf00', '#ffff00', '#bfff00', '#80ff00', '#40ff00', '#00ff00'],
                    borderColor: Color1
                }]
            },
            options: {
                responsive: true,
                legend: {
                position: 'bottom',
                display: true,
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                    }
                }
                ,
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMax: Math.max(...dataset[1]) + 2,
                            beginAtZero: true
                        }
                    }]
                },
                animation: {
				duration: 1,
				onComplete: function () {
					let chartInstance = this.chart,
						ctx = chartInstance.ctx;
						ctx.textAlign = 'center';
						ctx.fillStyle = "rgba(0, 0, 0, 1)";
						ctx.textBaseline = 'bottom';
						this.data.datasets.forEach(function (dataset, i) {
							let meta = chartInstance.controller.getDatasetMeta(i);
							meta.data.forEach(function (bar, index) {
								let data = dataset.data[index];
								ctx.fillText(data, bar._model.x, bar._model.y - 5);
							});
						});
					}
				}
                
         },
        },
        );
    }
    
</script>
@endcan

@can('mitra-only')
<script>
    let {grafik_mitra} =  {!! json_encode($dasboard)!!}
    let mitras = grafik_mitra
    function grafikMitra(title, selector) {
        let dataset =  [[],[]]
        mitras.forEach(function (element){
            dataset[0].push(element.nama_mitras.nama_mitra)
            dataset[1].push(element.total_berat)
        })
        let ctx = document.getElementById(selector).getContext('2d');
        let myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dataset[0],
                datasets: [{
                    data: dataset[1],
                    borderWidth: 2,
                    backgroundColor: ['#ff0000', '#ff4000', '#ff8000', '#ffbf00', '#ffbf00', '#ffff00', '#bfff00', '#80ff00', '#40ff00', '#00ff00'],
                }]
            },
            options: {
                responsive: true,
                legend: {
                position: 'bottom',
                display: true,
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                    }
                }
                ,
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMax: Math.max(...dataset[1]) + 2,
                            beginAtZero: true
                        }
                    }]
                },
                animation: {
				duration: 1,
				onComplete: function () {
					let chartInstance = this.chart,
						ctx = chartInstance.ctx;
						ctx.textAlign = 'center';
						ctx.fillStyle = "rgba(0, 0, 0, 1)";
						ctx.textBaseline = 'bottom';
						this.data.datasets.forEach(function (dataset, i) {
							let meta = chartInstance.controller.getDatasetMeta(i);
							meta.data.forEach(function (bar, index) {
								let data = dataset.data[index];
								ctx.fillText(data, bar._model.x, bar._model.y - 5);
							});
						});
					}
				}
                
         },
        },
        );
    }
    grafikMitra('Grafik Kemitraan', 'chartMitra')
</script>
@endcan


@cannot('admin-only')
<script>
    function grafikPerPlastik () {
        let grafikContainer = $('#grafikContainer')
        let bgColor = ['#9b59b6','#3498db','#e67e22','#2ecc71','#f39c12','#1abc9c','#c0392b'];
        let data = []
        for (let i = 0; i < grafik.length; i++) {
        console.log(grafik[i])
        grafikContainer.append(`  
            <div class="col-lg-6 col-md-12 chartWrapper">   
               <div class="card" id="">
                <div class="card-header">
                    JENIS : ${grafik[i].nama_plastik}
                </div>
                <div class="card-body chartAreaWrapper">
                    <canvas id="chartBeli-${i}" width="300" height="150"></canvas>
                </div>
            </div>`)
            grafikUserPerPlastik(`Grafik Pengumpulan ${grafik[i].nama_plastik}`,`chartBeli-${i}`, [grafik[i].nama_plastik], [grafik[i].pengumpulan], [grafik[i].baseline], [grafik[i].target], bgColor[i])
        }
    }
    grafikPerPlastik()
    adminCard(jumlah_supplier, 'Jumlah Supplier', 'fa-users', 'danger');
    adminCard(jumlah_buyer, 'Jumlah Buyer', 'fa-chalkboard-teacher', 'primary');
    adminCard(jumlah_plastik, 'Jumlah Plastik', 'fa-bars', 'warning');
    adminCard(jumlah_pembelian, 'Jumlah Berat Pengumpulan', 'fa-luggage-cart', 'info');
    //jika user
    let user_data = grafik_user(grafik)

    function grafiUserPlastik(title, selector, label, pengumpulan, baseline, target,color) {
        let ctx = document.getElementById(selector).getContext('2d');
        let myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                datasets: [{
                    type: 'bar',
                    label: `Pengumpulan (Kg) = ${pengumpulan}`,
                    data: pengumpulan, //.map(function (n) { return n / 1000 }),
                    backgroundColor: Color1,
                }, {
                    type: 'line',
                    label: `Baseline (Kg) = ${baseline}`,
                    data: baseline.tol, //.map(function (n) { return n / 1000 }),
                    backgroundColor: ['#ffbf00'],
                    borderColor: ['#ff0000'],
                    fill: false
                },
                {
                    type: 'line',
                    label: `Target (Kg) = ${target}`,
                    data: target, //.map(function (n) { return n / 1000 }),
                    backgroundColor: ['#ff0000'],
                    borderColor: ['#ffbf00'],
                    fill: false
                }],
                labels: grafik_user.labels
            },
            options: {
                responsive: true,
                legend: {
                position: 'bottom',
                display: true,
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                    }
                }
                ,
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMax: Math.max(...pengumpulan, ...baseline, ...target)  + 10,
                            beginAtZero: true
                        }
                    }]
                },
                animation: {
				duration: 1,
				onComplete: function () {
					let chartInstance = this.chart,
						ctx = chartInstance.ctx;
						ctx.textAlign = 'center';
						ctx.fillStyle = "rgba(0, 0, 0, 1)";
						ctx.textBaseline = 'bottom';
						this.data.datasets.forEach(function (dataset, i) {
							let meta = chartInstance.controller.getDatasetMeta(i);
							meta.data.forEach(function (bar, index) {
								let data = dataset.data[index];
								ctx.fillText(data, bar._model.x, bar._model.y - 5);
							});
						});
					}
				}
                
         },
        },
        );
    }

    function grafikUserPerPlastik(title, selector, label, pengumpulan, baseline, target,color){
let canvas = document.getElementById(selector);
let ctx = canvas.getContext("2d");
let horizonalLinePlugin = {
  afterDraw: function(chartInstance) {
    let yScale = chartInstance.scales["y-axis-0"];
    let canvas = chartInstance.chart;
    let ctx = canvas.ctx;
    let index;
    let line;
    let style;
    if (chartInstance.options.horizontalLine) {
      for (index = 0; index < chartInstance.options.horizontalLine.length; index++) {
        line = chartInstance.options.horizontalLine[index];
        if (!line.style) {
          style = "lime";
        } else {
          style = line.style;
        }
        if (line.y) {
          yValue = yScale.getPixelForValue(line.y);
        } else {
          yValue = 0;
        }
        ctx.lineWidth = 2;
        if (yValue) {
          ctx.beginPath();
          ctx.moveTo(0, yValue);
          ctx.lineTo(canvas.width, yValue);
          ctx.strokeStyle = style
          ctx.stroke();
        }
        if (line.text) {
          ctx.fillStyle = '#2d3436';
          ctx.fillText(line.text, 40, yValue + ctx.lineWidth);
        }
      }
      return;
    };
  }
};
Chart.pluginService.register(horizonalLinePlugin);
let data = {
  labels: label,
  datasets: [{
    label: label,
    fill: false,
    lineTension: 0.1,
    backgroundColor: "rgba(75,192,192,0.4)",
    borderColor: "rgba(75,192,192,1)",
    borderCapStyle: 'butt',
    borderDash: [],
    borderDashOffset: 0.0,
    borderJoinStyle: 'miter',
    pointBorderColor: "rgba(75,192,192,1)",
    pointBackgroundColor: "#fff",
    pointBorderWidth: 1,
    pointHoverRadius: 5,
    pointHoverBackgroundColor: "rgba(75,192,192,1)",
    pointHoverBorderColor: "rgba(220,220,220,1)",
    pointHoverBorderWidth: 2,
    pointRadius: 1,
    pointHitRadius: 10,
    data: pengumpulan,
  }]
};
let myChart = new Chart(ctx, {
  type: 'bar',
  data: {
                datasets: [{
                    type: 'bar',
                    label: `Pengumpulan (Kg) = ${pengumpulan.toLocaleString('id', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                                })}`,
                    backgroundColor: ['rgb(0,0,255,0.1)'],
                    data: pengumpulan, //.map(function (n) { return n / 1000 }),
                }, {
                    type: 'bubble',
                    label: `Baseline (Kg) = ${baseline.toLocaleString('id', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                                })}`,
                    data: baseline, //.map(function (n) { return n / 1000 }),
                    backgroundColor: ['lime'],
                    fill: false
                },
                {
                    type: 'bubble',
                    label: `Target (Kg) = ${target.toLocaleString('id', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                                })}`,
                    data: target, //.map(function (n) { return n / 1000 }),
                    backgroundColor: ['orange'],
                    fill: false
                }],
                labels: grafik_user.labels
            },
  options: {
    "horizontalLine": [{
      "y": target,
      "style": "orange",
    }, {
      "y": baseline,
      "style": "lime",
    }],
    scales: {
        yAxes: [{
            ticks: {
                suggestedMax: Math.max(pengumpulan,baseline,target) + 10,
                beginAtZero: true
            }
        }]
    },
    
  }
});
};
</script>
@endcannot
@endsection