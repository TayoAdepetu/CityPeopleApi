<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Message;

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

/*
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

*/

Broadcast::channel('chat', function ($user, Message $message) {
    return $user->id === $message->user_id;
});
