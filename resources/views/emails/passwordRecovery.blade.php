@extends('_layouts/other/email')

@section('headerMessage')
    Hello!
@stop

@section('content')
    We received a forgotten password request. <br>
	In order to create a new password, you must click the button down below. <br><br>
    <a href="{{ URL::to('/forgotten-password').'/'.$uuid.'/'.$forgottenPasswordKey }}" style="display: inline-block; background: #2787D8; border: solid #2787D8; border-width: 10px 20px 8px; font-weight: bold; border-radius: 5px; color: white; text-decoration: none;" target="_blank">
        NEW PASSWORD
    </a>
@stop
