@include('components.back.head')


			<div class="main-page login-page ">
                            @include('components.back.displayMessages')    
				<h2 class="title1">Login</h2>
				<div class="widget-shadow">
					<div class="login-body">
						<form action="{{route('adminCheck')}}" method="POST">
                                                    {{csrf_field()}}
							<input type="email" class="user" name="email" placeholder="Enter Your Email" value='{{old('email')}}' >
							<input type="password" name="password" class="lock" placeholder="Password" value='{{old('password')}}' >
							<input type="submit" name="Sign In" value="Sign In">
						</form>
					</div>
				</div>
				
			</div>


@include('components.back.foot')