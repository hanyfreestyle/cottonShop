@extends('admin.layouts.app')

@section('StyleFile')
<style>
    /*
    .My_Chart_Legend{
        direction:rtl;
        text-align:right;
        margin-top:5px;
        font-size:17px!important;
        margin-left:10px;
        margin-right:10px;
    }
    .My_Chart_Legend{
        padding-right:5px!important;
        padding-left:5px!important;
        padding-top:8px!important;
    }
    .My_Chart_Legend{
        padding-top:8px!important;
        font-size:12px;
    }

    .My_Chart_Container{
        width: 100%;
        height: 300px;
        padding-bottom:10px;
        margin-bottom:5px;
        border-bottom:1px solid #CCCCCC;
    }
    .My_Chart_Container .placeholder{
        width: 100%;
        height: 100%;
        background-color: red;
    }
    /*





    .ChartTitle{
        padding-bottom:5px;
        margin-bottom:5px;
        border-bottom:1px solid #CCCCCC;
        font-size:14px;
    }
    .legend{
        direction:rtl!important
    }
    .legend table {
        direction:rtl!important;
        text-align:right;
        font-size:14px!important;
    }
    .adoptionLegendContainer2{
        direction:rtl!important;
        text-align:right;
        font-size:140px!important;
    }

    .thumbUploadPhto{
        margin:15px;
        max-width:250px;
        background-color:#FFFFFF;
        border:1px solid #CCCCCC;
        padding:4px;
    }
    */

</style>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>

        <div class="row">
            <x-admin.card.normal col="col-lg-3">
                <div class="My_Chart_Container">
                    <div id="demo1" class="placeholder"></div>
                </div>
                <div class="My_Chart_Legend demo1"></div>
            </x-admin.card.normal>


        </div>
    </x-admin.hmtl.section>


@endsection

@section('AddScript')
    <script src="{{ defAdminAssets('flot/jquery.flot.min.js') }}"></script>
    <script src="{{ defAdminAssets('flot/jquery.flot.pie.min.js') }}"></script>
@endsection

@push('JsCode')

    <script type="text/javascript">

        $(function () {
            var data = [
            	{ label: "Series1",  data: 50},
            	{ label: "Series2",  data: 30},
            	{ label: "Series3",  data: 10},

            	{ label: "Series4",  data: 10,color:"#000"},
            ];

            $.plot('#demo1', data, {
                colors: ["#b2d766", "#ff8154", "#878bb8",  "#ffe989", "#4ac9b4"],
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        innerRadius: 0.5,
                        label: {
                            show: true,
                            radius: 3/4,
                            formatter: labelFormatter,
                            background: {
                                opacity: 0.8,
                                color: '#000'
                            }
                        }
                    }
                },
                legend: {
                    show: true,
                    container: ".demo1",
                }
            });

            function labelFormatter(label, series) {
                return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + Math.round(series.percent) + "%</div>";
            }
    });


    </script>
@endpush

