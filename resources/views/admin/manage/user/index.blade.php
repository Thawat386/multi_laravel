@extends('admin.layouts.admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-3">
                <h5>Manage User</h5>
            </div>
            <div class="col-md-9 text-right">
                <a href="{{ route('userCreate') }}" class="btn btn-primary m-b-10"><i class="fa fa-user-plus">เพิ่มสมาชิกใหม่</i></a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อ</th>
                            <th>อีเมล</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at}}</td>
                            <td>
                                <a href="{{ route('userShow', $user->id)}}" class=" btn btn-secondary btn-sm"><i class="fa fa-info"></i></a>
                                <a href="{{ route('userEdit', $user->id)}}" class=" btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('userDestroy', $user->id) }}" class=" btn btn-danger btn-sm" data-id="{{$user->id}}">
                                    @csrf @method('DELETE')
                                    <!-- <input type="submit" value='ลบ' class=" btn btn-danger btn-sm" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่')"> -->
                                    <i class="fa fa-trash"></i></a>
                                <!-- <a @click="userDelete" class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row justify-content-center">
                    {!! $users->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '.button', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    swal({
            title: "Are you sure!",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes!",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "POST",
                url: "{{url('/destroy')}}",
                data: {id:id},
                success: function (data) {
                              //
                    }         
            });
    });
});
    </script>
@endsection
