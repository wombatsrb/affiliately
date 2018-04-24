@extends('layouts.admin')

@section('content')
<div class="main-page">
	<div class="tables">

		<div class="bs-example widget-shadow" data-example-id="hoverable-table">
			<h4>Hover Rows Table:</h4>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Username</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Modify</th>
                                                <th>Delete</th>
					</tr>
				</thead>
				<tbody>
                                    @foreach($users as $user)
					<tr>
						<th scope="row">{{$loop->iteration}}</th>
						<td>{{$user->name}}</td>
						<td>{{$user->surname}}</td>
						<td>{{$user->username}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->role_name}}</td>
                                                <td>{{$user->status_name}}</td>
                                                <td><a href='#'>Modify</a></td>
                                                <td><a href='#'>Delete</a></td>
					</tr>
                                    @endforeach
                                    <!-- comment -->
                                </tbody>
			</table>
		</div>
	</div>
</div>

@endsection
