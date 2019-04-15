@extends('layouts.app')
@section('title','dashboard')

@section('content')
<div class="mx-5">
    <div class="row">
        <div class="col-2 border border-white">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active text-light" href="{{route('admin.index')}}">-> Dashboard</a>
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
            <form action="{{route('admin.status')}}" method="get" class="">
                <div class="d-flex justify-content-start mb-1">
                    <div class="pl-3">
                        <h5 class="">Manage User</h5>
                    </div>
                    {{-- <div class="ml-3"> --}}
                        
                    {{-- </div> --}}
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-sm">
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
                        <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            {{-- <td>{{$loop->iteration}}</td> --}}
                            <td>{{$loop->iteration}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->dateofbirth}}</td>
                            <td>{{$user->gender}}</td>
                            <td>{{$user->maritalstatus}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->address}}</td>
                            <td>
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle badge badge-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Manage User
                                        </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{route('admin.show',$user->id)}}">Detail</a>
                                        <form action="{{route('admin.destroy',$user->id)}}" method="post">
                                            {{csrf_field()}} 
                                            {{method_field('DELETE')}}
                                            <button type="submit" class="dropdown-item">Delete</button>
                                        </form>
                                    </div>
                                </div>
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

<script>
$(function(){
  
  $(".dropdown-menu a").click(function(){
    
    $(".btn:first-child").text($(this).text());
     $(".btn:first-child").val($(this).text());
  });

});
</script>

@endsection