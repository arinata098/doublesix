<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Exception;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        // data location
        $locations = Location::all();

        return view('admin.master.location.index', [
            'title' => 'Location',
            'locations' => $locations,
            'section' => 'Location',
            'desc' => 'This page is used to edit the master location data',
            'active' => 'Master Data'
        ]);
    }

    public function create()
    {
        return view('admin.master.location.create', [
            'title' => 'Location',
            'section' => 'Location',
            'desc' => 'This page is used to edit the master location data',
            'active' => 'Master Data'
        ]);
    }

    public function store(Request $request)
    {
        // validasi input yang didapatkan dari request
        $validator = Validator::make($request->all(), [
            'location_name' => 'required|string|max:255',
            'location_detail' => 'required',
            'location_desc' => 'required',
        ]);

        // kalau ada error kembalikan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // simpan data ke database
        try {
            DB::beginTransaction();

            // insert ke tabel locations
            Location::create([
                'locationName' => $request->location_name,
                'locationDetail' => $request->location_detail,
                'description' => $request->location_desc
            ]);

            DB::commit();

            return redirect('/admin/location')->with('createSuccess', 'Data created successfully.');

        } catch(Location $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return redirect()->back()->with('createFailed', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $location = Location::find($id);

        if (!$location) {
            return redirect()->back()->with('errorDatanotfound', 'Data not found');
        }

        return view('admin.master.location.edit', [
            'title' => 'Location',
            'location' => $location,
            'desc' => 'This page is used to edit the master location data',
            'section' => 'Location',
            'active' => 'Master Data'
        ]);
    }

    public function update(Request $request, $id)
    {
        $location = Location::find($id);

        if (!$location) {
            return redirect()->back()->with('errorDatanotfound', 'Data not found');
        }

        try{
            $location->locationName = $request->location_name;
            $location->locationDetail = $request->location_detail;
            $location->description	 = $request->location_desc;
            // Lakukan update sesuai dengan kolom yang ingin diubah
            // ...

            $location->save();

            return redirect('/admin/location')->with('successUpdate', 'Updated successfully');
        } catch(Exception $e) {
            dd($e);
            return redirect()->back()->with('failedUpdate', 'Updated failed');
        }
        
    }

    public function destroy($id)
    {

        // Cari data pengguna berdasarkan ID
        $location = Location::find($id);

        try {
            // Hapus data pengguna
            $location->delete();
            return redirect()->back()->with('successDelete', 'Berhasil menghapus user');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorDelete', $e->getMessage());
        }
    }
}
