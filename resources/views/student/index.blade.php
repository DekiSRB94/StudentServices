@extends('layouts')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/index.css') }}" />
@endpush

@section('title', 'Students')

@section('content')

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="/" class="navbar-brand">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/students">Students</a></li>
        <li><a href="/professors">Professors</a></li>
        <li><a href="/subjects">Subjects</a></li>
      </ul>
      @if(!Auth::check())
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
      @endif
      @if(Auth::check())
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
      @endif
    </div>
</nav>


<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">
    </div>
    <div class="col-sm-8 text-left">
      <h1>Students</h1>
      <p>Information about students.</p>
      <hr>


	<div class="container">
	  <table class="table table-striped">
	    <thead>
	      <tr>
          <th>Picture</th>
	        <th>Name</th>
	        <th>Surname</th>
	        <th>Index number</th>
	        <th>Address</th>
	        <th>Phone number</th>
          @if(Auth::check() && Auth::user()->role == 3)
          <th></th>
          @endif
          <th></th>
          @if(Auth::check() && Auth::user()->role == 3)
          <th></th>
          <th></th>
          <th></th>
          @endif
	      </tr>
	    </thead>

	    <tbody>

	    @foreach($student as $s)
	      <tr>
          <td class="td_img"> <img src="/students_images/{{ $s->picture }}"><img/> </td>
	        <td class="td_text"> {{ $s->name }} </td>
	        <td class="td_text"> {{ $s->surname}} </td>
	        <td class="td_text"> {{ $s->index_number}} </td>
	        <td class="td_text"> {{ $s->address}} </td>
	        <td class="td_text"> {{ $s->phone_number}} </td>
          @if(Auth::check() && Auth::user()->role == 3)
	        <td class="td_text">
	        	<button onclick="window.location.href='students/{{ $s -> id }}/edit'" type="button" class="table_button">Update</button>
	        </td>
          @endif
          <td class="td_text">
            <button onclick="window.location.href='students/{{ $s->id }}'" type="button" class="table_button">Subjects</button>
          </td>
	       <form method="POST" action="students/{{ $s -> id }}">

	       		@method('DELETE')
	       		@csrf

          @if(Auth::check() && Auth::user()->role == 3)
	        <td class="td_text">
	        	<button onclick="return confirm('Are you sure?')" type="submit" class="table_button">Delete</button>
	        </td>
	        </form>
          <td class="td_text">
              <button onclick="window.location.href='/student/{{ $s->id }}/edit_password'" type="button" class="table_button">Password</button>
          </td>
          <td class="td_text">
              <button onclick="window.location.href='/student/{{ $s->id }}/edit_account_balance'" type="button" class="table_button">Balance</button>
            @endif
          </td>
	      </tr>
 		   @endforeach

	    </tbody>

	  </table>

    {{ $student->render() }}

	</div>


    </div>
    <div class="col-sm-2 sidenav">

      @if(Auth::check() && Auth::user()->role == 3)
          <button onclick="window.location.href='students/create'" type="button" class="well">Add student</button>
      @endif  
      @if(Auth::check() && Auth::user()->role == 1)
      <a href="/student/profile">
      <div class="well">
        <p>My profile</p>
      </div>
      </a>
      @endif
    </div>
  </div>
</div>

<footer>
  <p>Design by Zivlak</p>
</footer>

@stop
