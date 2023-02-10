@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>

        $(document).ready(function () {
            $('table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.list') }}",
                order: [],
                columns: [
                    { data: 'DT_RowIndex', sortable: true, searchable: false },
                    { data: 'name' },
                    { data: 'jenis_kelamin' },
                    { data: 'tanggal_lahir' },
                    { data: 'action', sortable: false,},
                ],
            });
        });

    </script>
@endpush