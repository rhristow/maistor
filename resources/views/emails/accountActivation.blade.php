@extends('_layouts/other/email')

@section('headerMessage')
    Hello!
@stop

@section('content')
    Thank you for your registration! <br>
	To activate your account, please, click the button down below. <br><br>
    <a href="{{ URL::to('/activate').'/'.$uuid.'/'.$activationKey }}" style="display: inline-block; background: #2787D8; border: solid #2787D8; border-width: 10px 20px 8px; font-weight: bold; border-radius: 5px; color: white; text-decoration: none;" target="_blank">
        ACTIVATE ACCOUNT
    </a>
@stop
