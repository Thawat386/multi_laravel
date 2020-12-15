@extends('admin.layouts.admin')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-3">
                    <h5>เพิ่มสมาชิก</h5>
                </div>
                <!-- <div class="col-md-9 text-right">
                    <a href="{{ route('userCreate') }}" class="btn btn-primary m-b-10"><i class="fa fa-user-plus">เพิ่มสมาชิกใหม่</i></a>
                </div> -->
            </div>
            <div class="card">
                <div class="card-body">
                            <form action="{{ route('userStore') }}" method="POST">
                       {{csrf_field()}}
                       <div class="row">
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label for="name">ชื่อ</label>
                                   <input type="text" name="name" class="form-control">
                               </div>
                               <div class="form-group">
                                   <label for="email">อีเมล</label>
                                   <input type="email" name="email" class="form-control">
                               </div>
                               <div class="form-group">
                                   <label for="password">รหัสผ่าน</label>
                                   <input type="text" name="password" class="form-control" placeholder="สร้างรหัสผ่าน" v-if="!auto_generate">
                               </div>
                               <div class="form-check">
                                   <label class="form-check-label">
                                       <input type="checkbox" name="auto_generate" class="form-check-input" v-model="auto_generate">
                                       สร้างรหัสผ่านอัตโนมัติ
                                    </label>
                               </div>
                           </div>
                           <div class="col-md-6">
                               <label for="roles">Roles:</label>
                               <input type="hidden" name="roles" :value="rolesSelected">
                               <div class="row">
                                   <div class="col-md-6">
                                       <div class="form-check">
                                           @foreach($roles as $role)
                                                <p>
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="from-check-input" name="rolesSelected" v-model="rolesSelected" value="{{ $role->id }}">
                                                        <em>({{ $role->display_name }})</em>
                                                    </label>
                                                </p>
                                           @endforeach
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <br>
                       <button class="btn btn-success">เพิ่มสมาชิก</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const app = new Vue({
    el: '#app',
    data: {
        auto_generate: true,
        rolesSelected: []
    }
});
    </script>
@endsection