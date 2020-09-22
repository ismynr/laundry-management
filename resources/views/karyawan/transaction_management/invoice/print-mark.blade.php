<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tanda Transaksi Laundry</title>
</head>

<body>
    <div style="margin-top:10px">
        <table style="width: 100%;">

            @php $no = 1; @endphp
            
            @foreach ($invoice->transactionDetail as $item)

                @if($no == 1)
                    <tr>
                @endif
                    <td style="border: 1px solid #eee; padding:15px; font-size:12px; line-height:18px">
                        Invoice #{{ $invoice->code }}<br>
                        Dibuat: {{ FormatHelp::hari($invoice->start_date) }}<br>
                        Pelanggan: {{ $invoice->customer->name }}  
                        <hr>
                        Paket: {{ $item->package->nama_paket }}<br>
                        Qty: {{ $item->qty . ' ' . $item->package->tipe_berat }}<br>
                        Harga: {{ FormatHelp::rupiah($item->package->harga) }}
                    </td>
                @if($no == 1)
                    @php $no++; @endphp
                @elseif ($no == 2)
                    </tr>
                    @php  $no = 1; @endphp
                @endif

                {{-- ditujuin buat nyetak sesuai value jumlah cetak yang dikirim --}}
                @foreach ($arrPrintMark as $keyItd => $valueItd) 
                    @if ($keyItd == $item->id)
                        @if ($valueItd > 1 )
                            @php $idxItd = 1; @endphp {{-- biar nggak kecetak dobel jadi 1 jgn 0 --}}
                            @while ($idxItd != $valueItd)
                                @if($no == 1)
                                    <tr>
                                @endif
                                    <td style="border: 1px solid #eee; padding:15px; font-size:12px; line-height:18px">
                                        Invoice #{{ $invoice->code }}<br>
                                        Dibuat: {{ FormatHelp::hari($invoice->start_date) }}<br>
                                        Pelanggan: {{ $invoice->customer->name }}  
                                        <hr>
                                        Paket: {{ $item->package->nama_paket }}<br>
                                        Qty: {{ $item->qty . ' ' . $item->package->tipe_berat }}<br>
                                        Harga: {{ FormatHelp::rupiah($item->package->harga) }}
                                    </td>
                                @if($no == 1)
                                    @php $no++; @endphp
                                @elseif ($no == 2)
                                    </tr>
                                    @php  $no = 1; @endphp
                                @endif
                                @php $idxItd++; @endphp
                            @endwhile
                        @else
                        
                        @endif
                    @endif
                @endforeach
                
            @endforeach
            
        </table>
    </div>
</body>
</html>