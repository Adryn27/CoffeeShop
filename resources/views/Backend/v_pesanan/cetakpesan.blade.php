<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $judul }}</title>

    <style>
        .header {
            text-align: center;
            padding: 20px;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
            font-weight: bold;
        }

        .header p {
            margin: 5px 0;
            font-size: 14px;
        }

        .header .logo {
            max-width: 100px;
            margin-bottom: 15px;
        }
        .header .date {
            font-size: 14px;
            color: #555;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="row justify-content-center">
            <div class="col-md-2">
                <img src="{{ public_path('Template/logo/logo64.png') }}" class="logo">
            </div>
            <div class="col-md-8">
                <h1>{{ $judul }}</h1>
                <p class="date">Tanggal: {{ $tanggalAwal }} s.d {{ $tanggalAkhir }}</p>
            </div>
        </div>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>No Pesanan</th>
                <th>Pelanggan</th>
                <th>Waktu Order</th>
                <th>Detail Pesanan</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cetak as $row)
              <tr>
                <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->pelanggan }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>
                        <ul>
                            @foreach ($row->detailPesanan as $detail)
                                <li>
                                    <img src="{{ public_path('storage/img-menu/' . $detail->menu->foto) }}" width="50px">
                                    <span>{{ $detail->menu->nama_menu }} - {{ $detail->qty }}</span>
                                </li>
                                <p></p>
                            @endforeach
                        </ul>
                    </td>
              </tr>
            @endforeach
          </tbody>
    </table>
</body>
</html>


