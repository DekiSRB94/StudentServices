@extends('layouts')

@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ url('/css/edit_balance.css') }}">
@endpush

@section('title', 'Update balance')

@section('content')


<div class="container">

   @include('errors')

  <h2>Account balance</h2>


  <form method="POST" action="/student/balance/{{ $student->id }}">

  	@method('PATCH')
  	@csrf

    <div class="form-group">
      <label for="usr">Balance:</label>
      <input type="text" class="form-control {{ $errors->has('account_balance') ? 'alert alert-danger' : '' }}" id="account_balance" name="account_balance" value="{{ $student->account_balance }}" value="{{ old('account_balance') }}">
    </div>
    <div id="update_button">
    	<button type="submit" type="button">Update balance</button>
    </div>	
     <div id="cancel_button">
    	<button onclick="window.location.href='/students'" type="button">Cancel</button>
    </div>

  </form>

</div>


@stop