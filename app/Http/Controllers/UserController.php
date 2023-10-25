<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index(): View
    {
        $master_menu = 'user';
        $item_menu = 'user';
        $user = User::paginate(10);
        return view('admin.user', compact('user', 'master_menu', 'item_menu'));
    }

    public function store(Request $request)
    {
        try {
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' =>  $request->password,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            Alert::success('Success', 'Data Telah Terinput');
            return redirect()->back();
        } catch (QueryException $e) {
            Alert::error('Gagal', $e->errorInfo);
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            User::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' =>  $request->password,
                'updated_at' => now()
            ]);
            Alert::success('Success', 'Data Telah Terupdate');
            return redirect()->back();
        } catch (QueryException $e) {
            Alert::error('Gagal', $e->errorInfo);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        try {
            User::where('id', $request->id)->delete();
            Alert::success('Success', 'Data Telah Terhapus');
            return redirect()->back();
        } catch (QueryException $e) {
            Alert::error('Gagal', $e->errorInfo);
            return redirect()->back();
        }
    }
}
