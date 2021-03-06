@extends('layouts.admin')

@section('content')
<div class="main-page">
    @include('components.back.displayMessages')
    <div class="col-md-4">
        <div class="sign-up-row  widget-shadow form-group">
            <form action='{{route('editUser', ['id' =>  $userData->id_user])}}' method="POST">
                {{  csrf_field() }}
                <table class="table">
                        <h2>User Information</h2>
                        <tr>
                            <td>Name</td>
                            <td><input type="text" class="form-control" name="name" value="{{$userData->name}}" ></td>
                        </tr>
                        <tr>
                            <td>Surname</td>
                            <td><input type="text" class="form-control" name="surname" value="{{$userData->surname}}" ></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="email" class="form-control" name="email" value="{{$userData->email}}" ></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td><input type="text" class="form-control" name="username" value="{{$userData->username}}" ></td>
                        </tr>
                        <tr>
                            <td>Date of Registration</td>
                            <td><input type="text" class="form-control" name="date_of_registration" value="{{$userData->date_of_registration}}" disabled></td>
                        </tr>
                        <tr>
                            <td>Date of Update</td>
                            <td><input type="text" class="form-control" name="date_of_update" value="{{$userData->date_of_update}}" disabled></td>
                        </tr>
                        <tr>
                            <td>Address 1</td>
                            <td><input type="text" class="form-control" name="address1" value="{{$userData->address1}}"></td>
                        </tr>
                        <tr>
                            <td>Address 2</td>
                            <td><input type="text" class="form-control" name="address2" value="{{$userData->address2}}"></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td><input type="text" class="form-control" name="city" value="{{$userData->city}}"></td>
                        </tr>
                        <tr>
                            <td>Zip</td>
                            <td><input type="text" class="form-control" name="zip" value="{{$userData->zip}}"></td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td><input type="text" class="form-control" name="country" value="{{$userData->country}}"></td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>
                                    <select name="roles" id="selector1" class="form-control1">
                                       @foreach($roles as $role)
                                        <option value='{{$role->id_role}}'
                                                @if($role->id_role == $userData->role_id)
                                                    selected=selected
                                                @endif                                            
                                                >{{$role->role_name}}</option>
                                       @endforeach
                                    </select>                        
                            </td>
                        </tr>
                        <tr>
                            <td>User Status</td>
                            <td>
                                    <select name="statuses" id="selector1" class="form-control1">
                                       @foreach($statuses as $status)
                                        <option value='{{$status->id_user_status}}'
                                                @if($status->id_user_status == $userData->user_status_id)
                                                    selected=selected
                                                @endif
                                                >{{$status->status_name}}</option>
                                       @endforeach
                                    </select>                        
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align='center'>
                                <button type="submit" class="btn btn-success">Edit User</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align='center'>
                                <a href="{{route('modifyUsersView')}}">Back to all users</a>
                            </td>
                        </tr>
                </table>
        </form>
        </div>
        @if($userData->role_name=="User")
            <div class="sign-up-row  widget-shadow form-group">
                 <form class="form-horizontal" action="{{route('addUserFunds', ["id" => $userData->id_user])}}" method="POST">
                     {{csrf_field()}}
                     <div class="form-group">
                         <label for="focusedinput" class="col-sm-4 control-label">Current credit</label>
                         <div class="col-sm-8">
                             <h3>{{$userData->amount}}</h3>
                         </div>
                     </div>

                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-4 control-label">Add User Funds</label>
                        <div class="col-sm-4">
                            <div class="text-danger">
                                <input class="form-control1" name="credits_amount" type="number" id="charge_amount_input" min="0">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" id="btn_charge_customer" class="btn btn-primary">Add Funds</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-4 control-label">Adding Funds Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="transaction_details"  placeholder="Enter detailed transaction details" id="transaction_details"></textarea>
                        </div>
                    </div>
                 </form>
            <div class="clearfix"></div>
            </div>
        @endif
    </div>
    @if($userData->role_name=="User")
    <div class="col-md-8">
                <div class="sign-up-row  widget-shadow form-group">
                    <table class="table">
                        <h2>Orders History</h2>
                        @if($serviceHistory->isEmpty())
                            <br>
                            <div class="alert alert-warning" role="alert">
                                There aren't any previous history records
                            </div>
                        @else
                            <table class="table">
                                <tr>
                                    <td>Service Order #</td>
                                    <td>Service Name</td>
                                    <td>Service Category</td>
                                    <td>Order Date</td>
                                    <td>Service Order Status</td>
                                    <td>More Details</td>
                                <tr>
                                @foreach($serviceHistory as $serviceItem)
                                    <tr>
                                        <td>{{$serviceItem->id_order_service}}</td>
                                        <td>{{$serviceItem->service_name}}</td>
                                        <td>{{$serviceItem->service_category_name}}</td>
                                        <td>{{$serviceItem->date_of_order}}</td>
                                        <td>{{$serviceItem->order_service_status_name}}</td>
                                        <td>
                                            <a href="{{route('orderServiceView', ['id'=> $serviceItem->id_order_service])}}"><button type="button" class="btn btn-primary">View Service Order</button></a>
                                        </td>
                                    <tr>
                                @endforeach
                            </table>
                        @endif

                    </table>

                </div>

                <div class="sign-up-row  widget-shadow form-group">
                    <table class="table">
                        <h2>Credits History</h2>
                            @if($creditData->isEmpty())
                            <br>
                            <div class="alert alert-warning" role="alert">
                            There isn't credit history for this user
                            </div>
                                @else
                                <table class="table">
                                    <tr>
                                        <td>Transaction #</td>
                                        <td>Amount</td>
                                        <td>Comment</td>
                                        <td>Date</td>
                                    <tr>
                                    @foreach($creditData as $creditItem)
                                        <tr>
                                            <td>{{$creditItem->id_credit_transaction}}</td>
                                            <td>{{$creditItem->transaction_amount}}</td>
                                            <td>{{$creditItem->transaction_comment}}</td>
                                            <td>{{$creditItem->transaction_date}}</td>
                                        <tr>
                                    @endforeach
                                </table>
                                @endif
                    </table>
                </div>
    </div>
    @endif
    <div class='clearfix'></div>    
</div>

@endsection
