@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
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
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Pin</th>
                                    <th>title</th>
                                    <th>slug</th>
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
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
    <script>
        let userDatatable;
        $(document).ready(function() {
            userDatatable = $('table').DataTable({
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'<'table-responsive'tr>>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
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
                        data: 'is_pinned',
                        sortable: false,
                        searchable: false
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'slug'
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
        const successMessage = "{{ session()->get('success') }}";
        if (successMessage) {
            toastr.success(successMessage);
        }
    </script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
