@extends('layouts.admin')

@section('content')
@include('components.back.displayMessages')
<div class="main-page">
	<div class="tables">

		<div class="bs-example widget-shadow" data-example-id="hoverable-table">
			<h4>Users</h4>
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
                                                <td><span
													@if($user->user_status_id == 1)
														class="badge badge-warning"
													@endif
													@if($user->user_status_id == 2)
														class="badge badge-success"
													@endif
													@if($user->user_status_id == 3)
														class="badge badge-danger"
													@endif
													>{{$user->status_name}}</span></td>
                                                <td><a class="btn btn-primary" href='{{route('editUserView', ['id' => $user->id_user])}}'>Modify</a></td>
                                                <td><a class="btn btn-danger" href='{{route('deleteUser', ['id' => $user->id_user])}}' onclick="return confirm('Are you sure?')">Delete</a></td>
					</tr>
                                    @endforeach
                                </tbody>
			</table>
		</div>
	</div>
</div>

@endsection
