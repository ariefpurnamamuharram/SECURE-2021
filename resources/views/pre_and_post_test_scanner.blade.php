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
            SECURE 2021 - Impor Data Pretest dan Post Test Peserta
        </div>

        <div class="card-body">
            <!-- Alert -->
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <b>Perhatian!</b>
                <p>Pastikan kolom nama dan email terisi baik pada pre-test maupun post test! Selain itu, pastikan untuk memasukkan file sesuai yang diminta oleh sistem!</p>

                <!-- Close button -->
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" enctype="multipart/form-data">
            @csrf

                <!-- File Excel pretest -->
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error('fileExcelPreTest') is-invalid @enderror"
                           id="fileExcelPreTest"
                           name="fileExcelPreTest" required>
                    <label class="custom-file-label" for="fileExcelPreTest">Pilih file Excel Pre Test (xls atau xlsx)...</label>
                    <div class="invalid-feedback">{{ $errors->first() }}</div>
                </div>

                <!-- File Excel post test -->
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error('fileExcelPostTest') is-invalid @enderror"
                           id="fileExcelPostTest"
                           name="fileExcelPostTest" required>
                    <label class="custom-file-label" for="fileExcelPostTest">Pilih file Excel Post Test (xls atau xlsx)...</label>
                    <div class="invalid-feedback">{{ $errors->first() }}</div>
                </div>

                <div class=" d-flex justify-content-end pt-4">
                    <button class="btn btn-success mx-1" formaction="{{ route('tes.peserta.scan') }}">
                        Lihat Data Tes Peserta
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel tes peserta -->
    <h2 class="pt-4">Data Tes Peserta</h2>
    <span>Jumlah peserta: @if(!empty($peserta)) {{ count($peserta) }} @else - @endif orang</span>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
            <tr class="font-weight-bold" style="background-color: #e5e5e5;">
                <th class="align-middle">No.</th>
                <th class="align-middle">Nama</th>
                <th class="align-middle">Email</th>
                <th class="align-middle">Pre Test</th>
                <th class="align-middle">Post Test</th>
            </tr>
            </thead>
            <tbody>
            @if(empty($peserta) || sizeof($peserta) == 0)
                <td class="text-center" colspan="5">
                    --- Belum ada data ---
                </td>
            @else
                @foreach($peserta as $key => $data)
                    <tr>
                        <td class="text-nowrap">{{ $loop->index + 1 }}</td>
                        <td class="text-nowrap">{{ $data->nama }}</td>
                        <td class="text-nowrap">{{ $data->email }}</td>
                        <td class="text-nowrap @if($data->pre_test == true) bg-success @else bg-danger @endif"></td>
                        <td class="text-nowrap @if($data->post_test == true) bg-success @else bg-danger @endif"></td>
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
    $('#fileExcelPreTest').on('change', function () {
        var filename = $(this).val().replace('C:\\fakepath\\', '');
        $(this).next('.custom-file-label').html(filename);
    });

    $('#fileExcelPostTest').on('change', function () {
        var filename = $(this).val().replace('C:\\fakepath\\', '');
        $(this).next('.custom-file-label').html(filename);
    });
</script>
</body>
</html>
