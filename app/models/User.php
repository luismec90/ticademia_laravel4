<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    private $is_student = null;

    protected $hidden = array('password', 'remember_token');

    public static $rules = [
        'first_name' => 'required',
        'last_name'  => 'required',
        'birth_date' => 'sometimes|date_format:Y-m-d',
        'gender'     => 'required|in:f,m',
        'email'      => 'required|email|unique:users',
        'password'   => 'required|confirmed|min:4'
    ];

    public static $updateRules = [
        'first_name' => 'required',
        'last_name'  => 'required',
        'birth_date' => 'sometimes|date_format:Y-m-d',
        'gender'     => 'required|in:f,m',
        'avatar'     => 'image|max:2048'
    ];

    public static $updatePasswordRules = [
        'password'     => 'required|confirmed|min:4',
        'old_password' => 'sometimes|required'
    ];

    public static $validationMessages = [
        'first_name.required'    => 'El campo nombres es obligatorio',
        'last_name.required'     => 'El campo apellidos es obligatorio',
        'birth_date.date_format' => 'El campo fecha de nacimiento no corresponde con el formato Y-m-d.',
        'gender.required'        => 'El campo género es obligatorio',
        'gender.in'              => 'El campo género seleccionado es inválido',
        'email.email'            => 'El campo correo electrónico es inválido',
        'email.required'         => 'El campo correo electrónico es obligatorio',
        'email.unique'           => 'El campo correo electrónico ya ha sido tomado',
        'password.required'      => 'El campo contraseña es obligatorio',
        'password.confirmed'     => 'El campo confirmar contraseña no coincide',
        'password.min'           => 'El campo contraseña debe tener al menos 4 caracteres',
    ];

    public function avatarPath()
    {
        return asset('users/avatars/' . $this->avatar);
    }

    public function isStudent($course_id)
    {
        if (is_null($this->is_student))
        {
            $course = $this->courses()->where('course_id', $course_id)->where('role', 1)->get();
            if ($course->count())
            {
                $this->is_student = true;

                return true;
            }
            $this->is_student = false;

            return false;
        } else
        {
            return $this->is_student;
        }

    }

    public function courses()
    {
        return $this->belongsToMany('Course')->withTimestamps();
    }

    public function fullName()
    {
        return "{$this->first_name} {$this->last_name}";
    }

}
