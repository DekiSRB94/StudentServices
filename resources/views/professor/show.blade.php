@extends('layouts')

@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ url('/css/show.css') }}">
@endpush

@section('title', 'Professor subjects')

@section('content')

<div class="sidenav">
    <a href="/professors">Home</a>
    @if(Auth::check() && Auth::user()->email == $professor->email)
    <a href="/professor/profile">My profile</a>
    <div class="active"><a href="/professors/{{ $professor->id }}">My subjects</a></div>
    @endif
  </div>

<div class="container">
  <h2>Subjects</h2>

    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Year</th>
          <th>Semester</th>
          <th>Direction</th>
          @if(Auth::check() && auth()->user()->role == 3)
          <th></th>
          @endif
        </tr>
      </thead>

      <tbody>
          @foreach($subjects as $s)
              <tr>
              <td class="td_text"> {{ $s->name}} </td>
              <td class="td_text"> {{ $s->year }} </td>
              <td class="td_text"> {{ $s->semester }} </td>
              <td class="td_text"> {{ $s->direction }} </td>
                @if(Auth::check() && auth()->user()->role == 3)
                <form method="POST" action="/professor_subjects/{{ $s->id }}/{{ $professor->id }}">

                  @method('DELETE')
                  @csrf

                <td>
                  <button onclick="return confirm('Are you sure ?')" type="submit">Delete subject</button>
                </td>
                </form>
              @endif
              </tr>
          @endforeach

      </tbody>

    </table>



  @if(Auth::check() && auth()->user()->role == 3)
    <button type="button" onclick="window.location.href='/professors/create_subjects/{{ $professor->id}}'" class="add_button">Add subject</button>
  @endif  
    <button type="button" onclick="window.location.href='/professors'" class="cancel">Cancel</button>
  

@stop