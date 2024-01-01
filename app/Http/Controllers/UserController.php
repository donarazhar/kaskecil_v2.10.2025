<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->get();
        return view('pages.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        try {
            $hashedPassword = Hash::make($password);

            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $hashedPassword,
            ];

            $simpan = DB::table('users')->insert($data);
            if ($simpan) {
                return Redirect::back()->with(['success' => 'Data berhasil disimpan']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data gagal disimpan']);
        }
    }


    public function edit(Request $request)
    {
        $id = $request->id;
        $users = DB::table('users')->where('id', $id)->first();
        return view('pages.users.edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        try {
            $hashedPassword = Hash::make($password);

            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $hashedPassword,
            ];

            $update = DB::table('users')->where('id', $id)->update($data);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data berhasil diupdate']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data gagal diupdate']);
        }
    }

    public function destroy($id)
    {
        try {
            $user = DB::table('users')->where('id', $id)->first();

            if ($user) {
                $delete = DB::table('users')->where('id', $id)->delete();

                if ($delete) {
                    return Redirect::back()->with(['success' => 'Data berhasil dihapus']);
                } else {
                    return Redirect::back()->with(['warning' => 'Data gagal dihapus']);
                }
            } else {
                return Redirect::back()->with(['warning' => 'User tidak ditemukan']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }


    public function resetPassword($id)
    {
        // $this->authorize('isAdmin', User::class);
        $user = DB::table('users')->where('id', $id)->first();
        return view('pages.users.reset_password', ['user' => $user]);
    }

    public function UpdatePassword(Request $request, $id)
    {
        // $this->authorize('isAdmin', User::class);
        $user = DB::table('users')->where('id', $id)->first();
        $user->update([
            'password' => $request->kata_sandi_baru,
        ]);

        Alert::success('Sukses', "Kata sandi {$user->email} sukses direset");
        return redirect()->back();
    }
}
