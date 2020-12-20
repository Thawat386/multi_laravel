@extends('admin.layouts.admin')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-3">
                    <h5>Manage Permissions</h5>
                </div>
                <div class="col-md-9 text-right">
                    <a href="{{ route('permissionCreate') }}" class="btn btn-primary m-b-10"><i class="fa fa--plus">เพิ่ม Permission</i></a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ชื่อ</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $permission->display_name }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->description}}</td>
                                    <td>
                                        <a href="{{ route('permissionShow', $permission->id) }}" class=" btn btn-secondary btn-sm"><i class="fa fa-info"></i></a>
                                        <a href="{{ route('permissionEdit', $permission->id) }}" class=" btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                        <!-- <a href="" class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row-justify-content-center">
                        {!! $permissions->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection