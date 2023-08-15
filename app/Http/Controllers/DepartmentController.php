<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;



class DepartmentController extends Controller
{
    public function index()
    {
        // data department
        $Departs = Department::paginate(5);

        return view('admin.master.department.index', [
            'title' => 'Department',
            'departs' => $Departs,
            'section' => 'Department',
            'desc' => 'This page is used to edit the master department data',
            'active' => 'Master Data'
        ]);
    }

    public function create()
    {
        return view('admin.master.department.create', [
            'title' => 'Department',
            'section' => 'Department',
            'desc' => 'This page is used to edit the master department data',
            'active' => 'Master Data'
        ]);
    }

    public function store(Request $request)
    {
        // validasi input yang didapatkan dari request
        $validator = Validator::make($request->all(), [
            'department_name' => 'required|string|max:255',
            'department_desc' => 'required',
        ]);

        // kalau ada error kembalikan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // simpan data ke database
        try {
            DB::beginTransaction();

            // insert ke tabel departments
            Department::create([
                'deptName' => $request->department_name,
                'description' => $request->department_desc
            ]);

            DB::commit();

            return redirect('/admin/department')->with('createSuccess', 'Data created successfully.');

        } catch(Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return redirect()->back()->with('createFailed', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return redirect()->back()->with('errorDatanotfound', 'Data not found');
        }

        return view('admin.master.department.edit', [
            'title' => 'Department',
            'department' => $department,
            'desc' => 'This page is used to edit the master department data',
            'section' => 'Department',
            'active' => 'Master Data'
        ]);
    }

    public function update(Request $request, $id)
    {
        $department = Department::find($id);

        if (!$department) {
            return redirect()->back()->with('errorDatanotfound', 'Data not found');
        }

        try{
            $department->deptName = $request->department_name;
            $department->description = $request->department_desc;
            // Lakukan update sesuai dengan kolom yang ingin diubah
            // ...

            $department->save();

            return redirect('/admin/department')->with('successUpdate', 'Updated successfully');
        } catch(Exception $e) {
            dd($e);
            return redirect()->back()->with('failedUpdate', 'Updated failed');
        }
        
    }

    public function destroy($id)
    {

        // Cari data pengguna berdasarkan ID
        $department = Department::find($id);

        try {
            // Hapus data pengguna
            $department->delete();
            return redirect()->back()->with('successDelete', 'Berhasil menghapus user');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorDelete', $e->getMessage());
        }
    }
}
