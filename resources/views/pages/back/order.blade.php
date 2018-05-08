@extends('layouts.admin')

@section('content')
    <div class="main-page">
        @include('components.back.displayMessages')
        <div class="col-md-4">
            <div class="sign-up-row  widget-shadow form-group">
                <h2>User Data</h2>
                <br>
                <table class="table">
                    <tr>
                        <td>Customer #</td>
                        <td>{{$orderData->user_id}}</td>
                    </tr>
                    <tr>
                        <td>Customer Name</td>
                        <td>{{$orderData->name}}</td>
                    </tr>
                    <tr>
                        <td>Customer Surname</td>
                        <td>{{$orderData->surname}}</td>
                    </tr>
                    <tr>
                        <td>Customer Email</td>
                        <td>{{$orderData->email}}</td>
                    </tr>
                </table>
                <div class="col-md-4 col-md-offset-4">
                    <a href="{{route('editUserView', ['id' => $orderData->user_id])}}" >View all User Details</a>
                </div>
                <br>

            </div>

                <div class="sign-up-row  widget-shadow form-group">
                    <h2>Order Details</h2>
                    <br>
                    <table class="table">
                        <tr>
                            <td>Order #</td>
                            <td>{{$orderData->id_order}}</td>
                        </tr>
                        <tr>
                            <td>Date of Order</td>
                            <td>{{$orderData->date_of_order}}</td>
                        </tr>
                        <tr>
                            <td>Order Status</td>
                            <td>{{$orderData->order_status_name}}</td>
                        </tr>
                        <tr>
                            <td>Payment Status</td>
                            <td>
                                @if($orderData->payment_status==true)
                                    Paid
                                @else
                                    Unpaid
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

        </div>
        <div class="col-md-1">

        </div>
        <div class="col-md-7">
            <div class="sign-up-row  widget-shadow form-group col-md-12">
                    <h2>Ordered Services</h2>
                    <br>

                @foreach($orderServicesData as $serviceData)
                <div class="form-three widget-shadow col-md-6">
                    <h3>Service {{$loop->iteration}}</h3><br>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-4 control-label">Service Name:</label>
                            <div class="col-sm-8">
                                {{$serviceData->service_name}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-4 control-label">Service Category:</label>
                            <div class="col-sm-8">
                                {{$serviceData->service_category_name}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-4 control-label">Quantity:</label>
                            <div class="col-sm-8">
                                {{$serviceData->quantity}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-4 control-label">Ordered Service Status:</label>
                            <div class="col-sm-8">
                                {{$serviceData->order_service_status_name}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-4 control-label">Date of Service Adding:</label>
                            <div class="col-sm-8">
                                {{$serviceData->date_of_adding}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-4 control-label">Worker Allocated:</label>
                            <div class="col-sm-8">
                                @if($serviceData->username==null)
                                    <div class="text-danger"><b>Worker not allocated yet!</b></div>
                                    @else
                                    {{$serviceData->username}}
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2">
                                <a href="{{route('orderServiceView', ['id' => $serviceData->id_order_service])}}" class="btn btn-primary" role="button">Modify Service Order</a>
                            </div>
                        </div>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        <div class='clearfix'></div>
    </div>

@endsection
