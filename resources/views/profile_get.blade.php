@extends('layouts.app')
@section('title','User role')
@section('admin_content')
  <div class="container-fluid">
    <div class="row justify-content-center">

       <div class="col-md-8 mt-5">

        {{-- User profile start--}}
        <div class="card mt-5">
          <div class="card-header">
            <span>User profile</span>
            <span ><a href="{{ route('home') }}" class="btn btn-primary">Home</a></span>
          </div>
          <div class="card-body">

                <table class="table table-bordered table-striped">
                    @if (Session::has('success'))
                            <p class="text-success">{{ Session::get('success') }}</p>
                    @endif
                    <form action="{{ route('update.profile') }}" method="post">
                        @csrf

                        <input type="hidden" name="user_id" value="{{ $user_profile->id }}">
                        <tr>
                            <th>First Name</th>
                            <td> <input type="text" name="fn" value="{{ $user_profile->first_name }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <th>Last Name</th>
                            <td><input type="text" name="ln" value="{{ $user_profile->last_name }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td><input type="text" name="em" value="{{ $user_profile->email }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" class="btn btn-primary" value="Upadet Info"></td>


                        </tr>

                    </form>



                    </table>


          </div>
        </div>

        {{-- End User profile start--}}


       </div>
    </div>
  </div>
@endsection





