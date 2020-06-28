@extends('layouts')

@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ url('/css/profile.css') }}">
@endpush

@section('title', 'Profile')

@section('content')


@foreach($student as $s)
<div class="sidenav">
  <a href="/">Home</a>
  <div class="active"><a href="/student/profile">My profile</a></div>
  <a href="/students/{{ $s->id }}">My subjects</a>
  <a href="/register_exam">Register exam</a>
  <a href="/exams_history">Exams history</a>
</div>


<div class="content">
  <img class="profile_image" src="/students_images/{{ $s->picture }}">
  <h2> {{ $s->name . " " . $s->surname }} </h2>

  <table>
  <tr>
    <th>Identification number:</th>
    <td> {{ $s->identification_number }} </td>
  </tr>
  <tr>
    <th>Index number:</th>
    <td> {{ $s->index_number }} </td>
  </tr>
  <tr>
    <th>Address:</th>
    <td> {{ $s->address }} </td>
  </tr>
  <tr>
    <th>Phone number:</th>
    <td> {{ $s->phone_number }} </td>
  </tr>
  <tr>
    <th>Email:</th>
    <td> {{ $s->email }} </td>
  </tr>
  <tr>
    <th>Account balance:</th>
    <td> {{ $s->account_balance }} din</td>
  </tr> 
</table>

@if(Auth::check() && auth()->user()->email == $s->email)
<button onclick="window.location.href='/user/edit_password'" type="button">Update password</button>
@endif

</div>
@endforeach


@stop