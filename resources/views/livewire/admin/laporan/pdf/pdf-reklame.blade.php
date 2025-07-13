<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengajuan Reklame</title>
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
            <center>LAPORAN PENGAJUAN REKLAME</center>
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
                    <th>NOMOR</th>
                    <th>NAMA PEMOHON</th>
                    <th>TANGGAL</th>
                    <th>JENIS REKLAME</th>
                    <th>TEKS REKLAME</th>
                    <th>DURASI </th>
                    <th>UKURAN (m)</th>
                    <th>JUMLAH</th>
                    <th>ALAMAT</th>
                    <th>STATUS</th>

                </tr>

            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->nomor }}</td>
                        <td>{{ $row->pemohon->nama }}</td>
                      
                        <td align="center">{{ Carbon\Carbon::parse($row->tanggal_permohonan)->format('d-m-y')}}</td>
                        <td>{{ $row->jenis_reklame }}</td>
                        <td>{{ $row->teks_reklame }}</td>
                        <td align="center">{{ $row->durasi_pemanfaatan }}</td>
                        <td align="center">{{ $row->ukuran }}</td>
                        <td align="center">{{ $row->jumlah_reklame }}</td>
                        <td>{{ $row->alamat.','.$row->village() }}</td>
                        <td align="center">{{ $row->status_permohonan }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('livewire.admin.laporan.partial.ttd')
    </section>
</body>

</html>
