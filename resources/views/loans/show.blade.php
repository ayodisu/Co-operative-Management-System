@extends('layouts.main')

@section('title', 'Loan Review')

@section('content')
    <div class="row">
        <!-- Left Column: Member Info -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Member Info</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Name:</strong> Jane Doe</li>
                        <li class="list-group-item"><strong>Email:</strong> jane@example.com</li>
                        <li class="list-group-item"><strong>Phone:</strong> 08012345678</li>
                        <li class="list-group-item"><strong>Joined:</strong> 01 Jan 2024</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Right Column: Loan Info -->
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Loan Details</h5>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Amount Requested:</strong> ₦500,000.00</p>
                            <p><strong>Duration:</strong> 6 months</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Status:</strong>
                                <label class="badge badge-warning">Pending</label>
                            </p>
                            <p><strong>Applied On:</strong> 20 Jul 2025</p>
                        </div>
                    </div>

                    <p><strong>Reason / Purpose:</strong></p>
                    <p>To expand my small business and purchase inventory.</p>

                    <form class="mt-4">
                        <div class="form-group">
                            <label for="status">Take Action</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">-- Select --</option>
                                <option value="approved">Approve</option>
                                <option value="rejected">Reject</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="admin_note">Admin Note (Optional)</label>
                            <textarea name="admin_note" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Repayment schedule table -->
    <div class="row mt-3">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Repayment Schedule</h5>
                    <div class="table-responsive">
                        <table class="table table-hover" id="scheduleTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Due Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Paid At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>01 Aug 2025</td>
                                    <td>₦83,333.33</td>
                                    <td><label class="badge badge-success">Paid</label></td>
                                    <td>01 Aug 2025</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>01 Sep 2025</td>
                                    <td>₦83,333.33</td>
                                    <td><label class="badge badge-warning">Pending</label></td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>01 Oct 2025</td>
                                    <td>₦83,333.33</td>
                                    <td><label class="badge badge-danger">Overdue</label></td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>01 Nov 2025</td>
                                    <td>₦83,333.33</td>
                                    <td><label class="badge badge-warning">Pending</label></td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>01 Dec 2025</td>
                                    <td>₦83,333.33</td>
                                    <td><label class="badge badge-warning">Pending</label></td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>01 Jan 2026</td>
                                    <td>₦83,333.33</td>
                                    <td><label class="badge badge-warning">Pending</label></td>
                                    <td>-</td>
                                </tr>
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
            $('#scheduleTable').DataTable();
        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection
