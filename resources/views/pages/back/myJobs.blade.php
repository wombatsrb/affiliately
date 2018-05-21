@extends('layouts.admin')

@section('content')
    @include('components.back.displayMessages')
    <div class="main-page col-md-8 col-md-offset-2">
        <div class="tables">

            <div class="bs-example widget-shadow" data-example-id="hoverable-table">
                <h4>My Jobs</h4>
                @if($orderServicesJobs->isNotEmpty())
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Service Name</th>
                        <th>Service Description</th>
                        <th>Service Category</th>
                        <th>Quantity</th>
                        <th>Date of Adding</th>
                        <th>Date of Update</th>
                        <th>Has been charged?</th>
                        <th>More Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orderServicesJobs as $job)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$job->service_name}}</td>
                            <td>{{$job->service_description}}</td>
                            <td>{{$job->service_category_name}}</td>
                            <td>{{$job->quantity}}</td>
                            <td>{{$job->date_of_adding}}</td>
                            <td>{{$job->date_of_update}}</td>
                            <td>
                                @if($job->isCharged==0)
                                        <span class="badge badge-danger">No</span>
                                    @else
                                        <span class="badge badge-success">Yes</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('orderServiceView', ['id'=>$job->id_order_service])}}" class="btn btn-primary">More Details</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    @else
                    <br>
                    <div class="alert alert-warning" role="alert">
                        You don't have any job
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
