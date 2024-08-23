@extends('layouts.admin.app')
@section('title', 'Main')
@section('content')

    <div class="w-full">
        <div id="workplaces-chart" class="w-full">
        </div>
        <div id="contract_types-chart" class="w-full">
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.get('/admin/dashboard/getWorkplaces', function(data) {
                var options = {
                    series: data.series,
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: data.labels
                    },
                    yaxis: {
                        title: {
                            text: 'Workers'
                        }
                    },
                    fill: {
                        opacity: 1
                    },
                    colors: ['#1B3D73'],
                    tooltip: {
                        y: {
                            formatter: function(value) {
                                return value + " workers";
                            }
                        }
                    }
                };

                var workplaceChart = new ApexCharts(document.querySelector("#workplaces-chart"), options);
                workplaceChart.render();
            });

            $.get('/admin/dashboard/getContractTypes', function(data) {
                var options = {
                    series: data.series,
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: data.labels
                    },
                    yaxis: {
                        title: {
                            text: 'Contract Type'
                        }
                    },
                    fill: {
                        opacity: 1
                    },
                    colors: ['#FDC700'],
                    tooltip: {
                        y: {
                            formatter: function(value) {
                                return value + " contract types";
                            }
                        }
                    }
                };

                var contractTypeChart = new ApexCharts(document.querySelector("#contract_types-chart"),
                    options);
                contractTypeChart.render();
            });
        });
    </script>

@endsection
