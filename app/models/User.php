<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public static $rules = [
        'nombres' => 'required|alpha',
        'apellidos' => 'required|alpha',
        'fecha_nacimiento' => 'required|date_format:Y-m-d',
        'sexo' => 'required|in:f,m',
        'correo' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:4'
    ];
}
