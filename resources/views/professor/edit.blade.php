@extends('layouts')

@push('styles')
  <link rel="stylesheet" type="text/css" href=" {{ url('/css/create.css') }} ">
@endpush

@section('title', 'Update professor')

@section('content')


<div class="container">

    @include('errors')

  <h2>Professors</h2>
  <p>Update existing professor.</p>


  <form method="POST" action="/professors/{{ $professor->id }}">

    @method('PATCH')
    @csrf

    <div class="form-group">
      <label for="usr">Name:</label>
      <input type="text" class="form-control {{ $errors->has('name') ? 'alert alert-danger' : '' }}" id="name" name="name" value="{{ $professor->name }}" value="{{ old('name') }}">
    </div>
    <div class="form-group">
      <label for="usr">Surname:</label>
      <input type="text" class="form-control {{ $errors->has('surname') ? 'alert alert-danger' : '' }}" id="surname" name="surname" value="{{ $professor->surname }}" value="{{ old('surname') }}">
    </div>
    <div class="form-group">
      <label for="usr">Identification number:</label>
      <input type="text" class="form-control {{ $errors->has('identification_number') ? 'alert alert-danger' : '' }}" id="identification_number" name="identification_number" value="{{ $professor->identification_number }}" value="{{ old('identification_number') }}">
    </div>
    <div class="form-group">
      <label for="usr">Address:</label>
      <input type="text" class="form-control {{ $errors->has('address') ? 'alert alert-danger' : '' }}" id="address" name="address" value="{{ $professor->address }}" value="{{ old('address') }}">
    </div>
    <div class="form-group">
      <label for="usr">Phone number:</label>
      <input type="text" class="form-control {{ $errors->has('phone_number') ? 'alert alert-danger' : '' }}" id="phone_number" name="phone_number" value="{{ $professor->phone_number }}" value="{{ old('phone_number') }}">
    </div>
    <div class="form-group">
      <label for="email">Email address:</label>
      <input type="email" class="form-control {{ $errors->has('email') ? 'alert alert-danger' : '' }}" value="{{ $professor->email }}" value="{{ old('email') }}" id="email" name="email">
    </div>
    <div id="update_button">
      <button type="submit" type="button">Update professor</button>
    </div>  
     <div id="cancel_button">
      <button onclick="window.location.href='/professors'" type="button">Cancel</button>
    </div>

  </form>

</div>


<script type="text/javascript">

    $('#identification_number').keyup(function(){
      $('#pwd').val($(this).val());
    });

</script>


@stop