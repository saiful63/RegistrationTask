@extends('layouts.app')
@section('title','Home')
@section('admin_content')

<div class="container mt-5">
        <div class="card">
            @if(Session::has('msg'))
               <p class="alert alert-success">{{ Session::get('msg') }}</p>
            @endif
            <div class="card-header">
                 @if(auth()->user()->hasRole('Admin'))
                 <span class=" my-4"> User info table</span>
                 @endif

                 <span class="ml-3 btn btn-success">Logged in user: {{ Auth::user()->first_name." ".Auth::user()->last_name}}</span>
                 @if(auth()->user()->can('create_user'))
                   <span><a href="{{route('user.role')}}" class="btn btn-primary my-4">Manage role</a></span>
                 @endif
                 @if(auth()->user()->can('create_user'))
                   <span><a href="{{ route('user.create.interface') }}" class="btn btn-primary my-4">Create user</a></span>
                 @endif

                 <a href="{{ route('logout') }}" class="btn btn-danger my-4">Logout</a>
                 <a href="{{ route('profile.get') }}" class="btn btn-danger my-4">profile</a>
                <div class="card-body">
                    @if(auth()->user()->hasRole('Admin'))
                    <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>Action</th>


                        </tr>
                    </thead>

                    <tbody>
                      @foreach ($users as $user)
                       <tr>

                           <td>{{ $user->first_name }}</td>
                           <td>{{ $user->last_name }}</td>
                           <td>{{ $user->email }}</td>
                           <td>Edit</td>

                       </tr>
                       @endforeach
                    </tbody>
                    </table>
                    @endif



                </div>
            </div>
        </div>
    </div>
@endsection

