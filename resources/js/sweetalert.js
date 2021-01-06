$(document).ready(function(){
    $('.deleteForm').click(function(evt){
        var name=$(this).data("name");
        var form=$(this).closest("form");
        evt.preventDefault();
        swal({
            title:'คุณต้องการลบข้อมูลหรือไม่',
            icon:"warning",
            content:
            buttons:true,
            dangerMode:true
        }).then((willDelete)=>{
            if(willDelete){
                form.submit();
            }
        })
    });
});