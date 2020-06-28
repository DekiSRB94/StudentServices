@extends('layouts')

@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ url('/css/show.css') }}">
@endpush

@section('title', 'Student subjects')

@section('content')

  <div class="sidenav">
    <a href="/">Home</a>
    @if(Auth::check() && Auth::user()->email == $student->email)
    <a href="/student/profile">My profile</a>
    <div class="active"><a href="/students/{{ $student->id }}">My subjects</a></div>
    <a href="/register_exam">Register exam</a>
    <a href="/exams_history">Exams history</a>
    @endif
  </div>

<div class="container">

  @if(session()->has('message1'))
    <div class="alert alert-success">
        {{ session()->get('message1') }}
    </div>
   @endif
  @if(session()->has('message2'))
    <div class="alert alert-danger">
        {{ session()->get('message2') }}
    </div>
   @endif

  <h2>Active subjects</h2>

    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Year</th>
          <th>ECTS</th>
          <th>Semester</th>
          <th>Direction</th>
          @if(Auth::check() && Auth::user()->role == 3)
          <th></th>
          @endif
          @if(Auth::check() && Auth::user()->role == 2)
          <th></th>
          @endif
        </tr>
      </thead>

      <tbody>
          @foreach($subjects as $s)
          @foreach($student_subject as $s_s) 
            @if($s_s->student_id == $student->id && $s_s->subject_id == $s->id && $s_s->mark == 5)
              <tr>
              <td class="td_text"> {{ $s->name}} </td>
              <td class="td_text"> {{ $s->year }} </td>
              <td class="td_text"> {{ $s->ects }} </td>
              <td class="td_text"> {{ $s->semester }} </td>
              <td class="td_text"> {{ $s->direction }} </td>
                @if(Auth::check() && Auth::user()->role == 3)
                <form method="POST" action="/subjects/{{ $s->id }}/{{ $student->id }}">

                  @method('DELETE')
                  @csrf

                <td>
                  <button onclick="return confirm('Are you sure ?')" type="submit">Delete subject</button>
                </td>
                </form>
              @endif
                @if(Auth::check() && Auth::user()->role == 2)
                @foreach($register_exam as $r_e)
                @foreach($professor_subject as $p_s)
                @if($p_s->subject_id == $s->id)
                @if($r_e->status == 'Active' && $r_e->student_id == $s_s->student_id && $r_e->subject_name == $s->name)
                <td>
                  <button onclick="window.location.href='/student/{{ $student->id }}/{{ $s->id }}/edit'">Rate exam</button>
                </td>
                @endif
                @endif
                @endforeach
                @endforeach
                @endif
              </tr>
            @endif
          @endforeach
          @endforeach

      </tbody>
    </table>

  @if(Auth::check() && Auth::user()->role == 3)
    <button class="add_button" type="button" onclick="window.location.href='/students/create_subjects/{{ $student->id}}'">Add subject</button>
  @endif  

  <div class="make_space"></div>

  <h2>Passed subjects</h2>

    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Year</th>
          <th>ECTS</th>
          <th>Semester</th>
          <th>Direction</th>
          <th>Mark</th>
          @if(Auth::check() && Auth::user()->role == 3)
          <th></th>
          @endif
        </tr>
      </thead>

      <tbody>
          @foreach($subjects as $s)
          @foreach($student_subject as $s_s)
            @if($s_s->student_id == $student->id && $s_s->subject_id == $s->id && $s_s->mark > 5)
              <tr>
              <td class="td_text"> {{ $s->name}} </td>
              <td class="td_text"> {{ $s->year }} </td>
              <td class="td_text"> {{ $s->ects }} </td>
              <td class="td_text"> {{ $s->semester }} </td>
              <td class="td_text"> {{ $s->direction }} </td>
              <td class="td_text"> {{ $s_s->mark }} </td>
          
                @if(Auth::check() && Auth::user()->role == 3)
                <form method="POST" action="/subjects/{{ $s->id }}/{{ $student->id }}">

                  @method('DELETE')
                  @csrf

                <td>
                  <button onclick="return confirm('Are you sure ?')" type="submit">Delete subject</button>
                </td>
                </form>
              @endif
              </tr>
            @endif
          @endforeach
          @endforeach

      </tbody>
    </table>

  
</div>


@stop
