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
                            <td>{{$order->order_status_name}}</td>
                            <td>
                            @if($order->payment_status==true)
                                Paid
                                @else
                                Unpaid
                            @endif
                            </td>
                            <td><a href='{{route('orderView', ['id' => $order->id_order])}}' ">View Details</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
