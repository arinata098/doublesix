<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\Position;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        // data user
        $users = User::with('department', 'position')->get();

        return view('admin.master.user.index', [
            'title' => 'User',
            'users' => $users,
            'section' => 'User',
            'desc' => 'This page is used to edit the master user data',
            'active' => 'Master Data'
        ]);
    }

    public function create()
    {
        $departmentCollection = Department::all();
        $positionCollection = Position::all();

        return view('admin.master.user.create', [
            'title' => 'User',
            'section' => 'User',
            'departmentCollection' => $departmentCollection,
            'positionCollection' => $positionCollection,
            'desc' => 'This page is used to edit the master user data',
            'active' => 'Master Data'
        ]);
    }

    public function store(Request $request)
    {
        
        // validasi input yang didapatkan dari request
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'user_level' => 'required',
            'user_position' => 'required',
            'user_department' => 'required',
            'email' => 'required|string|max:255|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // kalau ada error kembalikan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // cek kalau ada user status
        if ($request->user_status){
            $status = 1;
        } else {
            $status = 0;
        }

        // simpan data ke database
        try {
            DB::beginTransaction();

            // insert ke tabel departments
            User::create([
                'name' => $request->user_name,
                'email' => $request->email,
                'is_admin' => $request->user_level,
                'status' => $status,
                'idDept' => $request->user_department,
                'idPosition' => $request->user_position,
                'password' => Hash::make($request->password),
            ]);

            DB::commit();

            return redirect('/admin/user')->with('createSuccess', 'Data created successfully.');

        } catch(Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $user = User::with('department', 'position')->find($id);

        if (!$user) {
            return redirect()->back()->with('errorDatanotfound', 'Data not found');
        }

        $departmentCollection = Department::all();
        $positionCollection = Position::all();

        return view('admin.master.user.edit', [
            'title' => 'User',
            'user' => $user,
            'departmentCollection' => $departmentCollection,
            'positionCollection' => $positionCollection,
            'desc' => 'This page is used to edit the master user data',
            'section' => 'User',
            'active' => 'Master Data'
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('errorDatanotfound', 'Data not found');
        }

        // cek kalau ada user status
        if ($request->user_status){
            $status = 1;
        } else {
            $status = 0;
        }

        try{
            $user->name = $request->user_name;
            $user->email = $request->email;
            $user->is_admin = $request->user_level;
            $user->status = $status;
            $user->idDept = $request->user_department;
            $user->idPosition = $request->user_position;
            if ($request->has('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            return redirect('/admin/user')->with('successUpdate', 'Updated successfully');
        } catch(Exception $e) {
            dd($e);
            return redirect()->back()->with('failedUpdate', 'Updated failed');
        }
        
    }

    public function destroy($id)
    {

        // Cari data pengguna berdasarkan ID
        $position = User::find($id);

        try {
            // Hapus data pengguna
            $position->delete();
            return redirect()->back()->with('successDelete', 'Berhasil menghapus user');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorDelete', $e->getMessage());
        }
    }
}
