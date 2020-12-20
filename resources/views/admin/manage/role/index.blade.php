@extends('admin.layouts.admin')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-3">
                    <h5>Manage Roles</h5>
                </div>
                <div class="col-md-9 text-right">
                    <a href="{{ route('roleCreate') }}" class="btn btn-primary m-b-10"><i class="fa fa-user-plus">เพิ่ม Role</i></a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ชื่อ</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->created_at}}</td>
                                    <td>
                                        <a href="{{ route('roleShow', $role->id) }}" class=" btn btn-secondary btn-sm"><i class="fa fa-info"></i></a>
                                        <a href="{{ route('roleEdit', $role->id) }}" class=" btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                        <!-- <a href="" class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection