<x-layouts.app>
<head>
    <meta charset="UTF-8">
    <title>Customer Bag Backup</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 20px;
        }

        h1 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .meta {
            font-size: 11px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background: #f0f0f0;
            font-weight: bold;
        }

        .bag-number {
            font-weight: bold;
            white-space: nowrap;
        }

        /* PRINT OPTIMIZATION */
        @media print {
            body {
                margin: 0;
            }

            table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            thead {
                display: table-header-group;
            }
        }
    </style>
</head>
<body class="container">

    <h1>Customer Bag Backup</h1>

    <div class="meta">
        Generated on: {{ now()->format('Y-m-d H:i') }}<br>
        Total customers: {{ $customers->count() }}
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 60%;">Customer Name</th>
                <th style="width: 40%;">Bag Number</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>
                        {{ $customer->name }}
                    </td>

                    <td class="bag-number">
                        {{ $customer->account_number_accessor ?? '—' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-layouts.app>
