
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function showMessages(dialogId,user) {
    window.Echo.private('dialog.'+dialogId)
        .listen('DialogMessage', (data) => {

            console.log(data);
        });

}

function addMessage (text)
{
        let add = "<div class='media-body'> <div class='bg-info rounded py-2 px-3 mb-2'><p class='small text-muted'>"+text+"</p> </div></div>";
}










