@extends('layouts')

@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ url('/css/create.css') }}">
@endpush

@section('title', 'Update options')

@section('content')


<div class="container">
  <h2>Update options:</h2>


  <form method="POST" action="/options">

  	@method('PATCH')
  	@csrf

    <div class="form-group">
      <label for="sel1">Examination period:</label>
      <select class="form-control {{ $errors->has('year') ? 'alert alert-danger' : '' }}" id="examination_period" name="examination_period" value="{{ $options->examination_period }}">
        <option value="none" <?php if($options->examination_period  == 'none')  echo 'selected = "selected"'; ?> >none</option>
        <option value="January" <?php if($options->examination_period == 'January')  echo 'selected = "selected"'; ?> >January</option>
        <option value="February" <?php if($options->examination_period == 'February')  echo 'selected = "selected"'; ?> >February</option>
        <option value="March" <?php if($options->examination_period == 'March')  echo 'selected = "selected"'; ?> >March</option>
        <option value="April" <?php if($options->examination_period == 'April')  echo 'selected = "selected"'; ?> >April</option>
        <option value="May" <?php if($options->examination_period == 'May')  echo 'selected = "selected"'; ?> >May</option>
        <option value="June" <?php if($options->examination_period == 'June')  echo 'selected = "selected"'; ?> >June</option>
        <option value="July" <?php if($options->examination_period == 'July')  echo 'selected = "selected"'; ?> >July</option>
        <option value="August" <?php if($options->examination_period == 'August')  echo 'selected = "selected"'; ?> >August</option>
        <option value="September" <?php if($options->examination_period == 'September')  echo 'selected = "selected"'; ?> >September</option>
        <option value="October" <?php if($options->examination_period == 'October')  echo 'selected = "selected"'; ?> >October</option>
        <option value="November" <?php if($options->examination_period == 'November')  echo 'selected = "selected"'; ?> >November</option>
        <option value="December" <?php if($options->examination_period == 'December')  echo 'selected = "selected"'; ?> >December</option>
      </select>
    </div>
    <div class="form-group">
      <label for="sel1">Status:</label>
      <select class="form-control {{ $errors->has('stauts') ? 'alert alert-danger' : '' }}" id="status" name="status">
        <option value="Inactive" <?php if($options->status == 'Inactive')  echo 'selected = "selected"'; ?> >Inactive</option>
        <option value="Active" <?php if($options->status == 'Active')  echo 'selected = "selected"'; ?> >Active</option>
      </select>
    </div>
    <div id="update_button">
    	<button type="submit" type="button">Update options</button>
    </div>	
     <div id="cancel_button">
    	<button onclick="window.location.href='/subjects'" type="button">Cancel</button>
    </div>

 @include('errors')

  </form>

</div>


@stop