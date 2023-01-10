<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //
    public function index()
    {
        if (is_null($this->user) || !$this->user->id == 4) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //فتح صفحة إنشاء مستخدم
    public function create()
    {
        if (is_null($this->user) || !$this->user->role == "admin") {
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        }

        
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //حفظ مستخدم جديد
    public function store(Request $request)
    {
        
        if (is_null($this->user) || !$this->user->id == 4) {
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        }

        // Validation Data

        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create New Admin
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        

        session()->flash('success', 'Admin has been created !!');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //فتح بروفايل المتستخدم
    public function profile()
    {
        $user = auth()->user();
        return view('users.profile', compact('user'));
    }


    //فتح صفحة تعديل المستخدم مع عرض بياناته
    public function edit(int $id)
    {
        if (is_null($this->user) || !$this->user->role == 'admin') {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
     //تحديث بروفايل المستخدم
    public function updateprofile(Request $request)
    {
       

        // Create New Admin
        $user = auth()->user();

        // Validation Data

        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);
       


        $user->name = $request->name;
        $user->email = $request->email;
    
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();


        session()->flash('success', 'Profile has been updated !!');
        return back();
    }
    

    //تحديث بيانات مستخدم
    public function update(Request $request, int $id)
    {
        if (is_null($this->user) || !$this->user->role == 'admin') {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        // TODO: You can delete this in your local. This is for heroku publish.
        // This is only for Super Admin role,
        // so that no-one could delete or disable it by somehow.
        if ($id === 4) {
            session()->flash('error', 'Sorry !! You are not authorized to update this Admin as this is the Super Admin. Please create new one if you need to test !');
            return back();
        }

        // Create New Admin
        $user = User::find($id);

        // Validation Data

        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);
       


        $user->name = $request->name;
        $user->email = $request->email;
    
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();


        session()->flash('success', 'Admin has been updated !!');
        return back();
    }
    


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //تحذف مستخدم
    public function destroy(int $id)
    {
        if (is_null($this->user) || !$this->user->role == 'admin') {
            abort(403, 'Sorry !! You are Unauthorized to delete any admin !');
        }

        // TODO: You can delete this in your local. This is for heroku publish.
        // This is only for Super Admin role,
        // so that no-one could delete or disable it by somehow.
        if ($id === 4) {
            session()->flash('error', 'Sorry !! You are not authorized to delete this Admin as this is the Super Admin. Please create new one if you need to test !');
            return back();
        }

        $user = User::find($id);
        if (!is_null($user)) {
            $user->delete();
        }

        session()->flash('success', 'Admin has been deleted !!');
        return back();
    }
    

    //تفتح صفحة الى مابس MAPS
    public function track(){
        
        if (auth()->user()->role  !='admin'){
            session()->flash('error', "Sorry you don't have access to this page, only Admin does");
            return redirect('/');
        }


        $users = User::all()->pluck('name','id');
        return view('users.track', compact('users'));

    }

    //تاخذ إحداثيات المستخدمين من قاعدة البيانات و ترسلها الى صفحة العرض
    public function LiveTrackingUsers($id){
        if($id=="ALL"){
            $users = User::with('tracks')->get();

        }else{
            $users = User::where('id',$id)->with('tracks')->get();

        }

        return $users;
    }
}
