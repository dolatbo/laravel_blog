@extends('emails.devs')
@section('content')
<center>
    <h1 style="padding: 23px; background: #b3deb8a1; border-bottom: 6px green solid;">Novo Dev</h1>
    <p> Nome: {{$dev['nome']}} </p>
    <p> git: {{$dev['github_username']}} </p>

    @include('emails.parts.footer')
</center>
@endsection