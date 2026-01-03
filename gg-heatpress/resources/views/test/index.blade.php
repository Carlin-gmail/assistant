<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transfer Types – Heat Press Reference</title>

    <style>
        /* ===============================
           PRINT SETUP
        =============================== */
        @page {
            size: letter;
            margin: 15mm;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10.5pt;
            color: #000;
            line-height: 1.3;
        }

        h1, h2 {
            margin: 0;
        }

        /* ===============================
           HEADER
        =============================== */
        .doc-header {
            text-align: center;
            margin-bottom: 18px;
        }

        .doc-header h1 {
            font-size: 20pt;
        }

        .doc-header p {
            font-size: 10pt;
        }

        /* ===============================
           SUPPLIER SECTION
        =============================== */
        .supplier {
            margin-bottom: 18px;
        }

        .supplier-title {
            font-size: 14pt;
            border-bottom: 1.5px solid #000;
            margin-bottom: 8px;
            padding-bottom: 3px;
        }

        /* ===============================
           GRID
        =============================== */
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        /* ===============================
           TRANSFER CARD
        =============================== */
        .transfer {
            border: 1px solid #000;
            padding: 6px 8px;
            break-inside: avoid;
        }

        .transfer-name {
            font-weight: bold;
            font-size: 11pt;
            margin-bottom: 4px;
        }

        .specs {
            width: 100%;
            border-collapse: collapse;
            font-size: 9.5pt;
        }

        .specs td {
            padding: 2px 4px;
            vertical-align: top;
        }

        .label {
            font-weight: bold;
            width: 40%;
        }

        .notes {
            font-size: 9pt;
            margin-top: 4px;
        }

        /* ===============================
           FOOTER
        =============================== */
        .doc-footer {
            text-align: center;
            font-size: 8.5pt;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    {{-- ===============================
         DOCUMENT HEADER
    =============================== --}}
    <div class="doc-header">
        <h1>Heat Press Transfer Types</h1>
        <p>Quick Production Reference – GG Heat Press</p>
    </div>

    {{-- ===============================
         SUPPLIER: HotPrint Co.
    =============================== --}}
    <section class="supplier">
        <h2 class="supplier-title">Supplier: HotPrint Co.</h2>

        <div class="grid">

            <div class="transfer">
                <div class="transfer-name">Premium Cotton Transfer</div>
                <table class="specs">
                    <tr><td class="label">Fabric</td><td>Cotton</td></tr>
                    <tr><td class="label">Temp</td><td>320°F</td></tr>
                    <tr><td class="label">Time</td><td>15 sec</td></tr>
                    <tr><td class="label">Peel</td><td>Hot</td></tr>
                </table>
            </div>

            <div class="transfer">
                <div class="transfer-name">Poly Blend Transfer</div>
                <table class="specs">
                    <tr><td class="label">Fabric</td><td>Poly / Cotton</td></tr>
                    <tr><td class="label">Temp</td><td>305°F</td></tr>
                    <tr><td class="label">Time</td><td>12 sec</td></tr>
                    <tr><td class="label">Peel</td><td>Cold</td></tr>
                </table>
            </div>

        </div>
    </section>

    {{-- ===============================
         SUPPLIER: FlexWorks
    =============================== --}}
    <section class="supplier">
        <h2 class="supplier-title">Supplier: FlexWorks</h2>

        <div class="grid">

            <div class="transfer">
                <div class="transfer-name">Stretch Performance Transfer</div>
                <table class="specs">
                    <tr><td class="label">Fabric</td><td>Performance</td></tr>
                    <tr><td class="label">Temp</td><td>300°F</td></tr>
                    <tr><td class="label">Time</td><td>10 sec</td></tr>
                    <tr><td class="label">Peel</td><td>Warm</td></tr>
                </table>
            </div>

            <div class="transfer">
                <div class="transfer-name">Low-Temp Nylon Transfer</div>
                <table class="specs">
                    <tr><td class="label">Fabric</td><td>Nylon</td></tr>
                    <tr><td class="label">Temp</td><td>280°F</td></tr>
                    <tr><td class="label">Time</td><td>8 sec</td></tr>
                    <tr><td class="label">Peel</td><td>Cold</td></tr>
                </table>
                <div class="notes">
                    Notes: Use protective sheet.
                </div>
            </div>

        </div>
    </section>

    <div class="doc-footer">
        Internal production reference · Update when specs change
    </div>

</body>
</html>
