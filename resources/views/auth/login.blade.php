@extends('layouts.app')
@section('title','Registration')
@section('content')

   <!--Login form-->
<div class="main_con">
    <div class="container">
        <div class="main">
            <div class="col-md-4"></div>
            <div class="form-div">
                <div class="card form-holder">
                    <div class="card-body">
                        <h1>Login</h1>

                        @if (Session::has('error'))
                            <p class="text-danger">{{ Session::get('error') }}</p>
                        @endif

                        <form action="{{ route('login') }}" method="post" id="form_id">
                            @csrf
                           <!--Input fields of form-->
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
                            <div class="col-4 text-right mt-2">
                                <input type="submit" class="btn btn-primary" value=" Login " />
                            </div>
                            <!--End Input fields of form-->
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
    <!--End Login form-->

@endsection

@push('scripts')

<script>

    // Form validation logic from client side,if anyone turn off javascript from browser then server side validation error message will work


    document.getElementById('form_id').addEventListener('submit',function(event){
            let password = document.getElementById('password').value;
            let email = document.getElementById('email').value;
            let emailCheck = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

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

             // End Form validation logic from client side
    })

</script>

@endpush
