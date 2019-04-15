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
                <div class="d-flex justify-content-start">
                    <p class=" pl-3 h5">Manage CV</p>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle badge badge-light ml-3" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Sort By
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <button type="submit" name="action" value="unread" class="dropdown-item" href="#">Unread</button>
                          <button type="submit" name="action" value="accepted" class="dropdown-item" href="#">Accept</button>
                          <button type="submit" name="action" value="rejected" class="dropdown-item" href="#">Reject</button>
                        </div>
                    </div>
                </div>
            </form>
        
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">CV</th>
                          <th scope="col">Manage</th>
                          <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            {{-- <td>{{$loop->iteration}}</td> --}}
                            <td>{{$loop->iteration}}</td>
                            <td>{{$user->name}}</td>
                            <td>
                              <label for="" class="text-truncate">{{$user->cv}}</label>
                            </td>
                            <td>
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle badge badge-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Kelola CV
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item" href="{{route('admin.pdf',$user->id)}}" target="blank">Show CV</a>
                                      <a class="dropdown-item" href="{{route('admin.download',$user->id)}}" target="blank">Download</a>
                                      {{-- <button type="submit" name="action" value="{{$user->id}}" class="dropdown-item" href="#">Show CV</button> --}}
                                      {{-- <button type="submit" name="action"  value="{{$user->id}}" class="dropdown-item" href="#">Download</button> --}}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <form action="{{route('admin.update',$user->id)}}" method="post" class="">
                                    {{ csrf_field() }}
                                    {{method_field('PUT')}}

                                    <div class="nav-item dropdown ml-0">
                                        @if ($user->status == 'unread')
                                            <a class="nav-link dropdown-toggle badge badge-warning" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              Unread
                                            </a>
                                        @elseif ($user->status == 'accepted')
                                            <a class="nav-link dropdown-toggle badge badge-success" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              Accept
                                            </a>
                                        @elseif ($user->status == 'rejected')
                                            <a class="nav-link dropdown-toggle badge badge-danger" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              Reject
                                            </a>
                                        @endif

                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <button type="submit" name="status" value="accepted" class="dropdown-item">Accept</button>
                                            <button type="button" class="btn_modal_reason dropdown-item" data-toggle="modal" data-target="#myModal" data-id="{{$user->id}}" data-reason="{{$user->reason}}">Reject</button>
                                        </div>

                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-2 float-right"> {{$users->links()}} </div>  
        </div>
    </div>
<!-- Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content bg-light text-body border-danger">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Insert Reason</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <form action="" method="post" class="" id="form_reason">
            {{ csrf_field() }}
            {{method_field('PUT')}}
        <!-- Modal body -->
        <div class="modal-body">
            <label for="comment">Comment:</label>
            <textarea class="form-control" rows="5" id="reason" name="reason">{{$user->reason}}</textarea>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" name="status" value="rejected" class="btn btn-danger">Save</button>
        </div>
        </form>
        
      </div>
    </div>
  </div>
<!-- End Modal -->

</div>
  
<script>

$(function(){
    
    $(".dropdown-menu a").click(function(){
        $(".btn:first-child").text($(this).text());
        $(".btn:first-child").val($(this).text());
    });

    $(".btn_modal_reason").click(function(){
      
        $("#myModal #reason").text($(this).data("reason"));
        $("#myModal #form_reason").attr("action","/admin/"+$(this).data("id"));
    });
});

</script>
@endsection