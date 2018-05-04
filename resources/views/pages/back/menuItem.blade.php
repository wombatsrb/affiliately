@extends('layouts.admin')

@section('content')
    @include('components.back.displayMessages')
   
    <div class="bd-example">
            <div class="col-md-4"></div>
            <div class="col-md-4 table-responsive widget-shadow">
                <form class="form-horizontal" action="{{route('editMenu', ['id' => $menuItemData->id_menu])}}" method="POST" >
                    {{csrf_field()}}
                    <h2 class="text-center" style="padding:20px">Edit Menu Item</h2>                   
                        <div class="form-group">
                          <label class="control-label col-sm-4" for="email">Menu Item Name:</label>
                          <div class="col-sm-8">
                            <input type="text" name="menu_name" class="form-control" value="{{$menuItemData->menu_name}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-4" for="email">Priority:</label>
                          <div class="col-sm-8">
                            <input type="text" name="menu_priority" class="form-control" value="{{$menuItemData->menu_priority}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-4" for="email">Menu Parent:</label>
                          <div class="col-sm-8">
                            <select name="menu_parent" id="selector1" class="form-control1">
                                <option value=''>No parent</option>                                
                               @foreach($notParentMenu as $menuItem)
                                <option value='{{$menuItem->id_menu}}'>{{$menuItem->menu_name}}</option>
                               @endforeach
                            </select>                          
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-4" for="email">Menu Icon:</label>
                          <div class="col-sm-8">
                            <input type="text" name="menu_icon" class="form-control" value="{{$menuItemData->menu_icon}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-4" for="email">URL:</label>
                          <div class="col-sm-8">
                            <input type="text" name="url" class="form-control" value="{{$menuItemData->url}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-12" align="center">
                              <button type="submit" class="btn btn-primary btn-sm">Edit Menu</button><br><br>
                            <a href="{{route('viewMenu')}}"> Go Back </a>
                          </div>
                        </div>                              
                     
                        
                </form>                
            </div>
            <div class="col-md-4"></div>
            <div class="clearfix"></div>
    </div>
@endsection

