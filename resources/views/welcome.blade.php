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
            <!-- Alert -->
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <b>Perhatian!</b>
                <p>Sistem ini sudah mampu mengenali lebih dari satu peserta setiap kali pendaftaran. Harap Anda memeriksa ulang untuk memastikan tidak ada kekeliruan data!</p>

                <!-- Close button -->
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error('fileExcel') is-invalid @enderror" id="fileExcel"
                           name="fileExcel" required>
                    <label class="custom-file-label" for="fileExcel">Pilih file Excel (xls atau xlsx)...</label>
                    <div class="invalid-feedback">{{ $errors->first() }}</div>
                </div>

                <h5 class="pt-4">Filter Data</h5>

                <!-- All participants -->
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="filter-all-participants"
                           name="filter_all_participants" value="All Participants"
                           @if(!empty($filter_all_participants)) checked @endif>
                    <label class="form-check-label" for="filter-all-participants">Tampilkan All Participants</label>
                </div>

                <!-- Bundle Pre-Event and Main Event -->
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="filter-bundle-pre-event-and-main-event"
                           name="filter_bundle_pre_event_and_main_event" value="Bundle Pre-Event and Main Event"
                           @if(!empty($filter_bundle_pre_event_and_main_event)) checked @endif>
                    <label class="form-check-label" for="filter-bundle-pre-event-and-main-event">
                        Tampilkan Bundle Pre-Event and Main Event
                    </label>
                </div>

                <!-- Early Bird Ticket - Symposium + Workshop -->
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="filter-early-bird-ticket-symposium-workshop"
                           name="filter_early_bird_ticket_symposium_workshop"
                           value="Early Bird Ticket - Symposium + Workshop"
                           @if(!empty($filter_early_bird_ticket_symposium_workshop)) checked @endif>
                    <label class="form-check-label" for="filter-early-bird-ticket-symposium-workshop">
                        Tampilkan Early Bird Ticket - Symposium + Workshop
                    </label>
                </div>

                <div class=" d-flex justify-content-end pt-4">
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
            @if(empty($peserta) || sizeof($peserta) == 0)
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
    $('#fileExcel').on('change', function () {
        var filename = $(this).val().replace('C:\\fakepath\\', '');
        $(this).next('.custom-file-label').html(filename);
    });
</script>
</body>
</html>
