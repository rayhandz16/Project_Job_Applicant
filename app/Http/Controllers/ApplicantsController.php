<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApplicantRequest;
use App\User;
use Session;


class ApplicantsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:applicant');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicantRequest $request)
    {
        dd($request);
        // $applicant = new Applicant;

        // if($request->hasFile('cv')){
        // $file = $request->file('cv');
        // $destination_path = 'uploads/';
        // $filename = str_random(6).'_'.$file->getClientOriginalName();
        // $file->save($destination_path.$filename);
        // $applicant->file = $destination_path . $filename;
        // }
        
        // // save applicant data into database //
        // $applicant->name = $request->input('name');
        // $applicant->email = $request->input('email');
        // $applicant->dateofbirth = $request->input('dateofbirth');
        // $applicant->gender = $request->input('gender');
        // $applicant->maritalstatus = $request->input('maritalstatus');
        // $applicant->phone = $request->input('phone');
        // $applicant->address = $request->input('address');
        // $applicant->status = "waiting";
        // $applicant->save();
        // Session::flash("notice", "applicant success created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('profile-applicant')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('edit-applicant')->with('user', $user);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validasi

        $messages = [
            'dateofbirth.before' => 'Only above 17th years old could apply !!',
        ];

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'dateofbirth' => 'required|before:2002-04-10',
            'gridRadios'=>'required',
            'maritalstatus'=>'required',
            'phone'=>'required',
            'address'=>'required'
        ],$messages);
           
        // dd($request->all());
        $user = User::find($id);

        if($request->hasFile('cv')){
        $file = $request->file('cv');
        $destination_path = 'uploads/';
        $filename = str_random(6).'_'.$file->getClientOriginalName();
        $file->move($destination_path,$filename);
        $user->cv = $destination_path.$filename;
        }
        
        // save user data into database //
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->dateofbirth = $request->input('dateofbirth');
        $user->gender = $request->input('gridRadios');
        $user->maritalstatus = $request->input('maritalstatus');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->status = "unread";
        $user->save();

        Session::flash("notice", "Your form is success updated");
        return redirect()->route("applicants.show", $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
