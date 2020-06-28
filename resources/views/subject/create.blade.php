@extends('layouts')

@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ url('/css/create.css') }}">
@endpush

@section('title', 'Add subject')

@section('content')


<div class="container">

  @include('errors')
  
  <h2>Subjects</h2>
  <p>Add subject</p>

  <form method="post" action="/subjects">

    @csrf

    <div class="form-group">
      <label for="usr">Name:</label>
      <input type="text" class="form-control {{ $errors->has('name') ? 'alert alert-danger' : '' }}" id="name" name="name" value="{{ old('name') }}" required>
    </div>
    <div class="form-group">
      <label for="usr">ECTS:</label>
      <input type="text" class="form-control {{ $errors->has('ects') ? 'alert alert-danger' : '' }}" id="ects" name="ects" value="{{ old('ects') }}" required>
    </div>
    <div class="form-group">
      <label for="sel1">Year:</label>
      <select class="form-control {{ $errors->has('year') ? 'alert alert-danger' : '' }}" id="year" name="year">
        <option value="I" <?php if(old('year') == 'I')  echo 'selected = "selected"'; ?> >I</option>
        <option value="II" <?php if(old('year') == 'II')  echo 'selected = "selected"'; ?> >II</option>
        <option value="III" <?php if(old('year') == 'III')  echo 'selected = "selected"'; ?> >III</option>
        <option value="IV" <?php if(old('year') == 'IV')  echo 'selected = "selected"'; ?> >IV</option>
      </select>
    </div>
    <div class="form-group">
      <label for="sel1">Semester:</label>
      <select class="form-control {{ $errors->has('semester') ? 'alert alert-danger' : '' }}" id="semester" name="semester">
        <option value="1" <?php if(old('semester') == '1')  echo 'selected = "selected"'; ?> >1</option>
        <option value="2" <?php if(old('semester') == '2')  echo 'selected = "selected"'; ?> >2</option>
      </select>
    </div>
    <div class="form-group">
      <label for="usr">Direction:</label>
      <input type="text" class="form-control {{ $errors->has('direction') ? 'alert alert-danger' : '' }}" id="direction" name="direction" value="{{ old('direction') }}" required>
    </div>

   <div id="row">
    <div id="add_button">
      <button type="submit">Add subject</button>
    </div>
    <div id="cancel_button">
      <button onclick="window.location.href='/subjects'" type="button">Cancel</button>
    </div>
  </div>

  </form>

</div>

@stop
