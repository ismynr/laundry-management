<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laundry Invoice</title>
    <style>
    .invoice-box {
        max-width: 800px;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 12px;
        line-height: 18px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="3">
                    <table>
                        <tr>
                            <td class="title">
                                {{-- <img src="https://www.sparksuite.com/images/logo.png" style="width:100%; max-width:130px;"> --}}
                            </td>
                            <td>
                                Invoice #{{ $invoice->code }}<br>
                                Dibuat: {{ FormatHelp::hari($invoice->start_date) }}<br>
                                Hari ini: {{ FormatHelp::hari(date('d-m-Y')) }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="3">
                    <table>
                        <tr>
                            <td>
                                Sparksuite, Inc.<br>
                                12345 Sunny Road<br>
                                Sunnyville, CA 12345
                            </td>
                            <td>
                                {{ $invoice->user->name }}<br>
                                {{ $invoice->user->email }}<br>
                                {{ $invoice->user->karyawan->telephone ?? '' }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td colspan="2">Customer</td>
                <td style="text-align: right;">Status</td>
            </tr>
            
            <tr class="details">
                <td>{{ $invoice->customer->name}}</td>
                <td></td>
                <td style="text-align: right;">Lunas</td>
            </tr>
            
            <tr class="heading">
                <td>Item</td>
                <td>Qty</td>
                <td style="text-align: right;">Harga</td>
            </tr>
            @php
                $total_harga = 0;
            @endphp
            @foreach ($invoice->transactionDetail as $item)
                @php $total_harga += $item->package->harga @endphp
                <tr>
                    <td> {{ $item->package->nama_paket }} </td>
                    <td> {{ $item->qty . ' ' . $item->package->tipe_berat }} </td>
                    <td style="text-align: right;"> {{ FormatHelp::rupiah($item->package->harga) }} </td>
                </tr>
            @endforeach
            
            <tr class="heading">
                <td colspan="2">Total</td>
                <td>{{ FormatHelp::rupiah($total_harga) }}</td>
            </tr>
        </table>
    </div>
</body>
</html>