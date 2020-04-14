$('#chatForm').submit(function () {
    let data = $(this).serialize();
    sendMessage(data);
    return false;
});


function sendMessage(data) {


    $.ajax({
        url:"/user-panel/dialog-messages",
        type:"POST",
        dataType: 'JSON',
        data:data,
        success:function (data) {
            if(data.response == true) {
                $("#message_text").val("");
            }

        },
        error:function () {

        }
    });

}

function showMessages(dialogId,user) {


    window.Echo.private('dialog.'+dialogId)
        .listen('DialogMessage', (data) => {

            if(user.id == data.message.user_id)
            {
                addMessageSender(data.message.message_text,data.message.created_at,data.message.user);
            }else
            {
                addMessageReceiver(data.message.message_text,data.message.created_at,data.message.user);
            }
            $(".my-container").animate({scrollTop: ($(".my-container").prop('scrollHeight'))}, 1500);
        });

}

function addMessageSender (text, created)
{
    created = moment(created);
    let add = "<div class='media w-50 ml-auto mb-3'><div class='media-body'> <div class='bg-info rounded py-2 px-3 mb-2'><p class='small mb-0 text-white'>"+text+"</p> " +
        "</div><p class='small text-muted'>"+created.format('Y-MM-DD | H:mm')+"</p></div></div></div>";
    $('.my-container').append(add)
}


function addMessageReceiver (text,created,user)
{
    created = moment(created);
    let add = "<div class='media w-50 mb-3'><img src='http://"+window.location.hostname+"/uploads/thumbnails/"+user.thumbnail+"' class='rounded-circle img-fluid dialog-img'>" +
        "<div class='media-body ml-3'> <div class='bg-light rounded py-2 px-3 mb-2'><p class='small mb-0 text-muted'>"+text+"" +
        "</p> <p class='small text-muted'><strong>"+user.name+"</strong></p></div><p class='small text-muted'>"+created.format('Y-MM-DD | H:mm')+"</p></div></div>";
    $('.my-container').append(add)

}

