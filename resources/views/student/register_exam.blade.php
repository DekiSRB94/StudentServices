@extends('layouts')

@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ url('/css/register_exam.css') }}">
@endpush

@section('title', 'Register exam')

@section('content')


  <div class="sidenav">
    <a href="/">Home</a>
    @if(Auth::check() && Auth::user()->email == $student->email)
    <a href="/student/profile">My profile</a>
    <a href="/students/{{ $student->id }}">My subjects</a>
    <div class="active"><a href="/register_exam">Register exam</a></div>
    <a href="/exams_history">Exams history</a>
    @endif
  </div>

<div class="container">

  @include('errors')

  @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
   @endif
     @if(session()->has('message2'))
    <div class="alert alert-danger">
        {{ session()->get('message2') }}
    </div>
   @endif

   <h4>Account balance: {{ $student->account_balance }} din</h4>
  
  <h2>Active subjects</h2>

  @if($exams_options->status == 'Active')
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Year</th>
          <th>ECTS</th>
          <th>Semester</th>
          <th>Direction</th>
          @if(Auth::check() && Auth::user()->role == 1 && $student->email == auth()->user()->email)
          <th></th>
          @endif
        </tr>
      </thead>

      <tbody>
          @foreach($subjects as $s)
          @foreach($student_subject as $s_s)
            @if($s_s->student_id == $student->id && $s_s->subject_id == $s->id && $s_s->mark == 5)
                @if(Auth::check() && Auth::user()->role == 1 && $student->email == auth()->user()->email)
                <form method="POST" action="/exam">

                  @csrf

              <tr>
              <td class="td_text"> {{ $s->name}} </td>
              <td class="td_text"> {{ $s->year }} </td>
              <td class="td_text"> {{ $s->ects }} </td>
              <td class="td_text"> {{ $s->semester }} </td>
              <td class="td_text"> {{ $s->direction }} </td>
              <input type="hidden" name="subject_name" value="{{ $s->name }}">
              <input type="hidden" name="year" value="{{ date('Y') }}">
              @if($student->account_balance >= 1500)
                <td>
                  <button onclick="return confirm('Are you sure ?')" type="submit">Register exam</button>
                </td>
              @endif
              </tr>
                </form>
                @endif
            @endif
          @endforeach
          @endforeach

      </tbody>
    </table>
    @endif


    @if($exams_options->status == 'Inactive')

      <h3>Examination period is not active at this moment.</h3>

    @endif
  
</div>


@stop
