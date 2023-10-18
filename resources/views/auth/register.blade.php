@extends('layouts.app')
@section('title','Registration')
@section('content')

   <!--Registration form-->
<div class="main_con">
    <div class="container">
        <div class="main">
            <div class="col-md-4"></div>
            <div class="form-div">
                <div class="card form-holder">
                    <div class="card-body">
                        <h1>Register</h1>

                        @if (Session::has('error'))
                            <p class="text-danger">{{ Session::get('error') }}</p>
                        @endif

                        <form action="{{ route('register.data') }}" method="post" id="form_id">
                            @csrf
                           <!--Input fields of form-->
                            <div class="form-group">
                                <label>First name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First name" />
                                @if ($errors->has('first_name'))
                                    <p class="text-danger">{{ $errors->first('first_name') }}</p>
                                @endif
                                <p class="text-danger" id="first_name_err"></p>
                            </div>

                            <div class="form-group">
                                <label>Last name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last name" />
                                @if ($errors->has('last_name'))
                                    <p class="text-danger">{{ $errors->first('last_name') }}</p>
                                @endif
                                <p class="text-danger" id="last_name_err"></p>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Email" />
                                @if ($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                @endif
                                <p class="text-danger" id="email_check"></p>
                                <p class="text-danger" id="email_err"></p>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password" />
                                @if ($errors->has('password'))
                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                @endif
                                <p class="text-danger" id="pass_err"></p>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" id="confirm_password" class="form-control"
                                    placeholder="Password Confirmation" />
                                @if ($errors->has('password_confirmation'))
                                    <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                                @endif
                                <p class="text-danger" id="pass_match"></p>
                                <p class="text-danger" id="con_pass_err"></p>
                            </div>


                            <div class="col-4 text-right mt-2 d-flex">
                                <input type="submit" class="btn btn-primary mr-3" value=" Register " />
                                <span class="m-1"></span>
                                <a href="{{ route('login') }}" class="btn btn-info">Login</a>
                            </div>
                            <!--End Input fields of form-->
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
    <!--End Registration form-->

@endsection

@push('scripts')

<script>

    // Form validation logic from client side,if anyone turn off javascript from browser then server side validation error message will work


    document.getElementById('form_id').addEventListener('submit',function(event){
            let first_name = document.getElementById('first_name').value;
            let last_name = document.getElementById('last_name').value;
            let password = document.getElementById('password').value;
            let confirm_password = document.getElementById('confirm_password').value;
            let email = document.getElementById('email').value;
            let emailCheck = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // First and Last name check
            if(first_name==''){
                event.preventDefault();
                document.getElementById('first_name_err').innerHTML="First name should have value";
            }
            if(last_name==''){
                event.preventDefault();
                document.getElementById('last_name_err').innerHTML="Last name should have value";
            }
            // Email and email format
            if(email==''){
                event.preventDefault();
                document.getElementById('email_err').innerHTML="Email should have value";
            }else if(!emailCheck.test(email)){
                event.preventDefault();
                document.getElementById('email_check').innerHTML="Email is not valid";
            }
            // Password and password confirmation check
            if(password==''){
                event.preventDefault();
                document.getElementById('pass_err').innerHTML="Password should have value";
            }
            if(confirm_password==''){
                event.preventDefault();
                document.getElementById('con_pass_err').innerHTML="Confirm password should have value";
            }else if(password != confirm_password){
                event.preventDefault();
                document.getElementById('pass_match').innerHTML="Password and confirm password should be same";
            }
             // End Form validation logic from client side
    })

</script>

@endpush
