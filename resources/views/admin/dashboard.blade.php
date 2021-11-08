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
<!-- <canvas id="example" width="300" height="300"></canvas> -->

@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="{{asset('/')}}radarGraph.min.js"></script>
<script>
    $(function() {
        $('#example').radarGraph({
            labels: [
                'aaa',
                'data point2',
                'data point3',
                'data point4',
            ],
            borderOffset: 1,

            chartData: {
                // color accepts hex value also : #666666
                '0': {
                    'name': 'thing1',
                    'score': [20, 15, 15, 16.6],
                    'color': 'red'
                },
                '1': {
                    'name': 'thing2',
                    'score': [17, 15, 15, 15.6],
                    'color': 'blue'
                },
                '2': {
                    'name': 'thing3',
                    'score': [20, 25, 20, 21.6],
                    'color': 'green'
                },
                '3': {
                    'name': 'thing4',
                    'score': [25, 15, 25, 21.6],
                    'color': 'purple'
                },
            },
        });
    });
</script>
@endsection