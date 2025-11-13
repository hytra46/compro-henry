@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>{{ $title ?? '' }}</h5>
        </div>
        <div class="card-body">
            <div align="right" class="mb-3">
                <a href="{{ route('user.create') }}" class="btn btn-primary">Create User</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>
                            <div class="d-flex gap-2">
                            <a href="{{ route('user.edit', $data->id) }}" class="btn btn-sm btn-success btn-icon">
                                <span class="tf-icons bx bx-pencil bx-22px"></span>
                            </a>
                            <form action="{{ route('user.destroy', $data->id) }}" method="post">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm btn-icon" onclick="return confirm('Are you sure??')">
                                    <span class="tf-icons bx bx-trash bx-22px"></span>
                                </button>
                            </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
