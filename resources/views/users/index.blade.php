@extends('layouts.app')

@section('content')
    <h2 class="border-bottom pb-2">All Users Status</h2>
    @if (session()->has('success'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    @endif
    <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Jenis Kelamin</th>
              <th scope="col">Tanggal Lahir</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->jenis_kelamin }}</td>
              <td>{{ $user->tanggal_lahir }}</td>
              <td>
                <form action="/users/{{ $user->id }}" method="post">
                @method('delete')
                @csrf
                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin Ingin Dihapus?')">Delete</button>
                </form>
              </td>
            </tr>
            @endforeach
            
          </tbody>
        </table>
@endsection