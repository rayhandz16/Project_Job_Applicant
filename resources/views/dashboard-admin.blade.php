@extends('layouts.app')
@section('title','dashboard')

@section('content')
<div class="mx-5">
    <div class="row">
        <div class="col-2 border border-white">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active text-light" href="#" >-> Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="{{route('admin.create')}}">-> Manage CV</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="{{route('admin.manage_user')}}">-> Manage User</a>
            </li>
          </ul>
        </div>
        <div class="col-10">
          <div class="d-flex align-items-end justify-content-between mb-1">
            <p class="mb-0 pl-3 h5">Applicant</p>
          </div>
          <div class="table-responsive">
            <table class="table table-condensed table-striped">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col" class="text-truncate">Date of Birth</th>
                  <th scope="col">Gender</th>
                  <th scope="col" class="text-truncate">Marital Status</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Address</th>
                  <th scope="col">CV</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($users as $user)
                <tr>
                  {{-- <td>{{$loop->iteration}}</td> --}}
                  <td>{{$user->id}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->dateofbirth}}</td>
                  <td>{{$user->gender}}</td>
                  <td>{{$user->maritalstatus}}</td>
                  <td>{{$user->phone}}</td>
                  <td>{{$user->address}}</td>
                  <td>
                    <label for="" >{{$user->cv}}</label>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>  
          <div class="mt-2 float-right"> {{$users->links()}} </div>
        </div>
      </div>
    </div>  
@endsection
