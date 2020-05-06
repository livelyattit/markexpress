@extends('admin_layouts.default')
@section('content')
<div class="page-content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2 class="page-title">Dashboard</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <div class="info-card-text">
                            <div class="table-container">
                                <table id="users_table" class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="info-card-icon">
                            <i class="material-icons">account_circle</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><!-- Page Content -->
@stop
