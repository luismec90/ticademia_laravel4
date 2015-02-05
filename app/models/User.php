<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;


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
        'gender'     => 'required|in:f,m'
    ];

    public static $updateAvatar = [
        'avatar'     => 'required|image|max:2048',
        'dataX'      => 'required|numeric',
        'dataY'      => 'required|numeric',
        'dataHeight' => 'required|numeric',
        'dataWidth'  => 'required|numeric',
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
        'avatar.required'        => 'El campo imagen es obligatorio',
        'avatar.image'           => 'El campo imagen debe ser una imagen válida',
    ];

    public function avatarPath()
    {
        return asset('users/avatars/' . $this->avatar);
    }

    public function isStudent($courseID)
    {
        if (is_null($this->role) || $this->course_id != $courseID)
            $this->setRol($courseID);

        return $this->role == 1;
    }

    public function isMonitor($courseID)
    {
        if (is_null($this->role) || $this->course_id != $courseID)
            $this->setRol($courseID);

        return $this->role == 2;

    }

    public function isTeacher($courseID)
    {
        if (is_null($this->role) || $this->course_id != $courseID)
            $this->setRol($courseID);

        return $this->role == 3;

    }

    public function setRol($courseID)
    {
        $course = $this->courses()->find($courseID);
        if (is_null($course))
        {
            $this->role = 0;
        } else
        {
            $this->role = $course->role;
        }
        $this->course_id = $courseID;
    }

    public function courses()
    {
        return $this->belongsToMany('Course')->withTimestamps()->withPivot(['level_id', 'role', 'contact_information', 'group']);
    }

    public function fullName()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function linkFullName()
    {
        return "<a class='link info-user' data-user-id='{$this->id}'>{$this->first_name} {$this->last_name}</a>";
    }

    public function socialNetworks()
    {
        return $this->hasMany('SocialNetwork');
    }

    public function notifications()
    {
        return $this->hasMany('Notification')->orderBy('created_at', 'desc');
    }

    public function unviewedNotifications()
    {
        return $this->hasMany('Notification')->where('viewed', 0)->orderBy('created_at', 'desc');
    }

    public function modalNotifications()
    {
        return $this->hasMany('Notification')->where('show_modal', 1)->orderBy('created_at', 'desc');
    }

    public function unviewedModalNotifications()
    {
        return $this->hasMany('Notification')->where('viewed', 0)->where('show_modal', 1)->orderBy('created_at', 'desc');
    }

    public function isMe()
    {
        if (Auth::check() && Auth::user()->id == $this->id)
            return true;

        return false;
    }

    public function modules()
    {
        return $this->belongsToMany('Module')->withTimestamps()->withPivot(['score']);
    }

    public function roleName($courseID)
    {
        if ($this->id == 1)
            return "(Administrador)";
        else if ($this->isMonitor($courseID))
            return "(Monitor)";

    }
}
