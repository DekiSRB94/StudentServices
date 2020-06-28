@extends('layouts')

@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ url('/css/exams_history.css') }}">
@endpush

@section('title', 'Exams history')

@section('content')


<div class="sidenav">
  <a href="/">Home</a>
  @if(Auth::check() && Auth::user()->email == $student->email)
  <a href="/student/profile">My profile</a>
  <a href="/students/{{ $student->id }}">My subjects</a>
  <a href="/register_exam">Register exam</a>
  <div class="active"><a href="/exams_history">Exams history</a></div>
  @endif
</div>

<div class="content">

	<h3>Exams history</h3>

@foreach($register_exam as $r_e)
  <table>
  <tr>
    <th>Subject name:</th>
    <td> {{ $r_e->subject_name }} </td>
  </tr>
  <tr>
    <th>Examination period:</th>
    <td> {{ $r_e->examination_period }} </td>
  </tr>
  <tr>
    <th>Status:</th>
    <td> {{ $r_e->status }} </td>
  </tr>
  <tr>
    <th>Year:</th>
    <td> {{ $r_e->year }} </td>
  </tr>
</table>
<br><br><br>
@endforeach

</div>


@stop