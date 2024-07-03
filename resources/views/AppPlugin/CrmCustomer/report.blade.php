@extends('admin.layouts.app')

@section('StyleFile')

@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Donut Chart</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="hany" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Pie Chart</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>
    {{--    <x-admin.hmtl.section>--}}
    {{--        <x-admin.card.def :page-data="$pageData" :title="$pageData['BoxH1']">--}}

    {{--        </x-admin.card.def>--}}
    {{--    </x-admin.hmtl.section>--}}
@endsection

@section('AddScript')
    <script src="{{ defAdminAssets('plugins/chart.js/Chart.min.js') }}"></script>
@endsection
@push('JsCode')
    <script>
        $(function () {
            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#hany').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'hany',
                    'IE',
                    'FireFox',
                    'Safari',
                    'Opera',
                    'Navigator',
                ],
                datasets: [
                    {
                        data: [700, 500, 400, 600, 300, 100],
                        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                    }
                ]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and doughnut using the method below.
            var donutChart = new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })






        })
    </script>
@endpush

