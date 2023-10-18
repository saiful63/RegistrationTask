@extends('layouts.app')
@section('title','User role')
@section('admin_content')
  <div class="container-fluid">
    <div class="row justify-content-center">
       <div class="col-md-8 mt-5">

        {{-- Assign role to specific user --}}

        <div class="card mt-5">
            <div class="card-header">
            <h4>Assign user to role</h4>

            </div>



            <div class="card-body">
                <form action="{{ route('role.assign') }}" method="post" id="form">
                    @csrf
                    @if (Session::has('success'))
                            <p class="text-info">{{ Session::get('success') }}</p>
                     @endif
                <div class="row">

                        <div class="col-md-2">
                        <span ><a href="{{ route('home') }}" class="btn btn-primary">Home</a></span>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select" id="user" name="user_id">
                                <option value="0">Select user</option>
                                @foreach ($users as $user)

                                    <option value="{{ $user->id }}" >{{ $user->first_name }}</option>
                                @endforeach


                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select" id="role" name="role_id">
                                <option value="0">Select role</option>
                                @foreach ($roles as $role)
                                  <option value="{{ $role->id }}" >{{ $role->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-sm btn-primary w-50">Assign</button>
                        </div>

                        </div>
                    </form>
                </div>



            </div>

            {{-- End Assign role to specific user --}}

        {{-- Remove specific role from user --}}

        <div class="card mt-5">
          <div class="card-body">

            @if (Session::has('role_remove'))
                <p class="text-info">{{ Session::get('role_remove') }}</p>
            @endif
                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>Role id</th>
                            <th>User id</th>
                            <th>Role</th>
                            <th>User</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($assigned_users_get_role as $items)


                        @foreach ($items->users as $user)
                        <tr>
                            <td>{{ $items->id }}</td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $items->name }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td> <a href="{{ route('remove.role',['role_id'=>$items->id,'user_id'=>$user->id]) }}" class="btn btn-primary">Remove assigned role</a> </td>
                        </tr>

                        @endforeach


                    @endforeach
                   </tbody>
                    </table>


          </div>
        </div>

        {{-- End Remove specific role from user --}}


       </div>
    </div>
  </div>
@endsection





