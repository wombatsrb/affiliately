@extends('layouts.admin')
@section('content')
    <div class="col-md-12">
        <div class="col-md-4">
            <div class="sign-up-row  widget-shadow form-group">
                <h1>Service Order Details</h1>
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-4 control-label">Customer Name:</label>
                        <div class="col-sm-8">
                            {{$orderServiceData->customer_name . ' ' . $orderServiceData->customer_surname}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-4 control-label">Customer Email:</label>
                        <div class="col-sm-8">
                            {{$orderServiceData->customer_email}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-4 control-label">Service Name:</label>
                        <div class="col-sm-8">
                            {{$orderServiceData->service_name}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-4 control-label">Service Description:</label>
                        <div class="col-sm-8">
                            {{$orderServiceData->service_description}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-4 control-label">Service Category:</label>
                        <div class="col-sm-8">
                            {{$orderServiceData->service_category_name}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-4 control-label">Service Type:</label>
                        <div class="col-sm-8">
                            {{$orderServiceData->service_type_name}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-4 control-label">Service Price:</label>
                        <div class="col-sm-8">
                            $ {{$orderServiceData->service_price}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-4 control-label">Ordered Quantity:</label>
                        <div class="col-sm-8">
                            {{$orderServiceData->quantity}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-4 control-label">Date of Adding:</label>
                        <div class="col-sm-8">
                            {{$orderServiceData->date_of_adding}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-4 control-label">Date of Update:</label>
                        <div class="col-sm-8">
                            {{$orderServiceData->date_of_update}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-4 control-label">Service Order Status:</label>
                        <div class="col-sm-8">
                            <select id='order_service_status' name="order_service_status" class="form-control">
                                @foreach($orderStatuses as $status)
                                    <option value="{{$status->id_order_service_status}}"
                                            @if($status->id_order_service_status==$orderServiceData->order_service_status_id)
                                            selected="selected"
                                            @endif
                                    >{{$status->order_service_status_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-4 control-label">Allocated Worker:</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="worker_select" name="worker_select">
                                <option value="">Worker not allocated!</option>
                                @foreach($allWorkers as $worker)
                                    <option value="{{$worker->id_user}}"
                                            @if($worker->id_user == $orderServiceData->worker_id)
                                            selected="selected"
                                            @endif
                                    > {{$worker->username}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-4 control-label">Charge User</label>
                        <div class="col-sm-4">
                            <div class="text-danger">
                                <input class="form-control1" type="number" id="charge_amount_input" min="0">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <a href="#" id="btn_charge_customer" class="btn btn-primary" role="button">Charge Customer</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-4 control-label">Charge Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" placeholder="Enter detailed transaction details" id="transaction_details"></textarea>
                        </div>
                    </div>
                    <br>
                </form>
                <div class="alert alert-danger" id="errorMessage">
                </div>
                <div class="alert alert-success" id="successMessage">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="sign-up-row  widget-shadow form-group">
                <h1>Service Charging History</h1>
                <br>
                <table class="table" id="chargeHistory">
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div id="message-div" class="sign-up-row  widget-shadow form-group">
                <div class="card card-contact-list" id="messagesBox">
                    <div class="agileinfo-cdr" id="messageBox2">
                        <div class="card-header">
                            <h3>Service Order Messages</h3>
                        </div>
                        <hr class="widget-separator">
                        <div class="card-body p-b-20">
                            <div class="list-group">
                                <div id="scroll" class="messages">
                                @foreach($messages as $message)
                                    @if($message->user_id != session()->get('user')->id_user)
                                        <div class="messageLeft list-group-item media">
                                            <div class="pull-left">
                                                <img class="lg-item-img" src="{{asset('/')}}images/w.png" width="50px" align="left" alt=""><br>
                                                <div class="lg-item-heading" align="left">{{$message->name}} - <i>{{$message->role_name}}</i></div><br>
                                                <small><i>{{date("d/m/Y G:i", strtotime($message->date_of_comment))}}</i></small>
                                            </div>
                                            <div class="media-body">
                                                <div class="pull-left">
                                                    <small class="lg-item-text">
                                                        {{$message->message}}
                                                    </small>

                                                </div>
                                            </div>

                                        </div>

                                        <hr>
                                    @else
                                        <div class="messageRight list-group-item media">
                                            <div class="pull-right">
                                                <img class="lg-item-img" src="{{asset('/')}}images/y.png" align="right" width="50px" alt=""><br>
                                                <div class="lg-item-heading" align="right">You</div><br>
                                                <small><i>{{date("d/m/Y G:i", strtotime($message->date_of_comment))}}</i></small>
                                            </div>
                                            <div class="media-body">
                                                <div class="pull-left">
                                                    <small class="lg-item-text">
                                                        {{$message->message}}
                                                    </small>
                                                </div>
                                            </div>

                                        </div>
                                        <hr>
                                    @endif
                                @endforeach
                                </div>
                                    <div class="panel-default">
                                        <div class="panel-body">
                                            <form class="com-mail">
                                                <textarea rows="4" name="messageText" id="messageText" class="form-control1 control1" min="2" max="1000" placeholder="Message :"></textarea>
                                                <button name="sendMessage" id="sendMessage" type="button" class="btn btn-primary">Send Message</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <script>
        const token = '{{ csrf_token() }}';
        const baseURL = "{{ asset('/') }}";
        var message = "";
        $(document).ready(function(){
            const serviceOrderId = '{{$orderServiceData->id_order_service}}';
            const userId = '{{session()->get('user')->id_user}}';

            //Charge Customer for Service Order
            $('#btn_charge_customer').on('click', function(){

                var credits_amount = $('#charge_amount_input').val();
                var transaction_details = $('#transaction_details').val();
                var userId = '{{$orderServiceData->customer_id}}';


                if(credits_amount==null || credits_amount==0){
                    alert('Please enter amount to charge');
                }
                else if(transaction_details=="" || transaction_details==null || transaction_details.length<10){
                    alert('Please enter transaction details - at least 10 characters');
                }
                else{
                    var r = confirm("Are you sure that you want to charge customer?");
                    if (r == true) {
                        $.ajax({
                            type: "POST",
                            url: baseURL + "admin/order/service/charge" ,
                            data: {_token: token, credits_amount: credits_amount, transaction_details: transaction_details, userId: userId, serviceOrderId: serviceOrderId },
                            success: function (data) {
                                $('#errorMessage').css('display', 'none');
                                $('#successMessage').css('display', 'block');
                                $('#successMessage').html(data);
                                showChargingHistory(serviceOrderId);
                            },
                            error: function (data) {
                                var errors = data.responseJSON;
                                $('#successMessage').css('display', 'none');
                                $('#errorMessage').css('display', 'block');
                                $('#errorMessage').html(errors.message);
                            }

                        });
                    }
                }

            });

            // Order Status Update
            $('#order_service_status').on('change', function(){
                var service_status_id = $('#order_service_status').val();
                $.ajax({
                    type: "POST",
                    url: baseURL + "admin/order/service/status/" + serviceOrderId,
                    data: {_token: token, service_status_id: service_status_id },
                    success: function (data) {
                        console.log(data);
                        $('#errorMessage').css('display', 'none');
                        $('#successMessage').css('display', 'block');
                        $('#successMessage').html(data);
                    },
                    error: function (data) {
                        var errors = data.responseJSON;
                    }

                });
            });

            // Worker select update
            $('#worker_select').on('change', function(){
                var workerId = $('#worker_select').val();
                $.ajax({
                    type: "POST",
                    url: baseURL + "admin/order/service/worker/" + serviceOrderId,
                    data: {_token: token, workerId: workerId },
                    success: function (data) {
                        $('#errorMessage').css('display', 'none');
                        $('#successMessage').css('display', 'block');
                        $('#successMessage').html(data);
                    },
                    error: function (data) {
                        var errors = data.responseJSON;
                        $('#successMessage').css('display', 'none');
                        $('#errorMessage').css('display', 'block');
                        $('#errorMessage').html(errors.message);
                    }

                });
            });

            //Send Message
            $('#sendMessage').on('click', function(){
                var messageText = $('#messageText').val();
                if(messageText.length<2){
                    alert('Message should contain more than 2 characters');
                }
                else{
                    $.ajax({
                        type: "POST",
                        url: baseURL + "order/service/message/" + serviceOrderId,
                        data: {_token: token, userId: userId, messageText: messageText },
                        success: function (data) {
                            console.log(data);
                            updateDiv();
                        },
                        error: function (data) {
                            var errors = data.responseJSON;
                        }

                    });
                }

            });

            // Show charging history for Ordered Service
            function showChargingHistory(serviceOrderId){
                $.ajax({
                    type: "POST",
                    url: baseURL + "admin/order/service/charge/history/" + serviceOrderId,
                    data: {_token: token },
                    success: function (data) {
                        var htmlOutput = `<tr>
                       <td>Transaction #</td>
                       <td>Amount</td>
                       <td>Comment</td>.
                       <td>Date</td>
                   <tr>`;
                        var dataObj = JSON.parse(data);
                        jQuery.each(dataObj, function(key, value){
                            htmlOutput += `<tr>
                       <td>${dataObj[key].id_credit_transaction}</td>
                       <td>${dataObj[key].transaction_amount}</td>
                       <td>${dataObj[key].transaction_comment}</td>.
                       <td>${dataObj[key].transaction_date}</td>
                   <tr>`;
                        });

                        $('#chargeHistory').html(htmlOutput);
                    },
                    error: function (data) {
                        var errors = data.responseJSON;
                        //$('#errorMessage').html(errors.message);
                    }

                });
            }

            // Load messages
            function updateDiv()
            {
                $( ".messages" ).load(window.location.href + " .messages" );
            }


            showChargingHistory(serviceOrderId);

            var objDiv = $('#scroll');
            if (objDiv.length > 0){
                objDiv[0].scrollTop = objDiv[0].scrollHeight;
            }
        });
    </script>
@endsection