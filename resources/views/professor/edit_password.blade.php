@extends('layouts')

@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ url('/css/create.css') }}">
@endpush

@section('title', 'Update password')

@section('content')


<div class="container">

  @include('errors')

  <h2>Update password:</h2>

  <form method="POST" action="/professor/password">

  	@method('PATCH')
  	@csrf

    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control {{ $errors->has('password') ? 'alert alert-danger' : '' }}" id="pwd" name="password">
    </div>
    <div class="form-group">
      <label for="pwd">Repeat password:</label>
      <input type="password" class="form-control {{ $errors->has('password_confirmation') ? 'alert alert-danger' : '' }}" id="pwd_conf" name="password_confirmation">
    </div>
    <div id="update_button">
    	<button type="submit" type="button">Update password</button>
    </div>	
     <div id="cancel_button">
    	<button onclick="window.location.href='/professor/profile'" type="button">Cancel</button>
    </div>

  </form>

</div>


@stop