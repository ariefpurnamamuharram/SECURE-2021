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
            <form action="{{ route('import.peserta') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error('fileCSV') is-invalid @enderror" id="fileCSV"
                           name="fileCSV" required>
                    <label class="custom-file-label" for="fileCSV">Pilih file CSV...</label>
                    <div class="invalid-feedback">{{ $errors->first() }}</div>
                </div>

                <div class="d-flex justify-content-end pt-4">
                    <button class="btn btn-success">
                        Impor File
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel peserta -->
    <h2 class="pt-4">Data Peserta</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
            <tr class="font-weight-bold" style="background-color: #e5e5e5;">
                <th>Tanggal Pembelian</th>
                <th>Nama</th>
                <th>Pekerjaan</th>
                <th>Instansi</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Jenis Tiket</th>
                <th>Yang Mendaftarkan</th>
            </tr>
            </thead>
            <tbody>
            @if(empty($peserta))
                <td class="text-center" colspan="8">
                    --- Belum ada data ---
                </td>
            @else
                @foreach($peserta as $data)
                    <tr>
                        <td>{{ $data->nama }}</td>
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
