<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!-- <style>
		body {
			margin: 0;
			padding: 0;
			background-color: #f1f1f1;
		}

		.box {
			width: 1270px;
			padding: 20px;
			background-color: #fff;
			border: 1px solid #ccc;
			border-radius: 5px;
			margin-top: 25px;
		}
	</style> -->
</head>

<body>


	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">

				<a class="navbar-brand" href="#">Dietcart</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li class="active"><a href="/admin/home">Home</a></li>
					<li><a href="/product/create">Create New Product</a></li>

				</ul>
				<ul class="nav navbar-nav navbar-right">

					<li><a href="/logout">LogOut</a></li>

				</ul>
			</div>
		</div>
	</nav>

	<h2 style="margin-left: 45%; font-family: 'Comic Sans MS', cursive, sans-serif;">List of Product</h2>

	<form method="post" action="/stories/search">
		{{csrf_field()}}
		<div class="form-group">
			<input type="text" name="username" class="form-control" id="uname" placeholder="User_name">
		</div>

		<div class="form-group">
			<input type="text" name="username2" class="form-control" id="uname" placeholder="User_name">
		</div>

		<div class="form-group">
			<input type="text" name="username1" class="form-control" id="uname" placeholder="User_name">
		</div>

		<button type="submit" value="Login" class="btn btn-default">Search</button>
	</form>

	<div class="container">

		<br />
		<br />

		<!-- <table id="user_data" class="table table-bordered table-striped"> -->

		@foreach($stories as $story)
		<!-- <div class="container-fluid"> -->
		<table id="user_data" class="table table-bordered table-striped">
			<tr>
				<td>
					Posted By {{$story->user["name"]}} {{" ---  "}} Post Date: {{$story->user["created_at"]}}
				</td>
			</tr>

			<tr>
				<td>Post Title: {{$story->title}}</td>
			</tr>

			<tr>
				<td>Post Tags: {{$story->tags ? $story->tags:"--"}}</td>
			</tr>

			<tr>
				<td>Post story: {{$story->story ? $story->story:"--"}}</td>
			</tr>

			<tr>
				<td>Comments:
					_________
					</br>
					@foreach($story->comment as $commnet)
					{{$commnet->comments ?$commnet->comments : "--"}}
					<form method="post" action="/posts/delete/{{$commnet->id}}">
						{{csrf_field()}}
						<input type="hidden" name="_method" value="delete">

						<input style="background-color: red; color: white;" class="btn" type="submit" value="Delete">
					</form>
					<!-- <a style="color: red;" href="/posts/delete/{{$commnet->id}}"><i class="fas fa-trash-alt"></i></a> -->
					</br>
					@endforeach
				</td>
				<!-- <td>Comments 1</td> -->
			</tr>

			<tr>
				<a style="color: green;">Block</i></a> |
				<a style="color: red;">Delete</i></a>
			</tr>

		</table>
		@endforeach
		<!-- </table> -->

	</div>
</body>

</html>