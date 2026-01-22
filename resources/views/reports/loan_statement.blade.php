<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Loan Statement</title>
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .details {
            margin-bottom: 20px;
        }

        .summary {
            margin-top: 30px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Loan Statement</h2>
        <p>Cooperative Society Management System</p>
    </div>

    <div class="details">
        <strong>Loan ID:</strong> #{{ $loan->id }}<br>
        <strong>Member Name:</strong> {{ $loan->user->name }}<br>
        <strong>Loan Amount:</strong> ₦{{ number_format($loan->amount, 2) }}<br>
        <strong>Purpose:</strong> {{ $loan->purpose }}<br>
        <strong>Status:</strong> {{ ucfirst($loan->status) }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Details</th>
                <th>Payment Method</th>
                <th>Amount Paid</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loan->repayments as $repayment)
                <tr>
                    <td>{{ $repayment->payment_date->format('Y-m-d') }}</td>
                    <td>{{ $repayment->remarks }}</td>
                    <td>{{ $repayment->payment_method }}</td>
                    <td>₦{{ number_format($repayment->amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <p>Total Repaid: ₦{{ number_format($loan->amount_repaid, 2) }}</p>
        <p>Balance Remaining: ₦{{ number_format($loan->balance_remaining, 2) }}</p>
    </div>
</body>

</html>
