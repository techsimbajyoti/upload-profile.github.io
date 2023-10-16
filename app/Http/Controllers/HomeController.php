<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

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
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::where('id',$id)->get();
        return view('home',compact('user'));
    }

    public function upload(Request $request)
    {
        $id = Auth::user()->id;

        $users =  User::where('id', $id)->whereNotNull('image')->exists();

        if($users == 1){
            if($request->hasfile('image')){
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,svg'
                ]);

                $user = User::where('id',$id)->get();
                
                foreach($user as $users){
                    if(file_exists(public_path('uploads/'.$users->image))){
                        unlink(public_path('uploads/'.$users->image));
                    } 
                }

                $ext = $request->file('image')->extension();
                $final_name = date('YmdHis'). '.' .$ext;
                $upload_folder = $request->file('image')->move(public_path('/uploads'), $final_name);
                $user = User::where('id',$id)->update(['image' => $final_name]);

            }

        }else{
            
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,svg'
            ]);

            $ext = $request->file('image')->extension();
            $final_name = date('YmdHis'). '.' .$ext;
            $upload_folder = $request->file('image')->move(public_path('/uploads'), $final_name);

            $user = User::where('id',$id)->update(['image' => $final_name]);
        }
        

        return redirect()->route('home');
    }

    public function delete()
    {
        $id = Auth::user()->id;
        $user = User::where('id',$id)->delete();
        return back();
    }

    public function trashed(){
        return dd(User::onlyTrashed()->latest()->get());
    }

    public function restore_user($id){
        // $id = Auth::user()->id;
        $user = User::where('id', $id)->restore();
        return response()->json($user);
    }

    public function get_result($marks){
        dd(get_results($marks));
    }
}
