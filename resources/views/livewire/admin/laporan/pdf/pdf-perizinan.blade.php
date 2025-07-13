@inject('query', 'App\Models\QueryRekap')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN PERIZINAN</title>
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
            <center>LAPORAN PERIZINAN</center>
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
                    <th>TOTAL BANGUNAN</th>
                    <th>TOTAL REKLAME</th>
                    <th>BERIZIN</th>
                    <th>BELUM BERIZIN</th>
                    <th>DIPROSES</th>
                    <th>DITOLAK</th>
                </tr>

            </thead>
            <tbody>
                @php
                    $no = 1;
                    $total_bangunan = 0;
                    $total_reklame=0;
                    $total_berizin = 0;
                    $total_belum_berizin = 0;
                    $total_diproses = 0;
                    $total_ditolak = 0;

                @endphp
                @foreach ($data as $row)
                    @php
                        // $queryTotal = $query->total_bangunan($row->id);
                        $queryBerizin = $query->total_berizin($row['id']);
                        $belum_berizin =  $row['total']  - $queryBerizin;
                        $diproses = $query->total_diproses($row['id']);
                        $ditolak = $query->total_ditolak($row['id']);
                    @endphp
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td >{{ $row['kelurahan']}}</td>
                        <td align="center">{{ $row['total_bangunan'] }} </td>
                        <td align="center">{{ $row['total_reklame'] }} </td>
                        <td align="center">{{ $queryBerizin }} </td>
                        <td align="center">{{ $belum_berizin }} </td>
                        <td align="center">{{ $diproses }} </td>
                        <td align="center">{{ $ditolak }} </td>
                    </tr>
                    @php
                        $total_bangunan += $row['total_bangunan'];
                        $total_reklame += $row['total_reklame'];
                        $total_berizin += $queryBerizin;
                        $total_belum_berizin += $belum_berizin;
                        $total_diproses += $diproses;
                        $total_ditolak += $ditolak;
                    @endphp
                @endforeach
                <tr>
                    <td colspan="2" align="center">TOTAL</td>
                    <td align="center">{{ $total_bangunan }}</td>
                    <td align="center">{{ $total_reklame }}</td>
                    <td align="center">{{ $total_berizin }}</td>
                    <td align="center">{{ $total_belum_berizin }}</td>
                    <td align="center">{{ $total_diproses }}</td>
                    <td align="center">{{ $total_ditolak }}</td>
                    
                </tr>

            </tbody>

        </table>
        @include('livewire.admin.laporan.partial.ttd')
    </section>
</body>

</html>
