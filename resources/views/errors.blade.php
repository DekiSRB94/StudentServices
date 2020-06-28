<!DOCTYPE html>
<html>
<head>
	<style>
		.alert{
			margin-top: 20px;
		}
	</style>
</head>
<body>

		@if($errors->any())
			<div id="alert" class="alert alert-danger">
				<ul>
				@foreach($errors->all() as $error)
					<li> {{ $error }}</li>
				@endforeach
				</ul>
			</div>
		@endif	

</body>
</html>