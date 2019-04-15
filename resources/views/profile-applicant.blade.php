@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-9">
                            Your Profile Form
                        </div>
                        <div class="col-3">
                            <label for="status" class="">status :</label>
                            @if ($user->status == 'unread')
                                <label for="status" class="text-warning" data-toggle="tooltip" data-placement="" title="Your application letter has not been read."> {{$user->status}}</label>
                            @elseif ($user->status == 'accepted')
                                <label for="status" class="text-success" data-toggle="tooltip" data-placement="" title="Your application letter has been received."> {{$user->status}}</label>
                            @elseif ($user->status == 'rejected')
                                <label for="status" id="tool_tip" class="tool_tip text-danger" data-toggle="tooltip" data-placement="bottom" title="{{$user->reason}}"> {{$user->status}}</label>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- menampilkan error validasi --}}
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                        <div class="form-group row">
                            <label for="inputname" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" id="inputEmail" name="email" value="{{$user->email}}" disabled>
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputdateofbirth" class="col-sm-3 col-form-label">Date of Birth</label>
                            <div class="col-sm-9">
                              <input type="date" class="form-control" id="dateofbirth" name="dateofbirth" value="{{$user->dateofbirth}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputgender" class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="gender" name="gender" value="{{$user->gender}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputmaritalstatus" class="col-sm-3 col-form-label">Marital Status</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="maritalstatus" name="maritalstatus" placeholder="singel/married" value="{{$user->maritalstatus}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputphone" class="col-sm-3 col-form-label">Phone Number</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="phone" name="phone" value="{{$user->phone}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputaddress" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="address" name="address" value="{{$user->address}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormControlFile1"  class="col-sm-3 col-form-label">Input CV</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control-file" id="cv" name="cv" value="{{$user->cv}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-9d">
                            <a class="btn" href="{{route('applicants.edit',$user->id)}}">Edit</a>
                          </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.tool_tip').tooltip({trigger:'manual'}).tooltip('show');
</script>
@endsection