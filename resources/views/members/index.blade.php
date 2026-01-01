@extends('layouts.main')

@section('title', 'Manage Members')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Members</h4>
                    <p class="card-description"> View and manage registered cooperative members </p>

                    <div class="table-responsive">
                        <table class="table table-hover" id="membersTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Joined</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $members = [
                                        [
                                            'Jane Doe',
                                            'jane@example.com',
                                            '08012345678',
                                            '01 Jan 2024',
                                            'Active',
                                            'Level 12',
                                            2015,
                                            '₦50,000',
                                            '₦4,500,000',
                                            2045,
                                            '₦10,000',
                                            '₦150,000',
                                        ],
                                        [
                                            'John Smith',
                                            'john@example.com',
                                            '08087654321',
                                            '15 Mar 2024',
                                            'Suspended',
                                            'Level 10',
                                            2018,
                                            '₦40,000',
                                            '₦1,800,000',
                                            2050,
                                            '₦5,000',
                                            '₦50,000',
                                        ],
                                        [
                                            'Mary Johnson',
                                            'mary@example.com',
                                            '-',
                                            '20 Apr 2024',
                                            'Pending',
                                            'Level 8',
                                            2020,
                                            '₦35,000',
                                            '₦1,000,000',
                                            2055,
                                            '₦3,000',
                                            '₦25,000',
                                        ],
                                        [
                                            'Peter Obi',
                                            'peter@example.com',
                                            '08123456789',
                                            '10 May 2024',
                                            'Active',
                                            'Level 14',
                                            2010,
                                            '₦60,000',
                                            '₦6,000,000',
                                            2040,
                                            '₦12,000',
                                            '₦200,000',
                                        ],
                                        [
                                            'Grace Adams',
                                            'grace@example.com',
                                            '08098765432',
                                            '05 Jun 2024',
                                            'Active',
                                            'Level 9',
                                            2017,
                                            '₦38,000',
                                            '₦1,500,000',
                                            2052,
                                            '₦0',
                                            '₦0',
                                        ],
                                    ];
                                @endphp

                                @foreach ($members as $index => $m)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $m[0] }}</td>
                                        <td>{{ $m[1] }}</td>
                                        <td>{{ $m[2] }}</td>
                                        <td>{{ $m[3] }}</td>
                                        <td>
                                            <label
                                                class="badge
                                            @if (strtolower($m[4]) == 'active') badge-success
                                            @elseif(strtolower($m[4]) == 'suspended') badge-danger
                                            @else badge-secondary @endif">
                                                {{ $m[4] }}
                                            </label>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary view-btn"
                                                data-fullname="{{ $m[0] }}" data-grade="{{ $m[5] }}"
                                                data-appointment="{{ $m[6] }}" data-monthly="{{ $m[7] }}"
                                                data-total="{{ $m[8] }}" data-retirement="{{ $m[9] }}"
                                                data-loan-deduction="{{ $m[10] }}"
                                                data-loan-balance="{{ $m[11] }}">
                                                View
                                            </button>
                                            <button class="btn btn-sm btn-warning">Suspend</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="memberModal" tabindex="-1" aria-labelledby="memberModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="memberModalLabel">Member Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Full Name</th>
                                <td id="modalFullName"></td>
                            </tr>
                            <tr>
                                <th>Grade Level</th>
                                <td id="modalGrade"></td>
                            </tr>
                            <tr>
                                <th>Appointment Year</th>
                                <td id="modalAppointment"></td>
                            </tr>
                            <tr>
                                <th>Monthly Contribution</th>
                                <td id="modalMonthly"></td>
                            </tr>
                            <tr>
                                <th>Total Contribution</th>
                                <td id="modalTotal"></td>
                            </tr>
                            <tr>
                                <th>Retirement Year</th>
                                <td id="modalRetirement"></td>
                            </tr>
                            <tr>
                                <th>Loan Deduction</th>
                                <td id="modalLoanDeduction"></td>
                            </tr>
                            <tr>
                                <th>Loan Balance</th>
                                <td id="modalLoanBalance"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#membersTable').DataTable();

            $('.view-btn').on('click', function() {
                $('#modalFullName').text($(this).data('fullname'));
                $('#modalGrade').text($(this).data('grade'));
                $('#modalAppointment').text($(this).data('appointment'));
                $('#modalMonthly').text($(this).data('monthly'));
                $('#modalTotal').text($(this).data('total'));
                $('#modalRetirement').text($(this).data('retirement'));
                $('#modalLoanDeduction').text($(this).data('loan-deduction'));
                $('#modalLoanBalance').text($(this).data('loan-balance'));
                new bootstrap.Modal(document.getElementById('memberModal')).show();
            });
        });
    </script>
@endsection
