    <head>
        <meta charset="UTF-8">
        <title>Customer Bag Backup</title>

        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px;
                color: #000;
                margin: 20px 100px 20px 20px;
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

            /* STRIPED ROWS */
            tbody tr:nth-child(even) {
                background: #fafafa;
            }

            .bag-number {
                font-weight: bold;
                white-space: nowrap;
            }

            /* DELETED STYLE */
            .deleted {
                color: #dc3545; /* bootstrap danger red */
                text-decoration: line-through;
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

<div class="utility-bar">

    <form method="GET" action="{{ route('settings.backup') }}">
        <label>
            Cutoff date:
            <input type="date" name="cut_date"
                value="{{ date('Y-m-d', strtotime(request()->input('cut_date', date('Y-m-d')))) }}"
            >
        </label>


        <button type="submit">
            Apply
        </button>
    </form>
    <div class="">
        <span class="" style="color:#dc3545; font-weight: 600">{{ $customers->count() }}</span> customers found.
    </div>

    <div class="text-muted" style="margin-top: 6px;">
        <em>
            Tip: Use a cutoff date to include only customers added after that date.
            Ideal for printing incremental updates instead of the full backup.
        </em>
    </div>

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
                    @php
                        $isDeleted = str_contains($customer->name, '(Deleted)');
                    @endphp

                    <tr>
                        <td class="{{ $isDeleted ? 'deleted' : '' }}">
                            {{ $customer->name }}
                        </td>

                        <td class="bag-number {{ $isDeleted ? 'deleted' : '' }}">
                            {{ $customer->account_number_accessor ?? '—' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </body>
