<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index()
    {
        //Eager loading in Controller but have to bliding relationship in Model before.
        // $ideas = Idea::with('user','comments.user')->orderBy('created_at', 'DESC');
        $users = User::orderBy('name', 'ASC');
        $user_count = User::all()->count();

        //where content like %test%
        if (request()->has('search')) {

            $users = $users->where('name', 'like', '%' . request()->get('search','') . '%')
                                    ->orWhere('nickname', 'like', '%' . request()->get('search') . '%')
                                    ->orWhere('username', 'like', '%' . request()->get('search') . '%');
        }

        return view('users.index', [
            'users' => $users->paginate(15),
            'user_count' => $user_count,
            ]);
    }
    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(5);
        return view('users.show',compact('user','ideas'));
    }

    public function form()
    {

        return view('users.add');
    }

    public function store(Request $request,User $user)
    {
        $data = [
            'name' => $request->input('name'),
            'nickname' => $request->input('nickname'),
            'position' => $request->input('position'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'is_active' => $request->input('is_active'),

        ];

        $user = User::create($data);

        return redirect()->route('users.index')->with('success', 'เพิ่มข้อมูล ผู้ใช้ เรียบร้อยแล้ว!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $editing = true;

        return view('users.edit',compact('user','editing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,User $user)
    {
        $data = [
            'name' => $request->input('name'),
            'nickname' => $request->input('nickname'),
            'position' => $request->input('position'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'is_active' => $request->input('is_active'),

        ];

        $user->update($data);

        return redirect()->route('users.edit',$user->id)->with('success','แก้ไขข้อมูล ผู้ใช้ เรียบร้อยแล้ว!');
    }
    public function profile(){

        return $this->show(auth()->user());
    }
}
