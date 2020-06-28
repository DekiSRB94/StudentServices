@extends('layouts')

@push('styles')
  <link rel="stylesheet" type="text/css" href=" {{ url('/css/create.css') }} ">
@endpush

@section('title', 'Update professor password')

@section('content')

<div class="container">

    @include('errors')


    <form method="POST" action="/professor/password/{{ $professor->id }}">

    	@csrf
    	@method('PATCH')

		<div class="form-group">
	      <label for="pwd">Password:</label>
	      <input type="password" class="form-control {{ $errors->has('password') ? 'alert alert-danger' : '' }}" id="pwd" name="password">
	    </div>
	    <div id="update_button">
	    	<button type="submit" type="button">Update</button>
		</div>
	    <div id="cancel_button">
    		<button onclick="window.location.href='/professors'" type="button">Cancel</button>
    	</div>
	</form>

</div>


@stop