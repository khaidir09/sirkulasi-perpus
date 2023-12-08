<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title>Laporan Jumlah Buku Dikembalikan Perpustakaan SMK Negeri 1 Amuntai</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <table class="table table-borderless">
        <colgroup>
            <col style="width: 10%">
            <col style="width: 75%">
            <col style="width: 10%">
        </colgroup>
        <tr>
            <td>
                <img src="images/logo_provinsi.png" alt="">
            </td>
            <td class="text-center" style="padding-right : 100px;">
                <h6>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h6>
                <h6>DINAS PENDIDIKAN DAN KEBUDAYAAN</h6>
                <h5>SMK NEGERI 1 AMUNTAI</h5>
                <p class="text-secondary">Jl. Negara Dipa No. 346 Kabupaten Hulu Sungai Utara <br> Telp/Fax (0527) 61440 | Email smkn1amuntai@gmail.com | Web https://smkn1amuntai.sch.id </p>
            </td>
            <td>
                <img src="images/logo_sekolah.png" alt="">
            </td>
        </tr>
    </table>

    <hr>
    
    <div class="text-center py-3">
        <h5 class="text-uppercase">Laporan Buku Perpustakaan SMKN 1 Amuntai yang Dikembalikan <br> Periode Bulan {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('F Y') }} </h5>
    </div>

    <table class="table table-bordered text-center" style="font-size: 12px;">
        <thead class="thead-dark">
            <tr>
            <th scope="col">No.</th>
            <th scope="col">Klasifikasi</th>
            <th scope="col">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1
            @endphp
			@foreach($summary as $item)
			<tr>
                <td>{{$i++}}</td>
                <td>{{ $item['klasifikasi'] }}</td>
                <td>{{ $item['total_peminjaman'] }}</td>
                {{-- <td>{{$item->jumlah}}</td> --}}
			</tr>
			@endforeach
        </tbody>
    </table>

</body>
</html>