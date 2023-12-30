<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ResetPasswordUsersRequest;
use Illuminate\Support\Facades\DB;
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
        // $this->authorize('isAdmin', User::class);
        // $users = User::where('level', '!=', 'admin')->get();
        // return view('pages.users.index', ['users' => $users]);
        $users = User::all();
        return view('pages.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('isAdmin', User::class);
        $users = User::first();
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $level = $request->level;

        try {
            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'level' => $level
            ];

            $simpan = DB::table('users')->insert($data);
            if ($simpan) {
                return Redirect::back()->with(['success' => 'Data berhasil disimpan']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data gagal disimpan']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $this->authorize('isAdmin', User::class);

        $user = User::findOrFail($id);

        return view('pages.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        // $this->authorize('isAdmin', User::class);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level

        ]);

        Alert::success('Sukses', 'Data user berhasil diupdate');
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        Alert::success('Sukses', "User dengan name {$user->name} berhasil dihapus");
        return redirect()->back();
    }

    public function resetPassword($id)
    {
        // $this->authorize('isAdmin', User::class);
        $user = User::findOrFail($id);
        return view('pages.users.reset_password', ['user' => $user]);
    }

    public function UpdatePassword(ResetPasswordUsersRequest $request, $id)
    {
        // $this->authorize('isAdmin', User::class);
        $user = User::findOrFail($id);
        $user->update([
            'password' => $request->kata_sandi_baru,
        ]);

        Alert::success('Sukses', "Kata sandi {$user->email} sukses direset");
        return redirect()->back();
    }
}
