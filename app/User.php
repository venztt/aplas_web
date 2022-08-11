<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Redirect;


class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'roleid',
        'email',
        'password',
        'uplink',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function checkRoleId($roleid): RedirectResponse
    {
        if ($roleid == 'student') {
            return Redirect::to('student/home');
        } elseif ($roleid == 'teacher') {
            return Redirect::to('teacher/home');
        } elseif ($roleid == 'admin') {
            return Redirect::to('admin/admin');
        } else {
            return Redirect::to('/home');
        }
    }
}
