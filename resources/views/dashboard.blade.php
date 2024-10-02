<x-app-layout>

    @section('breadcrumb')
        {{ Breadcrumbs::render('dashboard') }}
    @endsection


    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center display-5">Search</h2>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form action="{{ route('customer.index') }}">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control form-control-lg"
                                    placeholder="Type your keywords here">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-lg btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <h5 class="mb-2">Info Box</h5>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Customer</span>
                        <span class="info-box-number">{{ \App\Models\Customer::count() }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Sale</span>
                        <span class="info-box-number">{{ \App\Models\Purchase::sum('amt') }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Reward</span>
                        <span class="info-box-number">{{ \App\Models\Purchase::sum('reward') }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Payment</span>
                        <span class="info-box-number">{{ \App\Models\Redeem::sum('pay_amt') }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>


    <div class="container-fluid">
        <div class="row">

            <div class="col-md-6">
                <!-- BAR CHART -->
                <div class="card">
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="barChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-md-6">

                <div class="card">

                    <div class="card-header">

                        <h3 class="card-title">Rewarded Customer</h3> &nbsp;|&nbsp;
                        <a href="{{route("reward-export")}}">Export</a>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0 table-responsive">

                        <table class="table table-sm">

                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Vehicle Number</th>
                                    <th>Total Point</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($rewards as $key => $item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->vehicle_number}}</td>                                       
                                        <td><span class="badge bg-info">{{$item->rewards}}</span></td>
                                        <td>
                                            <a href="{{ route('redeem.create',$item->customer_id)}}" class="btn btn-sm btn-outline-success"><i
                                                    class="fas fa-money-bill-wave"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        </div>
    </div>


    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">

                        <h3 class="card-title">New Customer</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0 table-responsive">

                        <table class="table table-sm">

                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Card</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Vehicle Number</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @if (count($customers) > 0)

                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>#</td>
                                            <td>{{ $customer->card }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>{{ $customer->vehicle_number }}</td>
                                            <td>{{ $customer->city }}</td>
                                            <td>{{ $customer->state }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('customer.show', $customer) }}" class="btn btn-warning" title="View"><i class="fas fa-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center">No Record Found..</td>
                                    </tr>
                                @endif

                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        </div>
    </div>


    @section('script')
        <script>
            var areaChartData = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October','November', 'December'],
                datasets: [{
                    label: 'Sell',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: true,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: @json($saledata),
                }, ]
            }
            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            barChartData.datasets[0] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
        </script>
    @endsection

</x-app-layout>
