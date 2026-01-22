<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Savings Statement</title>
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
    </style>
</head>

<body>
    <div class="header">
        <h2>Savings Statement</h2>
        <p>Cooperative Society Management System</p>
    </div>

    <div class="details">
        <strong>Member Name:</strong> {{ $user->name }}<br>
        <strong>Member ID:</strong> {{ $user->id }}<br>
        <strong>Current Balance:</strong> ₦{{ number_format($profile->total_contributions, 2) }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                    <td>{{ ucfirst($transaction->type) }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td>₦{{ number_format($transaction->amount, 2) }}</td>
                    <td>₦{{ number_format($transaction->balance_after, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
