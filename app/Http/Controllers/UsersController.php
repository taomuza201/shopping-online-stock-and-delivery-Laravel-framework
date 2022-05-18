<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return view('users.index', compact('users'));
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
    public function store(Request $request)
    {

        // return User::create([
        //     'name' => $request['name'],
        //     'email' => $request['email'],
        //     'position' => $request['position'],
        //     'password' => Hash::make($request['password']),
        // ]);

        $data = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'position' => $request['position'],
            'password' => Hash::make($request['password']),
        ]);

        $newdata = ['', $data->name, $data->email, $data->position, '<center><button type="button"
        class="btn btn-primary btn-sm" data-id="'.$data->id.'">แก้ไขข้อมูล</button>
    <button type="button" class="btn btn-danger btn-sm" data-id="'.$data->id.'"  data-email="'.$data->email.'">ลบข้อมูล</button> </center>', ];

        return   redirect()->back();
        // return $newdata;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $data = User::find($id);

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->position = $request->position;
 

        if($request->password !=''){
            $data->password =  Hash::make($request->password);
        }
        $data->save();


        return Redirect::back();
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();

        return  redirect()->back();
    }
}
