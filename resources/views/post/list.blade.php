@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        @if (session()->has('success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>title</th>
                                    <th width="30%">Create By</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.modal-delete')
@endsection


@push('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        let userDatatable;
        $(document).ready(function() {
            userDatatable = $('table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('post.list') }}",
                order: [],
                columns: [{
                        data: 'DT_RowIndex',
                        sortable: false,
                        searchable: false
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'created_by'
                    },
                    {
                        data: 'action',
                        sortable: false,
                        searchable: false
                    },
                ],
            });
        });
    </script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
