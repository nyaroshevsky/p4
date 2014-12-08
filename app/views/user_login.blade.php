@extends('_master')

@section('title')
	Log in
@stop

@section('content')

<h1>Log in</h1>

{{ Form::open(array('url' => '/login')) }}

    <center><table>
                <tr>
                    <td>{{ Form::label('email') }}</td>
                    <td>{{ Form::text('email','sam@gmail.com') }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>{{ Form::label('password') }} (sam1234)</td>
                    <td>{{ Form::password('password') }}</td>
                    <td></td>
                </tr>
                
            </table></center>

            {{ Form::submit('Submit') }}

{{ Form::close() }}

@stop