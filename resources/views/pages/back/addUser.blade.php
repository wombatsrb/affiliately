@extends('layouts.admin')

@section('content')
                
    <div class="main-page signup-page">
            @include('components.back.displayMessages')
            <h2 class="title1">Register User</h2>
            <div class="sign-up-row widget-shadow">
                    <h5>Personal Information :</h5>
            <form action="{{route('addUser')}}" method="POST">
                {{csrf_field()}}
                    <div class="sign-u">
                                            <input name="name" placeholder="First Name" required="" type="text" value='{{old('name')}}'>
                            <div class="clearfix"> </div>
                    </div>
                    <div class="sign-u">
                                            <input name="surname" placeholder="Last Name" required="" type="text" value='{{old('surname')}}'>
                            <div class="clearfix"> </div>
                    </div>
                    <div class="sign-u">
                                            <input name="email" placeholder="Email Address" required="" type="email" value='{{old('email')}}'>
                            <div class="clearfix"> </div>
                    </div>
                    <div class="sign-u">
                                            <input name="username" placeholder="Username" required="" type="text" value='{{old('username')}}'>
                            <div class="clearfix"> </div>
                    </div>
                    <div class="sign-u">
                                            <input name="address1" placeholder="Address 1" required="" type="text" value='{{old('address1')}}'>
                            <div class="clearfix"> </div>
                    </div>
                    <div class="sign-u">
                                            <input name="address2" placeholder="Address 2" type="text" value='{{old('address2')}}'>
                            <div class="clearfix"> </div>
                    </div> 
                    <div class="sign-u">
                                            <input name="city" placeholder="City" required="" type="text" value='{{old('city')}}'>
                            <div class="clearfix"> </div>
                    </div>
                    <div class="sign-u">
                                            <input name="zip" placeholder="Zip" required="" type="text" value='{{old('zip')}}'>
                            <div class="clearfix"> </div>
                    </div>              
                    <div class="sign-u">
                                            <input name="country" placeholder="Country" required="" type="text" value='{{old('country')}}'>
                            <div class="clearfix"> </div>
                    </div>                    
                    <div class="sign-u">
                                            <input name="password" placeholder="Password" required="" type="password" value='{{old('password')}}'>
                            <div class="clearfix"> </div>
                    </div>
                    <div class="sign-u">
                                            <input name="password_confirmation" placeholder="Confirm Password" required="" type="password" value='{{old('password_confirmation')}}'>
                            </div>
                            <div class="clearfix"> </div>
                    <div>
                            <label for="roles" class="col-sm-2 control-label">Role</label>
                            <div class="col-sm-10 sign-u">
                                <select name="roles" id="selector1" class="form-control1">
                                   @foreach($roles as $role)
                                    <option value='{{$role->id_role}}'>{{$role->role_name}}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="clearfix"> </div> 
                    </div>
                    <div>
                            <label for="statuses" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10 sign-u">
                                <select name="statuses" id="selector1" class="form-control1">
                                   @foreach($statuses as $status)
                                    <option value='{{$status->id_user_status}}'>{{$status->status_name}}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="clearfix"> </div> 
                    </div>
                                                   
                    <div class="sub_home">
                                    <input name='addUser' value="Add User" type="submit">
                            <div class="clearfix"> </div>
                    </div>
            </form>
            </div>
    </div>

@endsection
