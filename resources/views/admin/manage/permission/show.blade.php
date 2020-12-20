@extends('admin.layouts.admin')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-3">
                    <h5>ข้อมูล Permission</h5>
                </div>
                <div class="col-md-9 text-right">
                    <a href="{{ route('permissionEdit', $permission->id) }}" class="btn btn-primary m-b-10"><i class="fa fa--plus">แก้ไข Permission</i></a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-auto">
                            <pre><label>Name (Display Name):</label> {{ $permission->display_name }} </pre>
                        </div>
                        <div class="col-md-auto">
                            <pre><label>Slug:</label> {{ $permission->name }} </pre>
                        </div>
                        <div class="col-md-auto">
                            <pre><label>Description:</label> {{ $permission->description }} </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection