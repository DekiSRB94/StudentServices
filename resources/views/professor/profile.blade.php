@extends('layouts')

@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ url('/css/profile.css') }}">
@endpush

@section('title', 'Profile')

@section('content')


@foreach($professor as $p)
<div class="sidenav">
  <a href="/professors">Home</a>
  <div class="active"><a href="/professor/profile">My profile</a></div>
  <a href="/professors/{{ $p->id }}">My subjects</a>
</div>


<div class="content">
  <img class="profile_image" src="/professors_images/{{ $p->picture }}">
  <h2> {{ $p->name . " " . $p->surname }} </h2>

  <table>
  <tr>
    <th>Identification number:</th>
    <td> {{ $p->identification_number }} </td>
  </tr>
  <tr>
    <th>Address:</th>
    <td> {{ $p->address }} </td>
  </tr>
  <tr>
    <th>Phone number:</th>
    <td> {{ $p->phone_number }} </td>
  </tr>
  <tr>
    <th>Email:</th>
    <td> {{ $p->email }} </td>
  </tr>
</table>

@if(Auth::check() && auth()->user()->email == $p->email)
<button onclick="window.location.href='/professor/edit_password'" type="button">Update password</button>
@endif

</div>
@endforeach


@stop