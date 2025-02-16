<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Pembayaran</title>
    <link rel="stylesheet" href="{{ asset('css/pdf.css') }}" />
    <style type="text/css">
        @page {
            size: A4;
            margin: 0;
        }

        body {
            margin: 0;
        }

        @media screen {
            div.divFooter {
                display: none;
            }
        }

        @media print {
            div.divFooter {
                position: fixed;
                bottom: 0.6cm;
                text-align: right;

            }

            .noPrint {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <section class="sheet padding-5mm">

        @include('livewire.admin.laporan.partial.kop')
        <hr>
        <h2>
            <center>REKAPITULASI PEMBAYARAN</center>
        </h2>
        <br>
        <div class="row">
            <div class="col-md-6">
                @if ( request()->get('startdate') || request()->get('enddate') )
                    <table border="0">
                        <tr>
                            <td style="width: 50%;padding-right: 5%">Periode</td>
                            <td style="width: 5%;padding-right: 5%"> : </td>
                            <td>{{ request()->get('startdate') }}
                                @if (request()->get('enddate'))
                                    s/d {{ request()->get('enddate') }}
                                @endif
                            </td>
                            </td>
                        </tr>

                    </table>
                @endif
               
            </div>
        </div>

        <br />
        <table style="width: 100%" class="receipt-table full-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>KELURAHAN</th>
                    <th>KECAMATAN</th>
                    <th>TOTAL BANGUNAN</th>
                    <th>TOTAL RETRIBUSI</th>
                    <th>TOTAL RETRIBUSI YANG DIBAYAR</th>
                    
                   
                </tr>

            </thead>
            <tbody>
                @php
                    $no = 1;
                    $total_bangunan = 0;
                    $total_retribusi = 0;
                    $total_retribusi_bayar = 0;

                @endphp
                @foreach ($data as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        

                        <td >{{ $row->kelurahan}}</td>
                        <td>
                            {{ strtoupper($row->kecamatan) }}
                        </td>
                        <td align="center">{{ $row->total_bangunan }} </td>
                        <td align="right">Rp. {{ $row->total_retribusi ? number_format($row->total_retribusi) : 0 }} </td>
                        <td align="right">Rp. {{ $row->total_retribusi_bayar ? number_format($row->total_retribusi_bayar) :0 }} </td>

                    </tr>
                    @php
                        $total_bangunan += $row->total_bangunan;
                        $total_retribusi += $row->total_retribusi ? $row->total_retribusi : 0;
                        $total_retribusi_bayar += $row->total_retribusi_bayar ? $row->total_retribusi_bayar : 0;
                    @endphp
                @endforeach
                <tr>
                    <td colspan="3" align="center">TOTAL</td>
                    <td align="center">{{ $total_bangunan }}</td>
                    <td align="right">Rp. {{ number_format($total_retribusi) }}</td>
                    <td align="right">Rp. {{number_format($total_retribusi) }}</td>
                </tr>

            </tbody>

        </table>
        @include('livewire.admin.laporan.partial.ttd')
    </section>
</body>

</html>
