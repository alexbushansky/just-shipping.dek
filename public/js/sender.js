function sendMessage(offerId,driverId) {
    var form =$('#sendMessageModal');
    form.find('input[name="driver_id"]').val(driverId);
    form.find('input[name="offer_id"]').val(offerId);
    $('#sendMessageModal').modal('show');
}

$(function () {
    $("#sendMessageForm").on('submit',function (e) {
        e.preventDefault();
        var _self=$(this);
        var data = _self.serialize();
        console.log(data);

        $.ajax({
            url:"/dialogs",
            type:'post',
            data:data,
            success:function (response) {
                if(response.success ==true)
                {
                    _self.find('.success-message').text(response.message);
                    $('#sendMessageModal').modal('hide');
                }
            },
            error:function (error) {
                console.log(error);
                var errors=error.responseJSON.errors;
                var element = _self.find('textarea[name="description"]').addClass('is-invalid');
                element.next().html('<strong>'+errors.description[0]+'</strong>');

            }
        })
    })

});
