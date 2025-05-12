<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>VarneyaEx Studio - {{ str_replace("_", " ", $appname) }} </title>

    <!-- Custom fonts for this template-->
    <link href="{{ URL('assets/application/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ URL('assets/application/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('Front.Partials.app_sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
			@yield('content')

            @include('Front.Partials.app_footer')
		</div>
    </div>
    

	<!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

	<!-- Bootstrap core JavaScript-->
    <script src="{{ URL('assets/application/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL('assets/application/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL('assets/application/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ URL('assets/application/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ URL('assets/application/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL('assets/application/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL('assets/application/js/demo/datatables-demo.js') }}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        $(document).ready( function() {
            localStorage.removeItem('test');
        });

        $('.category').on('click', function() 
        {
            var category = $(this).data('val');
            $('.earnings').text(category +' Overview');
            $('.revenue').text(category  +' Sources');
            localStorage.setItem('test', category);
        });

        // Charts
        // Data retrieved https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature

        Highcharts.chart('container', {
            chart: {
                type: 'spline'
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ],
                accessibility: {
                    description: 'Months of the year'
                }
            },
            yAxis: {
                title: {
                    text: 'Number of Vendors'
                },
                labels: {
                    format: '{value}'
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: 'Vendor',
                marker: {
                    symbol: 'square'
                },
                data: [5.2, 5.7, 8.7, 13.9, 18.2, 21.4, 25.0, {
                    y: 26.4,
                    marker: {
                        symbol: 'url(https://www.highcharts.com/samples/graphics/sun.png)'
                    },
                    accessibility: {
                        description: 'Sunny symbol, this is the warmest point in the ' +
                            'chart.'
                    }
                }, 22.8, 17.5, 12.1, 7.6]

            }, {
                name: 'Supplier',
                marker: {
                    symbol: 'diamond'
                },
                data: [{
                    y: 1.5,
                }, 1.6, 3.3, 5.9, 10.5, 13.5, 14.5, 14.4, 11.5, 8.7, 4.7, 2.6]
            }]
        });
    </script>
</body>

<style>
    .highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
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
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

.highcharts-description {
    margin: 0.3rem 10px;
}
</style>
</html>