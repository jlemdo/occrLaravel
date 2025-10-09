<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        /* ======== BASIC RESET ======== */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #222; }

        /* ======== LAYOUT WRAPPER ======== */
        .invoice-wrapper { width: 100%; max-width: 700px; margin: 0 auto; }

        /* ======== HEADER ======== */
        .header { text-align: center; margin-bottom: 10px; }
        .header img { width: 60px; height: 60px; object-fit: contain; }
        .header h1 { font-size: 20px; color: #e8544e; margin: 5px 0; }

        /* ======== INFO TABLE ======== */
        .info-table { width: 100%; margin-bottom: 8px; border-collapse: collapse; }
        .info-table td { padding: 2px 0; }
        .info-table .label { color: #555; }

        /* ======== DIVIDER ======== */
        .divider { border-top: 1px dashed #777; margin: 8px 0; }

        /* ======== ITEMS TABLE ======== */
        .items { width: 100%; border-collapse: collapse; }
        .items th { background: #e8544e; color: #fff; padding: 6px 4px; font-size: 12px; }
        .items td { padding: 6px 4px; border-bottom: 1px dashed #ccc; text-align: right; }
        .items td:first-child, .items th:first-child { text-align: left; }
        .items tr:last-child td { border-bottom: none; }

        /* ======== TOTALS TABLE ======== */
        .totals { width: 100%; margin-top: 6px; border-collapse: collapse; }
        .totals td { padding: 4px 0; }
        .totals .label { text-align: left; color: #555; }
        .totals .value { text-align: right; }
        .totals .grand { border-top: 1px solid #e8544e; font-weight: bold; }

        /* ======== FOOTER ======== */
        .footer { text-align: center; margin-top: 12px; font-size: 11px; color: #555; }
    </style>
</head>
<body>
@php
    // do all number work once so DomPDF only sees plain strings
    $gst   = round($total * 0.13, 2);
    $grand = round($total + $gst, 2);
@endphp

<div class="invoice-wrapper">
    <!-- HEADER -->
    <div class="header">
        <img src="{{ public_path('img/logoj.jpg') }}" alt="Logo">
        <h1>Spice Garden</h1>
        <p>House #12, Main Street, Karachi — +92 21 111 000 000</p>
    </div>

    <!-- ORDER INFO -->
    <table class="info-table">
        <tr>
            <td class="label">Bill #:</td>
            <td>{{ $order->id }}</td>
            <td class="label" style="text-align:right;">Date:</td>
            <td style="text-align:right;">{{ $order->created_at->format('d M Y') }}</td>
        </tr>
        <tr>
            <td class="label">Customer:</td>
            <td colspan="3">{{ $user->first_name ?? '—' }} {{ $user->last_name ?? '—' }}</td>
        </tr>
    </table>

    <div class="divider"></div>

    <!-- ITEMS -->
    <table class="items">
        <thead>
            <tr>
                <th style="width:50%">Item</th>
                <th style="width:12%">Qty</th>
                <th style="width:18%">Price</th>
                <th style="width:20%">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderDetails as $item)
                <tr>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->item_qty }}</td>
                    <td>{{ number_format($item->item_price, 2) }}</td>
                    <td>{{ number_format($item->item_qty * $item->item_price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- TOTALS -->
    <table class="totals">
        <tr>
            <td class="label">Subtotal</td>
            <td class="value">{{ number_format($total, 2) }}</td>
        </tr>
        <tr>
            <td class="label">GST 13%</td>
            <td class="value">{{ number_format($gst, 2) }}</td>
        </tr>
        <tr class="grand">
            <td class="label">Grand Total</td>
            <td class="value">{{ number_format($grand, 2) }}</td>
        </tr>
    </table>

    <div class="footer">
        Thank you for ordering with us!<br>
        Follow us on Instagram @SpiceGardenPK
    </div>
</div>
</body>
</html>
