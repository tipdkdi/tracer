@extends('template')

@section('content')
<h1>Selamat Datang Admin</h1>
<div class="mb-5">
    <div class="row g-2">
        <div class="col-12 col-sm-6 col-lg-6">
            <div class="card sh-11 hover-scale-up cursor-pointer">
                <div class="h-100 row g-0 card-body align-items-center py-3">
                    <div class="col-auto pe-3">
                        <div class="bg-gradient-2 sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center">
                            <i data-cs-icon="user" class="text-white"></i>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row gx-2 d-flex align-content-center">
                            <div class="col-12 col-xl d-flex">
                                <div class="d-flex align-items-center lh-1-25">Total Alumni Login</div>
                            </div>
                            <div class="col-12 col-xl-auto">
                                <div class="cta-2 text-primary">{{$totalMasukSistem}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('js')
<!-- <script>
    class Charts {
        constructor() {
            // Initialization of the page plugins
            if (typeof Chart === 'undefined') {
                console.log('Chart is undefined!');
                return;
            }
            this._pieChart = null;
            this._initPieChart();
            _initPieChart() {
                if (document.getElementById('pieChart')) {
                    const pieChart = document.getElementById('pieChart');
                    this._pieChart = new Chart(pieChart, {
                        type: 'pie',
                        data: {
                            labels: ['Breads', 'Pastry', 'Patty'],
                            datasets: [{
                                label: '',
                                borderColor: [Globals.primary, Globals.secondary, Globals.tertiary],
                                backgroundColor: ['rgba(' + Globals.primaryrgb + ',0.1)', 'rgba(' + Globals.secondaryrgb + ',0.1)', 'rgba(' + Globals.tertiaryrgb + ',0.1)'],
                                borderWidth: 2,
                                data: [15, 25, 20],
                            }, ],
                        },
                        draw: function() {},
                        options: {
                            plugins: {
                                datalabels: {
                                    display: false
                                },
                            },
                            responsive: true,
                            maintainAspectRatio: false,
                            title: {
                                display: false,
                            },
                            layout: {
                                padding: {
                                    bottom: 20,
                                },
                            },
                            legend: {
                                position: 'bottom',
                                labels: ChartsExtend.LegendLabels(),
                            },
                            tooltips: ChartsExtend.ChartTooltip(),
                        },
                    });
                }
            }
        }
    }
</script> -->
@endsection