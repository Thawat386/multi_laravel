@extends('admin.layouts.admin')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-3">
                    <h5>แก้ไขข้อมูลสมาชิก</h5>
                </div>
                <!-- <div class="col-md-9 text-right">
                    <a href="{{ route('userCreate') }}" class="btn btn-primary m-b-10"><i class="fa fa-user-plus">เพิ่มสมาชิกใหม่</i></a>
                </div> -->
            </div>
            <div class="card">
                <div class="card-body">
                            <form action="{{ route('userUpdate', $user->id) }}" method="POST">
                       {{csrf_field()}}
                       <div class="row">
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label for="name">ชื่อ</label>
                                   <input type="text" value="{{ $user->name }}" name="name" class="form-control">
                               </div>
                               <div class="form-group">
                                   <label for="email">อีเมล</label>
                                   <input type="email" value="{{ $user->email }}" name="email" class="form-control">
                               </div>
                               <div class="form-group">
                                   <label for="password">รหัสผ่าน</label>
                                   <input type="text" name="password" class="form-control" placeholder="สร้างรหัสผ่าน" v-if="!donotchange">
                               </div>
                               <div class="form-check">
                                   <label class="form-check-label">
                                       <input type="checkbox" name="donotchange" class="form-check-input" v-model="donotchange">
                                       ไม่สามารถเปลี่ยนรหัสผ่านได้
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
                       <button class="btn btn-success">บันทึกการแก้ไข</button>
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
        donotchange: true,
        rolesSelected: {!! $user->roles->pluck('id') !!}
    }
});
    </script>
@endsection