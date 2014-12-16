@extends('emails.layouts.default')
@section('content')
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td style="color: rgb(102, 102, 102); font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 15px; font-weight: 300;line-height: 20px;">
            <h2>Restablecer Contraseña</h2>

            <p> Para reestablecer su contraseña por favor de click en el siguiente enlace:</p>
            <p style="text-align: center;">  <a href="{{ URL::to('password/reset', array($token)) }}" style="display: inline-block; margin-bottom: 0; font-weight: 400; text-align: center; vertical-align: middle; cursor: pointer; background-image: none; border: 1px solid transparent; white-space: nowrap; padding: 6px 12px; font-size: 14px; line-height: 1.42857143; border-radius: 4px; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; color: #fff; background-color: #7daa50; border-color: #7daa50; text-decoration: none; font-size:16px">Restablecer</a></p>
            <p style="color: rgb(120, 120, 120);">* Este enlace expira en {{ Config::get('auth.reminder.expire', 60) }} minutos.</p>
        </td>
    </tr>
</table>
@stop