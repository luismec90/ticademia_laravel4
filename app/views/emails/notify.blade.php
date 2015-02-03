@extends('emails.layouts.default')
@section('content')
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="color: rgb(102, 102, 102); font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 15px; font-weight: 300;line-height: 20px;">
                <h2>{{ $quiz->module->course->subject->name }}:</h2>

                <p> Hola <b>{{ $oldUser->first_name }}</b>, <b>{{ $newUser->fullName() }}</b> acaba de
                    obtener un mejor tiempo para el ejercicio {{ $quiz->order }}
                    del <b>{{ $quiz->module->name }}</b>.

                <p>
                    Record anterior: {{ $oldBestTime }} segundos
                </p>

                <p>
                    <b style="color:rgb(67, 142, 185);"> Nuevo record: {{ $newBestTime }} segundos </b>
                </p>

            </td>
        </tr>
    </table>
@stop

