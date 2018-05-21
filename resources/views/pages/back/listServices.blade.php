
@extends('layouts.admin')

@section('content')
@include('components.back.displayMessages')

<div class="main-page">
	<div class="tables">

		<div class="bs-example widget-shadow" data-example-id="hoverable-table">
			<h4>Services</h4>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Description</th>
						<th>Price</th>
						<th>Category</th>
						<th>Type</th>
                      	<th>Status</th>
						<th>Modify</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					@foreach($services as $service)
						<tr>
							<th scope="row">{{$loop->iteration}}</th>
							<td>{{$service->service_name}}</td>
							<td>{{$service->service_description}}</td>
							<td>{{$service->service_price}}</td>
							<td>{{$service->service_category_name}}</td>
							<td><span
								@if($service->service_type_id == 1)
									class="label label-warning"
								@endif
								@if($service->service_type_id == 2)
									class="label label-info"
								@endif
								>{{$service->service_type_name}}</span></td>
							<td><span
								@if($service->service_status == 1)
									class="badge badge-success"
								@else
									class="badge badge-danger"
								@endif
								>{{$service->service_status?'Enabled':'Disabled'}}</span></td>
							<td><a class="btn btn-primary" href='{{route('editServiceView', ['id' => $service->id_service])}}'>Modify</a></td>
							<td><a class="btn btn-danger" href='{{route('deleteService', ['id' => $service->id_service])}}' onclick="return confirm('Are you sure?')">Delete</a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection
