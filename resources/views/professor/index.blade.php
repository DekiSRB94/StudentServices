@extends('layouts')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/index.css') }}" />
@endpush

@section('title', 'Professors')

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
        <li><a href="/students">Students</a></li>
        <li class="active"><a href="/professors">Professors</a></li>
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
      <h1>Professors</h1>
      <p>Informations about professors.</p>
      <hr>


	<div class="container">           
	  <table class="table table-striped">
	    <thead>
	      <tr>
          <th>Picture</th>
	        <th>Name</th>
	        <th>Surname</th>
	        <th>Adress</th>
	        <th>Phone number</th>
          @if(Auth::check() && auth()->user()->role == 3)
          <th></th>
          @endif
          <th></th>
          @if(Auth::check() && auth()->user()->role == 3)
          <th></th>
          <th></th>
          @endif
	      </tr>
	    </thead>

	    <tbody>

	    @foreach($professor as $p)
	      <tr>
          <td> <img src="/professors_images/{{ $p->picture }}"></img> </td>
	        <td class="td_text"> {{ $p->name }} </td>
	        <td class="td_text"> {{ $p->surname}} </td>
	        <td class="td_text"> {{ $p->address}} </td>
	        <td class="td_text"> {{ $p->phone_number}} </td>
          @if(Auth::check() && auth()->user()->role == 3)
	        <td class="td_text">
	        	<button onclick="window.location.href='professors/{{ $p->id }}/edit'" type="button" class="table_button">Update</button>
	        </td>
          @endif
          <td class="td_text">
            <button onclick="window.location.href='/professors/{{ $p->id }}'" type="button" class="table_button">Subjects</button>
          </td>
          @if(Auth::check() && auth()->user()->role == 3)
	       <form method="POST" action="professors/{{ $p->id }}">

	       		@method('DELETE')
	       		@csrf

	        <td class="td_text">
	        	<button type="submit" onclick="return confirm('Are you sure ?')" class="table_button">Delete</button>
	        </td>
	        </form>
          @endif
          <td class="td_text">
            <button onclick="window.location.href='/professor/{{ $p->id }}/edit_password'" type="button" class="table_button">Password</button>
          </td>
	      </tr>
 		@endforeach      

	    </tbody>

	  </table>

	</div>
    
  </div>
  
    <div class="col-sm-2 sidenav">
      @if(Auth::check() && Auth::user()->role == 3)
          <button onclick="window.location.href='professors/create'" type="button" class="well">Add professor</button>
      @endif  
      @if(Auth::check() && Auth::user()->role == 2)
      <a href="/professor/profile">
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