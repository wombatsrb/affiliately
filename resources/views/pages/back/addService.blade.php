
@extends('layouts.admin')

@section('content')
                
    <div class="main-page signup-page">
            @include('components.back.displayMessages')
            <h2 class="title1">Add Service</h2>
            <div class="sign-up-row widget-shadow">
                    <h5>Service Information :</h5>
            <form action="{{route('addService')}}" method="POST">
                {{csrf_field()}}
                    <div class="sign-u">
                                            <input name="name" placeholder="Service Name" required="" type="text" value='{{old('name')}}'>
                            <div class="clearfix"> </div>
                    </div>
                    <div>                     
                                            <textarea name="description" required="" class="form-control" placeholder="Service Description" style="height: 80px; margin-bottom: 20px;" value='{{old('description')}}'></textarea>
                            <div class="clearfix"> </div>
                    </div>
                    <div class="sign-u">
                                            <input name="price" placeholder="Service Price" required="" type="text" value='{{old('price')}}'>
                            <div class="clearfix"> </div>
                    </div>
                    <div>
                            <label for="category" class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-10 sign-u">
                                <select name="category" id="selector1" class="form-control1">
                                   @foreach($categories as $category)
                                    <option value='{{$category->id_service_category}}'>{{$category->service_category_name}}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="clearfix"> </div> 
                    </div>
                    <div>
                            <label for="status" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10 sign-u">
                                <select name="status" id="selector1" class="form-control1">
                                    <option value='0'>Disable</option>
                                    <option value='1'>Enable</option>
                                </select>        
                            </div>
                            <div class="clearfix"> </div>
                    </div>
                    <div>
                            <label for="type" class="col-sm-2 control-label">Type</label>
                            <div class="col-sm-10 sign-u">
                                <select name="type" id="selector1" class="form-control1">
                                   @foreach($types as $type)
                                    <option value='{{$type->id_service_type}}'>{{$type->service_type_name}}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="clearfix"> </div> 
                    </div>
                                                   
                    <div class="sub_home">
                                    <input name='addService' value="Add Service" type="submit">
                            <div class="clearfix"> </div>
                    </div>
            </form>
            </div>
    </div>

@endsection
