@extends('layouts')

@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ url('/css/create.css') }}">
@endpush

@section('title', 'Edit exam mark')

@section('content')


<div class="container">

  @include('errors')
  
  <h2>Exam mark</h2>


  <form method="POST" action="/mark/{{ $student_subject->student_id }}/{{ $student_subject->subject_id }}">

  	@method('PATCH')
  	@csrf

    <div class="form-group">
      <label for="sel1">Mark:</label>
      <select class="form-control {{ $errors->has('mark') ? 'alert alert-danger' : '' }}" id="mark" name="mark">
        <option value="5" <?php if($student_subject->mark == '5')  echo 'selected = "selected"'; ?> >5</option>
        <option value="6" <?php if($student_subject->mark == '6')  echo 'selected = "selected"'; ?> >6</option>
        <option value="7" <?php if($student_subject->mark == '7')  echo 'selected = "selected"'; ?> >7</option>
        <option value="8" <?php if($student_subject->mark == '8')  echo 'selected = "selected"'; ?> >8</option>
        <option value="9" <?php if($student_subject->mark == '9')  echo 'selected = "selected"'; ?> >9</option>
        <option value="10" <?php if($student_subject->mark == '10')  echo 'selected = "selected"'; ?> >10</option>
      </select>
    </div>
    <div id="update_button">
    	<button type="submit">Update mark</button>
    </div>	
     <div id="cancel_button">
    	<button onclick="window.location.href='/students/{{ $student_subject->student_id }}'" type="button">Cancel</button>
    </div>

  </form>

</div>


@stop