@extends('admin.layouts.admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-3">
                <h5>แก้ไข Permission</h5>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('permissionUpdate', $permission->id) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row" v-if="permission_type == 'basic' ">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="display_name">Name (Display Name)</label>
                                <input type="text" class="form-control" name="display_name" value="{{$permission->display_name}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Slug</label>
                                <input type="text" class="form-control" name="name" value="{{$permission->name}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" name="description" value="{{$permission->description}}">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">บันทึก</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
