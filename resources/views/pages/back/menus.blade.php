@extends('layouts.admin')

@section('content')
    @include('components.back.displayMessages')
    <form method="POST" action="{{route('addMenu')}}">
    {{ csrf_field() }}

<div class="table-responsive bs-example widget-shadow">
    <br>
    <h3 align="center">Add Menu Item</h3>
    <br>
    <div class=" col-md-12">
    <table class="table table-bordered"> 
        <thead> 
            <tr> 
                <th>#</th> 
                <th>Menu Item Name</th> 
                <th>Priority</th> 
                <th>Route</th> 
                <th>Icon</th>
                <th>Parent Menu</th>
                <th>Role</th>
                <th>Add</th>  
            </tr> 
        </thead> 
        <tbody> 
            
            <tr> 
                <th scope="row">new</th> 
                <td><input class="form-control" type="text" name="menu_name" value="{{old('menu_name')}}" ></td> 
                <td><input class="form-control" type="number" name="menu_priority" value="{{old('menu_priority')}}"></td> 
                <td><input class="form-control" type="text" name="url" value="{{old('url')}}"></td> 
                <td><input class="form-control" type="text" name="menu_icon" value="{{old('menu_icon')}}"></td> 
                <td>
                        <select name="menu_parent" id="selector1" class="form-control1">
                            <option value=''>No parent</option>
                           @foreach($notParentMenu as $menuItem)
                            <option value='{{$menuItem->id_menu}}'>{{$menuItem->menu_name}}</option>
                           @endforeach
                        </select>
                </td>
                <td>
                        <select name="roles" id="selector1" class="form-control1">
                           @foreach($roles as $role)
                            <option value='{{$role->id_role}}'>{{$role->role_name}}</option>
                           @endforeach
                        </select>
                </td>
                <td><button type='submit' class="form-control btn btn-success">Add</button></td>
            </tr>
        </tbody> 
    </table> 
    </div>  
</div>
</form>


<div class="table-responsive bs-example widget-shadow">
    <br>
    <h3 align="center">Menus for Admin</h3>
    <br>
    <div class=" col-md-12">
    <table class="table table-bordered"> 
        <thead> 
            <tr> 
                <th>#</th> 
                <th>Menu Item Name</th> 
                <th>Priority</th> 
                <th>Route</th> 
                <th>Icon</th>
                <th width="1%">Modify</th>
                <th width="1%">Delete</th>
            </tr> 
        </thead> 
        <tbody> 
            
            @foreach($adminMenu as $menuItem)
            <tr> 
                <th scope="row">{{ $loop->iteration  }}</th> 
                <td>{{ $menuItem->menu_name }}</td> 
                <td>{{ $menuItem->menu_priority }}</td> 
                <td>{{ $menuItem->url }}</td> 
                <td>{{ $menuItem->menu_icon }}</td> 
                <td><a href="{{route('editMenu', ['id' => $menuItem->id_menu])}}"><span class="btn btn-primary">Modify</span></a></td>
                <td><a href="{{route('deleteMenu', ['id' => $menuItem->id_menu])}}"><span class="btn btn-danger">Delete</span></a></td>
            </tr>
            @endforeach
        </tbody> 
    </table> 
    </div>  
</div>

<div class="table-responsive bs-example widget-shadow">
    <br>
    <h3 align="center">Menus for Workers</h3>
    <br>
    <div class=" col-md-12">
    <table class="table table-bordered"> 
        <thead> 
            <tr> 
                <th>#</th> 
                <th>Menu Item Name</th> 
                <th>Priority</th> 
                <th>Route</th> 
                <th>Icon</th>
                <th width="1%">Modify</th>
                <th width="1%">Delete</th>
            </tr> 
        </thead> 
        <tbody> 
            
            @foreach($workerMenu as $menuItem)
            <tr> 
                <th scope="row">{{ $loop->iteration  }}</th> 
                <td>{{ $menuItem->menu_name }}</td> 
                <td>{{ $menuItem->menu_priority }}</td> 
                <td>{{ $menuItem->url }}</td> 
                <td>{{ $menuItem->menu_icon }}</td> 
                <td><a href="{{route('editMenu', ['id' => $menuItem->id_menu])}}"><span class="btn btn-primary">Modify</span></a></td>
                <td><a href="{{route('deleteMenu', ['id' => $menuItem->id_menu])}}"><span class="btn btn-danger">Delete</span></a></td>
            </tr>
            @endforeach
        </tbody> 
    </table> 
    </div>  
</div>

<div class="table-responsive bs-example widget-shadow">
    <br>
    <h3 align="center">Menus for Users</h3>
    <br>
    <div class=" col-md-12">
    <table class="table table-bordered"> 
        <thead> 
            <tr> 
                <th>#</th> 
                <th>Menu Item Name</th> 
                <th>Priority</th> 
                <th>Route</th> 
                <th>Icon</th>
                <th width="1%">Modify</th>
                <th width="1%">Delete</th>
            </tr> 
        </thead> 
        <tbody> 
            
            @foreach($userMenu as $menuItem)
            <tr> 
                <th scope="row">{{ $loop->iteration  }}</th> 
                <td>{{ $menuItem->menu_name }}</td> 
                <td>{{ $menuItem->menu_priority }}</td> 
                <td>{{ $menuItem->url }}</td> 
                <td>{{ $menuItem->menu_icon }}</td> 
                <td><a href="{{route('editMenu', ['id' => $menuItem->id_menu])}}"><span class="btn btn-primary">Modify</span></a></td>
                <td><a href="{{route('deleteMenu', ['id' => $menuItem->id_menu])}}"><span class="btn btn-danger">Delete</span></a></td>
            </tr>
            @endforeach
        </tbody> 
    </table> 
    </div>  
</div>

@endsection
