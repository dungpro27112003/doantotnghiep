<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Đăng nhập hoặc Đăng ký</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="{{ asset('template/user/assets/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/user/assets/font-awesome/css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('template/user/assets/css/form-elements.css') }}">
        <link rel="stylesheet" href="{{ asset('template/user/assets/css/style.css') }}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('template/user/assets/ico/apple-touch-icon-144-precomposed.png') }}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('template/user/assets/ico/apple-touch-icon-72-precomposed.png') }}">
        <link rel="apple-touch-icon-precomposed" href="{{ asset('template/user/assets/ico/apple-touch-icon-57-precomposed.png') }}">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                	
                    {{-- <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Bootstrap</strong> Login &amp; Register Forms</h1>
                            <div class="description">
                            	<p>
	                            	This is a free responsive <strong>"login and register forms"</strong> template made with Bootstrap. 
	                            	Download it on <a href="http://azmind.com" target="_blank"><strong>AZMIND</strong></a>, 
	                            	customize and use it as you like!
                            	</p>
                            </div>
                        </div>
                    </div> --}}
                    
                    <div class="row">
                        
                        <div class="col-sm-5" style="border: 1px solid">
                        	
                        	<div class="form-box" style="margin:20px 0px">
                                @if (session('errorlogin'))
                                    <div class="alert alert-danger">
                                        {{ session('errorlogin') }}
                                    </div>
                                @endif
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Đăng nhập</h3>
	                            		<p>Nhập email và mật khẩu để đăng nhập:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-key"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form  action="{{ route('signin') }}" method="POST" >
                                        @csrf
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form_email_signin">E-MAIL</label>
				                        	<input type="text" name="form_email_signin" placeholder="E-MAIL..." value="{{ old('form_email_signin') }}" class="form-email form-control" id="form_email_signin">
                                            @error('form_email_signin')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form_password_signin">Password</label>
				                        	<input type="password" name="form_password_signin"  placeholder="Password..." class="form-password form-control" id="form_password_signin">
                                            @error('form_password_signin')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
				                        </div>
				                        <button type="submit" class="btn">Đăng nhập</button>
				                    </form>
			                    </div>
		                    </div>
		                
		                	{{-- <div class="social-login">
	                        	<h3>...or login with:</h3>
	                        	<div class="social-login-buttons">
		                        	<a class="btn btn-link-1 btn-link-1-facebook" href="#">
		                        		<i class="fa fa-facebook"></i> Facebook
		                        	</a>
		                        	<a class="btn btn-link-1 btn-link-1-twitter" href="#">
		                        		<i class="fa fa-twitter"></i> Twitter
		                        	</a>
		                        	<a class="btn btn-link-1 btn-link-1-google-plus" href="#">
		                        		<i class="fa fa-google-plus"></i> Google Plus
		                        	</a>
	                        	</div>
	                        </div> --}}
	                        
                        </div>
                        
                        <div class="col-sm-2 middle-border" style="font-size: 70px">&</div>
                        {{-- <div class="col-sm-1"></div> --}}
                        	
                        <div class="col-sm-5" style="border:1px solid">
                        	
                        	<div class="form-box" style="margin:20px 0px">
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Đăng ký</h3>
	                            		<p>Điền thông tin vào form để đăng ký:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-pencil"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form  action="{{ route('signup') }}" method="POST" >
                                        @csrf
                                        <div class="form-group">
				                        	<label class="sr-only" for="form_name">Name</label>
				                        	<input type="text" name="form_name" placeholder="Name..." class="form-name form-control" id="form-name">
                                            @error('form_name')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form_email">Email</label>
				                        	<input type="text" name="form_email" placeholder="Email..." class="form-email form-control" id="form-email">
                                            @error('form_email')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
				                        	<label class="sr-only" for="form_password">Password</label>
				                        	<input type="password" name="form_password" placeholder="Password..." class="form-password form-control" id="form_password">
                                            @error('form_password')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
				                        	<label class="sr-only" for="form_repassword">Repassword</label>
				                        	<input type="password" name="form_repassword" placeholder="Repassword..." class="form-password form-control" >
                                        </div>
				                        <button type="submit" class="btn">Đăng ký!</button>
				                    </form>
			                    </div>
                        	</div>
                        	
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>

        <!-- Footer -->
        <footer>
        	<div class="container">
        		<div class="row">
        			
        			<div class="col-sm-8 col-sm-offset-2">
        				<div class="footer-border"></div>
        				<p>Shared by <i class="fa fa-love"></i><a href="https://bootstrapthemes.co">BootstrapThemes</a></p>
        			</div>
        			
        		</div>
        	</div>
        </footer>

        <!-- Javascript -->
        <script src="{{ asset('template/user/assets/js/jquery-1.11.1.min.js') }}"></script>
        <script src="{{ asset('template/user/assets/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('template/user/assets/js/jquery.backstretch.min.js') }}"></script>
        <script src="{{ asset('template/user/assets/js/scripts.js') }}"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>
