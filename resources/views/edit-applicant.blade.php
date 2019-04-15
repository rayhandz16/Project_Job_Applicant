@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-dark bg-light mb-3">
                <div class="card-header">Applicant Form</div>

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

                    <form method="post" enctype="multipart/form-data" action="{{route('applicants.update',$user->id)}}">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="form-group row">
                            <label for="inputname" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" id="inputEmail" name="email" value="{{$user->email}}">
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputdateofbirth" class="col-sm-3 col-form-label">Date of Birth</label>
                            <div class="col-sm-9">
                              <input type="date" class="form-control" id="dateofbirth" name="dateofbirth" value="{{$user->dateofbirth}}">
                            </div>
                        </div>
                        <fieldset class="form-group">
                          <div class="row">
                            <legend class="col-form-label col-sm-3 pt-0">Gender</legend>
                            <div class="col-sm-9">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="male" {{$user->gender == "male" ? "checked":""}}>
                                <label class="form-check-label" for="gridRadios1">
                                  Male
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="female" {{$user->gender == "female" ? "checked":""}}>
                                <label class="form-check-label" for="gridRadios3">
                                  Female
                                </label>
                              </div>
                            </div>
                          </div>
                        </fieldset>
                        <div class="form-group row">
                            <label for="inputmaritalstatus" class="col-sm-3 col-form-label">Marital Status</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="maritalstatus" name="maritalstatus" placeholder="singel/married" value="{{$user->maritalstatus}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputphone" class="col-sm-3 col-form-label">Phone Number</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="phone" name="phone" value="{{$user->phone}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputaddress" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="address" name="address" value="{{$user->address}}">
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputfile" class="col-sm-3 col-form-label">Input CV</label>
                          <div class="input-group col-sm-9">
                            <div class="custom-file ">
                              {{-- rule input vc 1 kali kecuali rejected dan kosong--}}
                              @if ($user->status == "unread" || $user->status == "accepted")
                              <input type="file" class="custom-file-input" id="inputGroupFile02" name="cv" disabled>
                              <label class="custom-file-label text-truncate" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02" disabled>{{!empty($user->cv) ? $user->cv:"Choose file"}}</label>
                              @else
                              <input type="file" class="custom-file-input" id="inputGroupFile02" name="cv">
                              <label class="custom-file-label text-truncate" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">{{!empty($user->cv) ? $user->cv:"Choose file"}}</label>
                              @endif
                                {{-- {{!empty($user->cv) ? $user->cv:"Choose file"}}--}}
                            </div>
                            {{-- <div class="input-group-append">
                              <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                            </div> --}}
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>
                      
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#inputGroupFile02').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
</script>
@endsection
