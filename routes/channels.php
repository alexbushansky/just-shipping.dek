<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

use App\Models\Dialog;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('dialog.{dialogId}', function ($user, $dialogId) {

    return (int) $user->id === Dialog::find($dialogId)->user_id || (int) $user->id === Dialog::find($dialogId)->recipient_id;
});




