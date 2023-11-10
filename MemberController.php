<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function insertform() //form input
    {
        return view('customer/add_member');
    }
    public function insertmember(Request $request) // method insert member
    {
        $name = $request->input('name');
        $alamat = $request->input('alamat');
        $no_hp = $request->input('no_hp');
        $data=array('name'=>$name,"alamat"=>$alamat,"no_hp"=>$no_hp,);
        DB::table('customer')->insert($data);
        echo "<script>alert('Record inserted successfully');</script>"; 
        return view('home.cuci');
    }
    public function index_view_member() // method view member
    {
        $users = DB::select('select * from customer');
        return view('customer/view_member',['users'=>$users]);
    }
    public function destroy($id) //method hapus member
    {
        DB::delete('delete from customer where id = ?',[$id]);
        return redirect()->back();
    }  
    public function show($id) //menampilkan data yang ingin di update
    {
        $users = DB::select('select * from customer where id = ?',[$id]);
        return view('Customer/update_member',['users'=>$users]);
    }
    public function edit(Request $request,$id) // method edit data
    {
        $name = $request->input('name');
        $alamat = $request->input('alamat');
        $no_hp = $request->input('no_hp');
        DB::table('customer')->where('id',$id)->update(array(
            'name'=>$name,
            'alamat'=>$alamat,
            'no_hp'=>$no_hp,
        ));
        echo "<script>alert('Record updated successfully');</script>"; 
        return view('home.cuci');
    }
    

}
