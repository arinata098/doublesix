<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    public function index()
    {
        // data position
        $positions = Position::all();

        return view('admin.master.position.index', [
            'title' => 'Position',
            'positions' => $positions,
            'section' => 'Position',
            'desc' => 'This page is used to edit the master position data',
            'active' => 'Master Data'
        ]);
    }

    public function create()
    {
        return view('admin.master.position.create', [
            'title' => 'Position',
            'section' => 'Position',
            'desc' => 'This page is used to edit the master position data',
            'active' => 'Master Data'
        ]);
    }

    public function store(Request $request)
    {
        // validasi input yang didapatkan dari request
        $validator = Validator::make($request->all(), [
            'position_name' => 'required|string|max:255',
            'position_desc' => 'required',
        ]);

        // kalau ada error kembalikan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // simpan data ke database
        try {
            DB::beginTransaction();

            // insert ke tabel positions
            Position::create([
                'positionName' => $request->position_name,
                'description' => $request->position_desc
            ]);

            DB::commit();

            return redirect('/admin/position')->with('createSuccess', 'Data created successfully.');

        } catch(Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return redirect()->back()->with('createFailed', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $position = Position::find($id);

        if (!$position) {
            return redirect()->back()->with('errorDatanotfound', 'Data not found');
        }

        return view('admin.master.position.edit', [
            'title' => 'Position',
            'position' => $position,
            'desc' => 'This page is used to edit the master position data',
            'section' => 'Position',
            'active' => 'Master Data'
        ]);
    }

    public function update(Request $request, $id)
    {
        $position = Position::find($id);

        if (!$position) {
            return redirect()->back()->with('errorDatanotfound', 'Data not found');
        }

        try{
            $position->positionName = $request->position_name;
            $position->description = $request->position_desc;
            // Lakukan update sesuai dengan kolom yang ingin diubah
            // ...

            $position->save();

            return redirect('/admin/position')->with('successUpdate', 'Updated successfully');
        } catch(Exception $e) {
            dd($e);
            return redirect()->back()->with('failedUpdate', 'Updated failed');
        }
        
    }

    public function destroy($id)
    {

        // Cari data pengguna berdasarkan ID
        $position = Position::find($id);

        try {
            // Hapus data pengguna
            $position->delete();
            return redirect()->back()->with('successDelete', 'Berhasil menghapus user');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorDelete', $e->getMessage());
        }
    }
}
