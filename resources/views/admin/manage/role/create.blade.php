@extends('admin.layouts.admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-3">
                <h5>สร้าง Roles</h5>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('roleStore') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="display_name">Name (Display Name)</label>
                                <input type="text" class="form-control" name="display_name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Slug</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" name="description">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="permissions" :value="permissionsSelected">
                    <div class="card">
                        <div class="card-body">
                            <h2>Permission:</h2>
                            <div class="form-check">
                                <div class="row">
                                    @foreach ($permissions as $permission)
                                    <div class="col-md-3">

                                        <label class="form-check-label">

                                            <input type="checkbox" value="form-check-input" name="permissionsSelected" v-model="permissionsSelected"
                                             value="{{$permission->id}}"><em>({{$permission->display_name}})</em>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">
                        สร้าง Role
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var app = new Vue({
        
        data: {
            permissionsSelected: []
        }
    });
</script>

@endsection