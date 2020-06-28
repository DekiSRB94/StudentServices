@extends('layouts')

@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ url('/css/create.css') }}">
@endpush

@section('title', 'Add student')

@section('content')


<div class="container">

  @include('errors')
  
  <h2>Students</h2>
  <p>Add new student.</p>


  <form enctype="multipart/form-data" method="POST" action="/students">

  	@csrf

    <div class="form-group">
      <label for="usr">Name:</label>
      <input type="text" class="form-control {{ $errors->has('name') ? 'alert alert-danger' : '' }}" id="name" name="name" value="{{ old('name') }}" required>
    </div>
    <div class="form-group">
      <label for="usr">Surname:</label>
      <input type="text" class="form-control {{ $errors->has('surname') ? 'alert alert-danger' : '' }}" id="surname" name="surname" value="{{ old('surname') }}" required>
    </div>
    <div class="form-group">
      <label for="usr">Identification number:</label>
      <input type="text" class="form-control {{ $errors->has('identification_number') ? 'alert alert-danger' : '' }}" id="identification_number" name="identification_number" value="{{ old('identification_number') }}" required>
    </div>
    <div class="form-group">
      <label for="usr">Index number:</label>
      <input type="text" class="form-control {{ $errors->has('index_number') ? 'alert alert-danger' : '' }}" id="index_number" name="index_number" value="{{ old('index_number') }}" required>
    </div>
    <div class="form-group">
      <label for="usr">Address:</label>
      <input type="text" class="form-control {{ $errors->has('address') ? 'alert alert-danger' : '' }}" id="address" name="address" value="{{ old('address') }}" required>
    </div>
    <div class="form-group">
      <label for="usr">Phone number:</label>
      <input type="text" class="form-control {{ $errors->has('phone_number') ? 'alert alert-danger' : '' }}" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
    </div>
    <div class="form-group">
      <label for="usr">Picture:</label>
      <input type="file" class="custom-file-input {{ $errors->has('picture') ? 'alert alert-danger' : '' }}" id="picture" name="picture" required>
    </div>
    <div class="form-group">
      <label for="email">Email address:</label>
      <input type="email" class="form-control {{ $errors->has('email') ? 'alert alert-danger' : '' }}" value="{{ old('email') }}" id="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control {{ $errors->has('password') ? 'alert alert-danger' : '' }}" id="pwd" name="password" required>
    </div>
    <div id="add_button">
    	<button type="submit">Add student</button>
    </div>	
     <div id="cancel_button">
    	<button onclick="window.location.href='/students'" type="button">Cancel</button>
    </div>

  </form>


</div>




<script type="text/javascript">

    $('#identification_number').keyup(function(){
      $('#pwd').val($(this).val());
    });

</script>


@stop