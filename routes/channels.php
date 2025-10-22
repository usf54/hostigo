<?php
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('admin.dashboard', function (User $user) {
    // Check if user has admin role
    return $user->role === 'admin';
});