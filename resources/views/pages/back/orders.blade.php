@extends('layouts.admin')

@section('content')
    @include('components.back.displayMessages')
    <div class="main-page">
        <div class="tables">

            <div class="bs-example widget-shadow" data-example-id="hoverable-table">
                <h4>Orders</h4>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Ordered By</th>
                        <th>Cusomer Email</th>
                        <th>Date of Order</th>
                        <th>Date of Update</th>
                        <th>Order Status</th>
                        <th>Payment Status</th>
                        <th>Order Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allOrders as $order)
                        <tr>
                            <th scope="row">{{$order->id_order}}</th>
                            <td>{{$order->name . ' ' . $order->surname}}</td>
                            <td>{{$order->email}}</td>
                            <td>{{$order->date_of_order}}</td>
                            <td>{{$order->date_of_update}}</td>
                            <td><span
                                @if($order->order_status_id == 1)
                                    class="label label-warning"
                                @endif
                                @if($order->order_status_id == 2)
                                    class="label label-success"
                                @endif
                                @if($order->order_status_id == 3)
                                    class="label label-danger"
                                @endif
                            >{{$order->order_status_name}}</span></td>
                            <td>
                            @if($order->payment_status==true)
                                    <span class="badge badge-success">Paid</span>
                                @else
                                    <span class="badge badge-danger">Unpaid</span>
                            @endif
                            </td>
                            <td><a class="btn btn-primary" href='{{route('orderView', ['id' => $order->id_order])}}' ">Details</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
