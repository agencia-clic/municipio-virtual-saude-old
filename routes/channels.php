<?php

use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('emergency-services.{IdServiceUnits}', function ($user, $IdServiceUnits){
    return ['id' => $user->id, 'IdServiceUnits' => $IdServiceUnits];
});

Broadcast::channel('medical-care.{IdServiceUnits}', function ($user, $IdServiceUnits){
    return $user;
});

Broadcast::channel('screenings.{IdServiceUnits}', function ($user, $IdServiceUnits){
    return (int) $user->units_current()->IdServiceUnits === (int) $IdServiceUnits;
});

Broadcast::channel('call.{IdServiceUnits}', function ($user, $IdServiceUnits){
    return (int) $user->units_current()->IdServiceUnits === (int) $IdServiceUnits;
});

Broadcast::channel('users-online.{IdServiceUnits}', function ($user, $IdServiceUnits){
    return $user;
});