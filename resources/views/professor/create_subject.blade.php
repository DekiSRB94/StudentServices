@extends('layouts')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/add_subject.css') }}" />
@endpush

@section('title', 'Create subject')

<div class="container">

  @include('errors')

@section('header', 'Add subject')

@section('content')


  <form method="POST" action="/professors/add_subjects/{{ $professor->id }}">

  	@csrf

	<h4>First year</h4>
  	@foreach($subject as $s)
  	 @if($s->year == 'I')
	  <ul class="ks-cboxtags">
      	<li><input name="subject_id[]" type="checkbox" id="{{ $s->id }}" value="{{ $s->id }}"><label for="{{ $s->id }}">{{ $s->name }}</label></li>
  	  </ul>
	  @endif
	@endforeach

	<h4>Second year</h4>
	<div class="input">
  	@foreach($subject as $s)
  	 @if($s->year == 'II')
  	  <ul class="ks-cboxtags">
      	<li><input name="subject_id[]" type="checkbox" id="{{ $s->id }}" value="{{ $s->id }}"><label for="{{ $s->id }}">{{ $s->name }}</label></li>
  	  </ul>
	  @endif
	@endforeach
	</div>

	<h4>Third year</h4>
	<div class="input">
  	@foreach($subject as $s)
  	 @if($s->year == 'III')
  	  <ul class="ks-cboxtags">
      	<li><input name="subject_id[]" type="checkbox" id="{{ $s->id }}" value="{{ $s->id }}"><label for="{{ $s->id }}">{{ $s->name }}</label></li>
  	  </ul>
	  @endif
	@endforeach
	</div>

	<h4>Fourth year</h4>
	<div class="input">
  	@foreach($subject as $s)
  	 @if($s->year == 'IV')
  	  <ul class="ks-cboxtags">
      	<li><input name="subject_id[]" type="checkbox" id="{{ $s->id }}" value="{{ $s->id }}"><label for="{{ $s->id }}">{{ $s->name }}</label></li>
  	  </ul>
	  @endif
	@endforeach
	</div>
	
	  	<button type="submit">Add subject</button>
	 	<button onclick="window.location.href='/professors/{{ $professor->id }}'" type="button">Cancel</button>

  </form>

</div>

@stop