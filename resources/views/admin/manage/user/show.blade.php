@extends('admin.layouts.admin')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-3">
                    <h5>ข้อมูลสมาชิก</h5>
                </div>
                <!-- <div class="col-md-9 text-right">
                    <a href="{{ route('userCreate') }}" class="btn btn-primary m-b-10"><i class="fa fa-user-plus">เพิ่มสมาชิกใหม่</i></a>
                </div> -->
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">ชื่อ</label>
                            <pre>{{ $user->name }}</pre>
                        </div>
                        <div class="col-md-6">
                            <label for="name">อีเมล</label>
                            <pre>{{ $user->email }}</pre>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="roles">Roles:</label>
                            @if($user->roles->count() > 0)
                            <div class="row">
                                @foreach($user->roles as $role)
                                    <div class="col-md-3">
                                        <pre>{{ $role->display_name }}</pre>
                                    </div>
                                @endforeach
                            </div>
                            @else
                                <p>สมาชิกยังไม่ถูกเพิ่มสถานะ</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection