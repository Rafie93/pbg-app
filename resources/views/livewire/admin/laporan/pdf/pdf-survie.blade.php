<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Hasil Survie</title>
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
            <center>LAPORAN HASIL SURVIE</center>
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
                    <th>TGL BERANGKAT</th>
                    <th>NAMA PETUGAS</th>
                    <th>ALAMAT BANGUNAN</th>
                    <th>TITIK KOORDINAT</th>
                    <th>BANGUNAN/REKLAME</th>
                    <th>PEMOHON </th>
                    <th>KETERANGAN</th>
                    <th>FOTO SURVIE</th>
                </tr>

            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td align="center">
                            @if ($row->tanggal_berangkat)
                            {{ Carbon\Carbon::parse($row->tanggal_berangkat)->format('d-m-y')}}
                            @endif
                        </td>

                        <td align="left">{{ $row->petugas->name }}</td>
                        @if ($row->jenis=="Reklame")
                            <td>{{ $row->permohonanreklame->alamat.','.$row->permohonanreklame->village() }}</td>
                            <td align="center">{{ $row->latitude }} , {{ $row->longitude }}</td>
                            <td>{{ $row->permohonanreklame->jenis_reklame.','.$row->permohonanreklame->ukuran }}m</td>
                            <td align="left">{{ $row->permohonanreklame->pemohon->nama }}</td>    
         
                        @else 
                            <td>{{ $row->permohonan->alamat.','.$row->permohonan->village() }}</td>
                            <td align="center">{{ $row->latitude }} , {{ $row->longitude }}</td>
                            <td>{{ $row->permohonan->fungsibangunan->nama.','.$row->permohonan->jenisbangunan->nama }}</td>
                            <td align="left">{{ $row->permohonan->pemohon->nama }}</td>    

                        @endif
                        <td align="left">{{ $row->keterangan }}</td>    

                        <td align="center">
                            @if ($row->foto_survie)
                                <img src="{{ asset('storage/' . $row->foto_survie) }}" alt="foto" width="100px">
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('livewire.admin.laporan.partial.ttd')
    </section>
</body>

</html>
