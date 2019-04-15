<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Session;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // query select berdasarkan role applicant
        // $users= User::whereHas('roles',function($query){
        //     $query->where('name','Applicant');
        // })->orderBy('created_at','desc')->get();
        // return view('dashboard-admin')->with('users', $users);

        $users= User::where('status','unread')->paginate(10);
        return view('dashboard-admin')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     /** manage CV */
    public function create()
    {
        //** query select berdasarkan role applicant */ 
        $users= User::whereHas('roles',function($query){
            $query->where('name','Applicant');
        })->orderBy('created_at','desc')->paginate(10);
        return view('manage-cv')->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicantRequest $request)
    {
        
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
        return view('detail-user')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
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
        // dd($request->all());
        $user = User::find($id);
        if ($request->input('status') == 'accepted'){
            $user->reason = null;
            $user->status = $request->input('status');

        } else {
            $user->reason = $request->input('reason');
            $user->status = $request->input('status');
        }
        $user->save();

        Session::flash("notice", "Your form is success updated");
        return redirect()->route('admin.create', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        Session::flash("notice", "Article success deleted");
        return redirect()->route("admin.manage_user");
    }

    /** Sort by status pada manage-cv.blade.php */
    public function status(Request $request)
    {
        // dd($request->all());
        if ($request->action == 'unread'){
            $users= User::where('status','unread')->get();
        } elseif ($request->action == 'accepted'){
            $users= User::where('status','accepted')->get();
        } elseif ($request->action == 'rejected'){
            $users= User::where('status','rejected')->get();
        } else {
            $users= User::whereHas('roles',function($query){
                $query->where('name','Applicant');
            })->orderBy('created_at','desc')->get();
        }
        return view('manage-cv')->with('users', $users);
    }

    /** menampilkan PDF */
    public function pdf($id)
    {
        /** show pdf */
        $user= User::where('id',$id)->first();
        $cv = public_path($user->cv);
        // return $user;
        return response()->file($cv);
    }

    /** download PDF */
    public function download($id)
    {
        /** show pdf */
        $user= User::where('id',$id)->first();
        $cv = public_path($user->cv);
        // return $user;
        return response()->download($cv);
    }

    /** Manage User */
    public function manage_user()
    {
        //** query select berdasarkan role applicant */ 
        $users= User::whereHas('roles',function($query){
            $query->where('name','Applicant');
        })->orderBy('created_at','desc')->paginate(10);
        return view('manage-user')->with('users', $users);
    }
}
