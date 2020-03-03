$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $("#sendMessageForm").on('submit',function (e) {
        e.preventDefault();
        var _self=$(this);
        var data = _self.serialize();
        console.log(data);

        $.ajax({
            url:'/driver-offers/send-message',
            type:'post',
            success:function (response) {
                console.log(response);
            },
            error:function (error) {
                console.log(error);
            }
        })
    })

});


