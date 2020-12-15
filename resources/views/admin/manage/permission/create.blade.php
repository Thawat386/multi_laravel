@extends('admin.layouts.admin')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-3">
                    <h5>สร้าง Permissions</h5>
                </div>
                <!-- <div class="col-md-9 text-right">
                    <a href="{{ route('permissionCreate') }}" class="btn btn-primary m-b-10"><i class="fa fa--plus">เพิ่ม Permission</i></a>
                </div> -->
            </div>
            <div class="card">
                <div class="card-body">
                   <form action="{{ route('permissionStore') }}" method="POST">
                       {{ csrf_field() }}
                       <div class="row">
                           <div class="col-md-6">
                               <div class="form-check-inline">
                                   <label class="form-check-label">
                                       <input type="radio" class="form-check-input" name="permission_type" v-model="permission_type" 
                                       value="basic">Basic Permission
                                   </label>
                               </div>
                               <div class="form-check-inline">
                                   <label class="form-check-label">
                                       <input type="radio" class="form-check-input" name="permission_type" v-model="permission_type" 
                                       value="crud">CRUD Permission
                                   </label>
                               </div>
                           </div> 
                        </div> 
                        <div class="row" v-if="permission_type == 'basic' ">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="display_name">Name (Display Nmae)</label>
                                    <input type="text" class="form-control" name="display_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Slug</label>
                                    <input type="text" class="form-control" name="slug">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" name="description">
                                </div>
                            </div>
                        </div> 

                        <div class="row"  v-if="permission_type == 'crud'">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="resource">Resource</label>
                                            <input type="text" class="form-control" name="resource" v-model="resource">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <label class="form-check-label" >
                                                <input type="checkbox" class="form-check-input" name="crudSelected" v-model="crudSelected" 
                                                value="create">สร้าง
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label" >
                                                <input type="checkbox" class="form-check-input" name="crudSelected" v-model="crudSelected" 
                                                value="read">แสดง
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label" >
                                                <input type="checkbox" class="form-check-input" name="crudSelected" v-model="crudSelected" 
                                                value="update">อัพเดท
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label" >
                                                <input type="checkbox" class="form-check-input" name="crudSelected" v-model="crudSelected" 
                                                value="delete">ลบ
                                            </label>
                                        </div>
                                        <input type="hidden" name="crud_selected" :value="crudSelected">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" v-if="resource.length >= 3 && crudSelected.length > 0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in crudSelected" :key="index">
                                            <td v-text="crudName(item)" ></td>
                                            <td v-text="crudSlug(item)"></td>
                                            <td v-text="crudDescription(item)"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button class="btn btn-primary">
                            สร้าง permission
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
            el: '#app',
            data: {
                permission_type: 'basic',
                crudSelected: ['create', 'read', 'update', 'delete'],
                resource: ''
            },
            methods: {
                crudName(item){

                    return item.substr(0,1).toUpperCase() + item.substr(1) + " " + this.resource.substr(0,1).toUpperCase() + this.resource.substr(1)
                },
                crudSlug(item){

                    return item.toLowerCase() + "-" + this.resource.toLowerCase()
                },
                crudDescription(item){

                    return "Allow a user to " + item.toUpperCase() + " " + this.resource.substr(0,1).toUpperCase() + this.resource.substr(1)
                }
            }
        });
    </script>
@endsection