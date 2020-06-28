@extends('layouts')

@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ url('/css/index.css') }}">
@endpush

@section('title', 'Subjects')

@section('content')

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a href="/" class="navbar-brand">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="/students">Students</a></li>
        <li><a href="/professors">Professors</a></li>
        <li class="active"><a href="/subjects">Subjects</a></li>
      </ul>
      @if(!Auth::check())
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
      @endif
      @if(Auth::check())
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
      @endif
    </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
    </div>


    <div class="col-sm-8 text-left"> 
      <h1>Subjects</h1>
      <p>Information about subjects.</p>
      <hr>


     <div class="container">         
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Year</th>
            <th>ECTS</th>
            <th>Semester</th>
            <th>Direction</th>
            @if(Auth::check() && auth()->user()->role == 3)
            <th></th>
            <th></th>
            @endif
          </tr>
        </thead>

        <tbody>
          @foreach($subject as $s)
            <tr>
              <td class="td_text_2"> {{ $s->name }} </td>
              <td class="td_text_2"> {{ $s->year }} </td>
              <td class="td_text_2"> {{ $s->ects }} </td>
              <td class="td_text_2"> {{ $s->semester }} </td>
              <td class="td_text_2"> {{ $s->direction }} </td>
              @if(Auth::check() && auth()->user()->role == 3)
              <td class="td_text_2">
                <button onclick="location.href='subjects/{{ $s->id }}/edit'" type="button" class="table_button">Edit</button>
              </td>
              <td class="td_text_2">
                <form method="POST" action="/subjects/{{ $s->id }}">

                  @method('DELETE')
                  @csrf
                  
                    <button onclick="return confirm('Are you sure?')" type="submit" class="table_button">Delete</button>
                </form>
              </td>
            </tr>
              @endif
          @endforeach
        </tbody>
      </table>

    </div>

    </div>



    <div class="col-sm-2 sidenav">
      @if(Auth::check() && Auth::user()->role == 3)
        <button onclick="window.location.href='subjects/create'" type="button" class="side_button">Add subject</button>
        <button onclick="window.location.href='exam_options'" type="button" class="side_button">Exam options</button>
      @endif
    </div>

  </div>
</div>

<footer>
  <p>Design by Zivlak</p>
</footer>


@stop