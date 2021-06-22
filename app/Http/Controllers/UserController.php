<?php

namespace App\Http\Controllers;

use App\User;
use App\Penjualan;
use Hash;
use App\Imports\BarangsImport;
use App\Imports\PenjualanImport;
use App\Exports\BarangsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Validator;
use Session;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->except('_method','_token','submit');
      $validator = Validator::make($request->all(), [
         'name'  => 'required|string|min:4|max:50',
         'email' => 'required|unique:users|email|max:50',
         'role'  => 'required',
         'password' => 'required|string',
      ]);

      if ($validator->fails()) {
         return redirect()->Back()->withInput()->withErrors($validator);
      }

      if($record = User::firstOrCreate($data)){
         Session::flash('success', 'Data Berhasil Ditambahkan!');
         Session::flash('alert-class', 'alert-success');
         return redirect()->route('pengguna');
      }else{
         Session::flash('message', 'Data Gagal Tersimpan!');
         Session::flash('alert-class', 'alert-danger');
      }

      return Back();
    }

    public function changePassword(Request $request,$id)
    {
        $data = $request->except('_method','_token','submit');

        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'new_password' => 'confirmed|max:8|different:password',
        ]);

        if ($validator->fails()) {
            return redirect()->Back()->withInput()->withErrors($validator);
        }

        $user = User::find($id);
        
        if (Hash::check($request->password, $user->password)) { 
           $user->fill([
            'password' => Hash::make($request->new_password)
            ])->save();

            Session::flash('success', 'Data Berhasil Diperbarui!');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('pengguna');
        }

        return Back();
    }


    public function show($id)
    {
        $user = User::find($id);
        $users = User::all();
        return view('user.show', compact('user','users'));
    }


    public function edit(Barang $barang)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $data = $request->except('_method','_token','submit');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|string|min:3',
        ]);

        if ($validator->fails()) {
            return redirect()->Back()->withInput()->withErrors($validator);
        }
        $subject = User::find($id);

        if($subject->update($data)){
            Session::flash('success', 'Data Berhasil Diperbarui!');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('pengguna');
        }else{
            Session::flash('message', 'Data Gagal Diperbarui!');
            Session::flash('alert-class', 'alert-danger');
        }

        return Back()->withInput();
    }


    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('success', 'Data Berhasil Dihapus! ',200);
    }
}
