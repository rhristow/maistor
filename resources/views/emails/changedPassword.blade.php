@extends('_layouts/other/email')

@section('headerMessage')
Hello!
@stop

@section('content')
    Your password has been recently changed. <br><br>
    <a href="{{ URL::to('/login') }}" style="display: inline-block; background: #2787D8; border: solid #2787D8; border-width: 10px 20px 8px; font-weight: bold; border-radius: 5px; color: white; text-decoration: none;" target="_blank">
        LOGIN
    </a>
@stop
