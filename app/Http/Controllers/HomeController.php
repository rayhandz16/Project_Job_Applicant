<?php

namespace App\Http\Controllers;
use App\Http\Requests\ApplicantRequest;
use Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // $request->user()->authorizeRoles(['applicant',
        // 'admin']);
        // return view('home');

        if ($request->user()->hasRole('admin')) {
            return redirect()->route('admin.index');
        } elseif ($request->user()->hasRole('applicant')) {
            if (is_null($request->user()->address)||is_null($request->user()->phone)) {
            return redirect()->route('applicants.edit',Auth::id());
            }
            return view('profile-applicant')->with('user',Auth::user());
        }
    }
}
