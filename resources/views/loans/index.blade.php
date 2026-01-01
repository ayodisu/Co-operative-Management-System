@extends('layouts.main')

@section('title', 'Loan Requests')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Loan Requests</h4>
                    <p class="card-description"> Review and manage user loan applications </p>

                    <div class="table-responsive">
                        <table class="table table-hover datatable">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Amount</th>
                                    <th>Term</th>
                                    <th>Status</th>
                                    <th>Requested</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jane Doe</td>
                                    <td>₦200,000</td>
                                    <td>12 months</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>2 days ago</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">Review</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>John Smith</td>
                                    <td>₦150,000</td>
                                    <td>6 months</td>
                                    <td><span class="badge bg-success">Approved</span></td>
                                    <td>5 days ago</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-secondary">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bola Ade</td>
                                    <td>₦300,000</td>
                                    <td>9 months</td>
                                    <td><span class="badge bg-danger">Rejected</span></td>
                                    <td>1 week ago</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-secondary">View</a>
                                    </td>
                                </tr>
                                <!-- Add more dummy rows if needed -->
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>
@endsection
