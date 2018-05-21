@extends('layouts.admin')

@section('content')       
    <div class="main-page signup-page">
            @include('components.back.displayMessages')
            <h2 class="title1">Edit Service</h2>
            <div class="sign-up-row widget-shadow">
                    <h5>Service Information :</h5>
            <form action="{{route('editService', ['id' =>  $serviceData->id_service])}}" method="POST">
                {{csrf_field()}}
                    <div class="sign-u">
                                            <input name="name" placeholder="Service Name" required="" type="text" value="{{$serviceData->service_name}}">
                            <div class="clearfix"> </div>
                    </div>
                    <div>                     
                                            <textarea name="description" required="" class="form-control" placeholder="Service Description" style="height: 80px; margin-bottom: 20px;">{{$serviceData->service_description}}</textarea>
                            <div class="clearfix"> </div>
                    </div>
                    <div class="sign-u">
                                            <input name="price" placeholder="Service Price" required="" type="text" value="{{$serviceData->service_price}}">
                            <div class="clearfix"> </div>
                    </div>
                    <div>
                            <label for="category" class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-10 sign-u">
                                <select name="category" id="selector1" class="form-control1">
                                   @foreach($categories as $category)
                                    <option value='{{$category->id_service_category}}'
                                            @if($category->id_service_category == $serviceData->service_category_id)
                                                    selected=selected
                                            @endif
                                            >{{$category->service_category_name}}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="clearfix"> </div> 
                    </div>
                    <div>
                            <label for="status" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10 sign-u">
                                <select name="status" id="selector1" class="form-control1">
                                    <option value='0'
                                            @if($serviceData->service_status ==0)
                                            selected=selected
                                            @endif
                                            >Disable</option>
                                    <option value='1'
                                            @if($serviceData->service_status ==1)
                                            selected=selected
                                            @endif                                            
                                            >Enable</option>
                                </select>        
                            </div>
                            <div class="clearfix"> </div>
                    </div>
                    <div>
                            <label for="type" class="col-sm-2 control-label">Type</label>
                            <div class="col-sm-10 sign-u">
                                <select name="type" id="selector1" class="form-control1">
                                   @foreach($types as $type)
                                    <option value='{{$type->id_service_type}}'
                                            @if($type->id_service_type == $serviceData->service_type_id)
                                                    selected=selected
                                            @endif
                                            >{{$type->service_type_name}}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="clearfix"> </div> 
                    </div>
                                                   
                    <div class="sub_home">
                                    <input name='editService' value="Edit Service" type="submit">

                                    <span>
                                        <a href="{{route('modifyServiceView')}}">Back to all services</a>
                                    </span>
                            <div class="clearfix"> </div>
                    </div>
            </form>
            </div>
    </div>

@endsection
