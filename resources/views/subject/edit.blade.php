@extends('layouts')

@push('styles')
  <link rel="stylesheet" type="text/css" href=" {{ url('/css/create.css') }} ">
@endpush

@section('title', 'Update subject')

@section('content')


<div class="container">

  @include('errors')
  
  <h2>Subjects</h2>
  <p>Update existing subject</p>

  <form method="POST" action="/subjects/{{ $subject->id }}">

    @method('PATCH')
    @csrf

    <div class="form-group">
      <label for="usr">Name:</label>
      <input type="text" class="form-control {{ $errors->has('name') ? 'alert alert-danger' : '' }}" id="name" name="name" value="{{ $subject->name }}" value="{{ old('name') }}" required>
    </div>
    <div class="form-group">
      <label for="usr">ECTS:</label>
      <input type="text" class="form-control {{ $errors->has('ects') ? 'alert alert-danger' : '' }}" id="ects" name="ects" value="{{ $subject->ects }}" value="{{ old('ects') }}" required>
    </div>
    <div class="form-group">
      <label for="sel1">Year:</label>
      <select class="form-control {{ $errors->has('year') ? 'alert alert-danger' : '' }}" id="year" name="year">
        <option value="I" <?php if($subject->year == 'I')  echo 'selected = "selected"'; ?> >I</option>
        <option value="II" <?php if($subject->year == 'II') echo 'selected = "selected"'; ?> >II</option>
        <option value="III" <?php if($subject->year == 'III') echo 'selected = "selected"'; ?> >III</option>
        <option value="IV" <?php if($subject->year == 'IV') echo 'selected = "selected"'; ?> >IV</option>
      </select>
    </div>
    <div class="form-group">
      <label for="sel1">Semester:</label>
      <select class="form-control {{ $errors->has('semester') ? 'alert alert-danger' : '' }}" id="semester" name="semester">
        <option value="1" <?php if($subject->semester == '1')  echo 'selected = "selected"'; ?> >1</option>
        <option value="2" <?php if($subject->semester == '2')  echo 'selected = "selected"'; ?> >2</option>
      </select>
    </div>    <div class="form-group">
      <label for="usr">Direction:</label>
      <input type="text" class="form-control {{ $errors->has('direction') ? 'alert alert-danger' : '' }}" id="direction" name="direction" value="{{ $subject->direction }}" value="{{ old('direction') }}" required>
    </div>

    <div id="add_button">
      <button type="submit">Update</button>
    </div>

    <div id="cancel_button">
      <button onclick="location.href='/subjects'" type="button">Cancel</button>
    </div>

  </form>

</div>


@stop
