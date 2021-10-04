<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SECURE 2021</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <!-- Custom style -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
<div class="p-4">
    <!-- Impor data peserta -->
    <div class="card">
        <div class="card-header">
            SECURE 2021 - Impor Data Peserta Main Event
        </div>

        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error('fileCSV') is-invalid @enderror" id="fileCSV"
                           name="fileCSV" required>
                    <label class="custom-file-label" for="fileCSV">Pilih file CSV...</label>
                    <div class="invalid-feedback">{{ $errors->first() }}</div>
                </div>

                <div class="d-flex justify-content-end pt-4">
                    <button class="btn btn-success mx-1" formaction="{{ route('export.peserta.to.google.contact') }}">
                        Ekspor ke Google Contact (.csv)
                    </button>

                    <button class="btn btn-success mx-1" formaction="{{ route('export.peserta.to.excel') }}">
                        Ekspor ke Excel (.xlsx)
                    </button>

                    <button class="btn btn-success mx-1" formaction="{{ route('import.peserta') }}">
                        Lihat Data Peserta
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel peserta -->
    <h2 class="pt-4">Data Peserta</h2>
    <span>Jumlah peserta: @if(!empty($peserta)) {{ count($peserta) }} @else - @endif orang</span>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
            <tr class="font-weight-bold" style="background-color: #e5e5e5;">
                <th class="align-middle">No.</th>
                <th class="align-middle">Tanggal Pembelian</th>
                <th class="align-middle">Jam Pembelian</th>
                <th class="align-middle">Nama</th>
                <th class="align-middle">Pekerjaan</th>
                <th class="align-middle">Instansi</th>
                <th class="align-middle">Email</th>
                <th class="align-middle">Nomor Telepon</th>
                <th class="align-middle">Deskripsi Tiket</th>
                <th class="align-middle">Yang Mendaftarkan</th>
            </tr>
            </thead>
            <tbody>
            @if(empty($peserta))
                <td class="text-center" colspan="10">
                    --- Belum ada data ---
                </td>
            @else
                @foreach($peserta as $key => $data)
                    <tr>
                        <td class="text-nowrap">{{ $loop->index + 1 }}</td>
                        <td class="text-nowrap">{{ $data->tanggal_pembelian }}</td>
                        <td class="text-nowrap">{{ $data->jam_pembelian }}</td>
                        <td class="text-nowrap">{{ $data->nama }}</td>
                        <td class="text-nowrap">{{ $data->pekerjaan }}</td>
                        <td class="text-nowrap">{{ $data->instansi }}</td>
                        <td class="text-nowrap">
                            <a href="mailto:{{ $data->email }}" target="_blank">{{ $data->email }}</a>
                        </td>
                        <td class="text-nowrap">
                            <a href="tel:{{ $data->nomor_telepon }}" target="_blank">{{ $data->nomor_telepon }}</a>
                        </td>
                        <td class="text-nowrap">{{ $data->deskripsi_tiket }}</td>
                        <td class="text-nowrap">
                            @if(!empty($data->yang_mendaftarkan)) {{ $data->yang_mendaftarkan }} @else - @endif
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $('#fileCSV').on('change', function () {
        var filename = $(this).val().replace('C:\\fakepath\\', '');
        $(this).next('.custom-file-label').html(filename);
    });
</script>
</body>
</html>
