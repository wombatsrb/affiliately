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
                            <td colspan="2" align='center'><button type="submit" class="btn btn-success">Edit User</button></td>
                        </tr>
                </table>
        </form>
        </div>
    </div>
    <div class="col-md-1">
        
    </div>
    <div class="col-md-7">
                <div class="sign-up-row  widget-shadow form-group">
                    <table class="table">
                        <h2>Orders History</h2>
                        <br>
                        <div class="alert alert-warning" role="alert">
                          There aren't any previous history records
                        </div>
                    </table>
                </div>
    </div>
    <div class='clearfix'></div>    
</div>

@endsection
