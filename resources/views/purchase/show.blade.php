<x-app-layout>
    @section('breadcrumb')
        {{ Breadcrumbs::render('customer.show', $customer) }}
    @endsection

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">

                            <h3 class="profile-username text-center">{{ $customer->name }}</h3>
                            <h4 class="text-muted text-center">{{ $customer->card }}</h4>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Phone</b> <a class="float-right">{{ $customer->phone }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Vehicle Number</b> <a class="float-right">{{ $customer->phone }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Paymnt Method</b> <a class="float-right">{{ $customer->payment_type }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Payment Detail</b> <a class="float-right">{{ $customer->payment_detail }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>City</b> <a class="float-right">{{ $customer->city }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>State</b> <a class="float-right">{{ $customer->state }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Address</b> <a class="float-right">{{ $customer->address }}</a>
                                </li>
                            </ul>

                            <a href="" class="btn btn-info">Edit</a>
                            <a href="" class="btn btn-success">Create Payment</a>
                            <a href="" class="btn btn-primary">Add Activity</a>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                        data-toggle="tab">Activity</a></li>
                                <li class="nav-item"><a class="nav-link" href="#purchase" data-toggle="tab">Payment History</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <!--Begin::activity panel-->
                                <div class="active tab-pane table-responsive" id="activity">
                                    <table class="table table-sm">

                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Vehicle Number</th>
                                                <th>Progress</th>
                                                <th style="width: 40px">Label</th>
                                                <th style="width: 40px">Action</th>
                                            </tr>
                                        </thead>
            
                                        <tbody>
            
                                            <tr>
                                                <td>1.</td>
                                                <td>Username 1</td>
                                                <td>+91 9794445940</td>
                                                <td>Up 53 AD 7099</td>
                                                <td>
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-danger">55%</span></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-success"><i class="fas fa-money-bill"></i></button>
                                                </td>
                                            </tr>
            
                                            <tr>
                                                <td>1.</td>
                                                <td>Username 1</td>
                                                <td>+91 9794445940</td>
                                                <td>Up 53 AD 7099</td>
                                                <td>
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-danger">55%</span></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-success"><i class="fas fa-money-bill"></i></button>
                                                </td>
                                            </tr>
            
                                            <tr>
                                                <td>1.</td>
                                                <td>Username 1</td>
                                                <td>+91 9794445940</td>
                                                <td>Up 53 AD 7099</td>
                                                <td>
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-danger">55%</span></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-success"><i class="fas fa-money-bill"></i></button>
                                                </td>
                                            </tr>
            
                                            <tr>
                                                <td>1.</td>
                                                <td>Username 1</td>
                                                <td>+91 9794445940</td>
                                                <td>Up 53 AD 7099</td>
                                                <td>
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-danger">55%</span></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-success"><i class="fas fa-money-bill"></i></button>
                                                </td>
                                            </tr>
            
                                            <tr>
                                                <td>1.</td>
                                                <td>Username 1</td>
                                                <td>+91 9794445940</td>
                                                <td>Up 53 AD 7099</td>
                                                <td>
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-danger">55%</span></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-success"><i class="fas fa-money-bill"></i></button>
                                                </td>
                                            </tr>
            
            
                                        </tbody>
            
                                    </table>
                                </div>
                                <!--end::activity panel-->
                                <!--Begin::purchase panel-->
                                <div class="active tab-pane" id="purchase">
                                </div>
                                <!--end::purchase panel-->
                                <!--Begin::payment panel-->
                                <div class="tab-pane" id="payment">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputName"
                                                    placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName2"
                                                    placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputExperience"
                                                class="col-sm-2 col-form-label">Experience</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputSkills"
                                                    placeholder="Skills">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> I agree to the <a href="#">terms
                                                            and conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!--end::payment panel-->

                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

</x-app-layout>
