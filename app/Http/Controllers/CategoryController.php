<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Department;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        // data category
        $categories = Category::with('department')->paginate(5);

        return view('admin.work.category.index', [
            'title' => 'Category',
            'categories' => $categories,
            'section' => 'Category',
            'desc' => 'This page is used to edit the master category data',
            'active' => 'Work Order'
        ]);
    }

    public function create()
    {
        $departmentCollection = Department::all();

        return view('admin.work.category.create', [
            'title' => 'Category',
            'departmentCollection' => $departmentCollection,
            'section' => 'Category',
            'desc' => 'This page is used to edit the master category data',
            'active' => 'Work Order'
        ]);
    }

    public function store(Request $request)
    {
        // validasi input yang didapatkan dari request
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
            'idDept' => 'required',
            'category_desc' => 'required',
        ]);

        // kalau ada error kembalikan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // simpan data ke database
        try {
            DB::beginTransaction();

            // insert ke tabel categorys
            Category::create([
                'cateName' => $request->category_name,
                'idDept' => $request->idDept,
                'description' => $request->category_desc
            ]);

            DB::commit();

            return redirect('/admin/category')->with('createSuccess', 'Data created successfully.');

        } catch(Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return redirect()->back()->with('createFailed', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->back()->with('errorDatanotfound', 'Data not found');
        }

        $departmentCollection = Department::all();

        return view('admin.work.category.edit', [
            'title' => 'category',
            'category' => $category,
            'departmentCollection' => $departmentCollection,
            'desc' => 'This page is used to edit the master category data',
            'section' => 'category',
            'active' => 'Master Data'
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->back()->with('errorDatanotfound', 'Data not found');
        }

        try{
            $category->cateName = $request->category_name;
            $category->idDept = $request->idDept;
            $category->description = $request->category_desc;
            // Lakukan update sesuai dengan kolom yang ingin diubah
            // ...

            $category->save();

            return redirect('/admin/category')->with('successUpdate', 'Updated successfully');
        } catch(Exception $e) {
            dd($e);
            return redirect()->back()->with('failedUpdate', 'Updated failed');
        }
        
    }

    public function destroy($id)
    {

        // Cari data pengguna berdasarkan ID
        $category = Category::find($id);

        try {
            // Hapus data pengguna
            $category->delete();
            return redirect()->back()->with('successDelete', 'Berhasil menghapus user');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorDelete', $e->getMessage());
        }
    }
}
