@extends('_master')

@section('title')
	Join
@stop

@section('content')
<h1>Join Pult!</h1>

@foreach($errors->all() as $message)
	<div class='error'>{{ $message }}</div>
@endforeach

{{ Form::open(array('url' => '/join')) }}
	

	<center><table>
                <tr>
                    <td>{{ Form::label('First Name') }}</td>
                    <td>{{ Form::text('first_name') }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>{{ Form::label('Last Name') }}</td>
                    <td>{{ Form::text('last_name') }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>{{ Form::label('email') }}</td>
                    <td>{{ Form::text('email') }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>{{ Form::label('password') }}<br />
                        
                    </td>
                    <td>{{ Form::password('password') }}<br /></td>
                    <td><small>Min 6 characters</small></td>
                </tr>
            </table></center>
 	
 	<br />

    {{ Form::submit('Submit') }}

{{ Form::close() }}
@stop