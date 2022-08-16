<div class="col-12">
    <h3>{{$titulo}} - <small>{{$titulo2}}</small></h3>
</div>
<div class="col-12 text-center">
    {{__('Total de Usuários Cadastrados no Sistema')}}: <b> {{$d_rel['total_users']}} </b>
</div>
<div class="col-12 mb-2">
    @isset($campos_form_consulta)
    <form action="" method="get">
        <div class="row">
            @foreach ($campos_form_consulta as $k=>$v)
            {!!App\Qlib\Qlib::qForm([
                'type'=>@$v['type'],
                'campo'=>$k,
                'label'=>$v['label'],
                'placeholder'=>@$v['placeholder'],
                'ac'=>'alt',
                'value'=>isset($v['value'])?$v['value']: @$value[$k],
                'tam'=>@$v['tam'],
                'event'=>@$v['event'],
                'checked'=>@$value[$k],
                    'selected'=>@$v['selected'],
                    'arr_opc'=>@$v['arr_opc'],
                    'option_select'=>@$v['option_select'],
                    'class'=>@$v['class'],
                    'class_div'=>@$v['class_div'],
                    'rows'=>@$v['rows'],
                    'cols'=>@$v['cols'],
                    'data_selector'=>@$v['data_selector'],
                    'script'=>@$v['script'],
                    'valor_padrao'=>@$v['valor_padrao'],
                    'dados'=>@$v['dados'],
                    ])!!}
            @endforeach
        </div>
    </form>
    @endisset
</div>
@isset($totais_gerais)
    @foreach ($totais_gerais as $kt=>$vt)
    <div class="col-md-4 border-top">
        <div class="row">
            <div class="col-6">
                {{$vt['label']}}:
            </div>
            <div class="col-6 text-right">
                <span class="badge badge-primary">
                    {{$vt['value']}}
                </span>
            </div>
        </div>
    </div>
    @endforeach
@endisset
@isset($d_rel['grafico'])
    <div class="col-md-12">
        <style type="text/css">
            .highcharts-figure,
            .highcharts-data-table table {
                min-width: 320px;
                max-width: 800px;
                margin: 1em auto;
            }

            .highcharts-data-table table {
                font-family: Verdana, sans-serif;
                border-collapse: collapse;
                border: 1px solid #ebebeb;
                margin: 10px auto;
                text-align: center;
                width: 100%;
                max-width: 500px;
            }

            .highcharts-data-table caption {
                padding: 1em 0;
                font-size: 1.2em;
                color: #555;
            }

            .highcharts-data-table th {
                font-weight: 600;
                padding: 0.5em;
            }

            .highcharts-data-table td,
            .highcharts-data-table th,
            .highcharts-data-table caption {
                padding: 0.5em;
            }

            .highcharts-data-table thead tr,
            .highcharts-data-table tr:nth-child(even) {
                background: #03973c;
            }

            .highcharts-data-table tr:hover {
                background: #f1f7ff;
            }

            input[type="number"] {
                min-width: 50px;
            }
            .highcharts-credits{
                display: none;
            }
        </style>
        <script src="{{URL::to('/')}}/js/charts/highcharts.js"></script>
        <script src="{{URL::to('/')}}/js/charts/modules/exporting.js"></script>
        <script src="{{URL::to('/')}}/js/charts/modules/export-data.js"></script>
        <script src="{{URL::to('/')}}/js/charts/modules/accessibility.js"></script>
        <figure class="highcharts-figure">
            <div id="container"></div>
            {{-- <p class="highcharts-description">
                Pie charts are very popular for showing a compact overview of a
                composition or comparison. While they can be harder to read than
                column charts, they remain a popular choice for small datasets.
            </p> --}}
        </figure>
        <script type="text/javascript">
            // Build the chart
            Highcharts.chart('container', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: '{{__('Porcentagem Estatística')}}'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: '{{__('Total')}}',
                    colorByPoint: true,
                    data: {!!App\Qlib\Qlib::lib_array_json($d_rel['grafico'])!!}
                }]
            });
        </script>
    </div>
@endisset
