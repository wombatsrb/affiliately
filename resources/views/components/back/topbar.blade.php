<!-- header-starts -->

		{{-- dd($pendingOrders) --}}

		<div class="sticky-header header-section ">
			<div class="header-left">
				<div class="profile_details_left"><!--notifications of menu start -->
					<ul class="nofitications-dropdown">

						{{-- za workera --}}
						@if(session()->get('user')->role_id == 3)
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">{{ count($unreadMessages) }}</span></a>
							<ul class="dropdown-menu">

							@if($unreadMessages->isNotEmpty())
								<li>
									<div class="notification_header">
										<h3>You have {{ count($unreadMessages) }} new messages</h3>
									</div>
								</li>
								@foreach($unreadMessages as $message)
									<li><a href="{{route('orderServiceView', ['id' => $message->order_service_id])}}">
									   <div class="user_img"><img src="" alt=""></div>
									   <div class="notification_desc">
										<p>{{ $message->message }}</p>
										<p><span>{{ $message->date_of_comment }}</span></p>
										</div>
									   <div class="clearfix"></div>
									</a></li>
								@endforeach
							@else
								<li>
									<div class="notification_header">
										<h3>No unread messages!</h3>
									</div>
								</li>
							@endif
							</ul>
						</li>

						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1">{{ count($allocatedServices) }}</span></a>
							<ul class="dropdown-menu">

								@if($allocatedServices->isNotEmpty())
									<li>
										<div class="notification_header">
											<h3>You have {{ count($allocatedServices) }} started works</h3>
										</div>
									</li>

									@foreach($allocatedServices as $service)
										<li><a href="{{route('orderServiceView', ['id' => $service->id_order_service])}}">
												<div class="user_img"><img src="" alt=""></div>
												<div class="notification_desc">
													<p><b>{{ $service->service_name }}</p>
													<p><span>{{ $service->service_description }}</span></p>
												</div>
												<div class="clearfix"></div>
										</a></li>
									@endforeach
								@else
									<li>
										<div class="notification_header">
											<h3>No started works!</h3>
										</div>
									</li>
								@endif
							</ul>
						</li>
						@endif
						{{-- za admina --}}
						@if(session()->get('user')->role_id == 2)
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">{{ count($pendingOrders) }}</span></a>
							<ul class="dropdown-menu">

								@if($pendingOrders->isNotEmpty())
								<li>
									<div class="notification_header">
										<h3>You have {{ count($pendingOrders) }} pending orders</h3>
									</div>
								</li>
								@foreach($pendingOrders as $order)
								<li><a href="{{route('orderView', ['id' => $order->id_order])}}">
									<div class="user_img"><img src="" alt=""></div>
								   	<div class="notification_desc">
									<p><b>Customer:</b> {{ $order->name }} {{ $order->surname }}</p>
									<p><span>{{ $order->date_of_order }}</span></p>
									</div>
								  <div class="clearfix"></div>	
								 </a></li>
								@endforeach
								@else
									<li>
										<div class="notification_header">
											<h3>No pending orders!</h3>
										</div>
									</li>
								@endif
								 <li>
									<div class="notification_bottom">
										<a href="{{ route('ordersView') }}">See all orders</a>
									</div>
								</li>
							</ul>
						</li>
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1">{{ count($waitingAllocation) }}</span></a>
							<ul class="dropdown-menu">
								@if($waitingAllocation->isNotEmpty())
									<li>
										<div class="notification_header">
											<h3>You have {{ count($waitingAllocation) }} services waiting for allocation</h3>
										</div>
									</li>
									@foreach($waitingAllocation as $service)
										<li><a href="{{route('orderServiceView', ['id' => $service->id_order_service])}}">
												<div class="user_img"><img src="" alt=""></div>
												<div class="notification_desc">
													<p><b>{{ $service->service_name }}</p>
													<p><span>{{ $service->service_description }}</span></p>
												</div>
												<div class="clearfix"></div>
											</a></li>
									@endforeach
								@else
									<li>
										<div class="notification_header">
											<h3>No pending services!</h3>
										</div>
									</li>
								@endif
							</ul>
						</li>
						@endif
						{{--
						@if((session()->get('user')->role_id == 2) || (session()->get('user')->role_id == 3))
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1">8</span></a>
							<ul class="dropdown-menu">
								<li>
									<div class="notification_header">
										<h3>You have 8 pending task</h3>
									</div>
								</li>
								<li><a href="#">
									<div class="task-info">
										<span class="task-desc">Database update</span><span class="percentage">40%</span>
										<div class="clearfix"></div>	
									</div>
									<div class="progress progress-striped active">
										<div class="bar yellow" style="width:40%;"></div>
									</div>
								</a></li>
								<li><a href="#">
									<div class="task-info">
										<span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
									   <div class="clearfix"></div>	
									</div>
									<div class="progress progress-striped active">
										 <div class="bar green" style="width:90%;"></div>
									</div>
								</a></li>
								<li><a href="#">
									<div class="task-info">
										<span class="task-desc">Mobile App</span><span class="percentage">33%</span>
										<div class="clearfix"></div>	
									</div>
								   <div class="progress progress-striped active">
										 <div class="bar red" style="width: 33%;"></div>
									</div>
								</a></li>
								<li><a href="#">
									<div class="task-info">
										<span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
									   <div class="clearfix"></div>	
									</div>
									<div class="progress progress-striped active">
										 <div class="bar  blue" style="width: 80%;"></div>
									</div>
								</a></li>
								<li>
									<div class="notification_bottom">
										<a href="#">See all pending tasks</a>
									</div> 
								</li>
							</ul>
						</li>
						@endif
						--}}
					</ul>
					<div class="clearfix"> </div>
				</div>
				<!--notification menu end -->
				<div class="clearfix"> </div>
			</div>
			<div class="header-right">
				
				
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<span class="prfil-img"><img src="" alt=""> </span>
									<div class="user-name">
										<p>{{ session()->get('user')->name }}</p>
										<span>{{ session()->get('user')->role_name }}</span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
								<li> <a href="#"><i class="fa fa-user"></i> My Account</a> </li>
								<li> <a href="#"><i class="fa fa-suitcase"></i> Profile</a> </li> 
								<li> <a href="{{route('adminLogout')}}"><i class="fa fa-sign-out"></i> Logout</a> </li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
		</div>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
