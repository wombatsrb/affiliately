@include('components.back.head')


			<div class="main-page login-page ">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        <ul>
                                                <li>{{ session()->get('error') }}</li>
                                        </ul>
                                    </div>
                                @endif                                

                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        <ul>
                                                <li>{{ session()->get('success') }}</li>
                                        </ul>
                                    </div>
                                @endif  

                                @if(session()->has('user'))
                                    <div class="alert alert-success">
                                        <ul>
                                                <li>{{ session()->get('user')->id_user }}</li>
                                        </ul>
                                    </div>
                                @endif                                 
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