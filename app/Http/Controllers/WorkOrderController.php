<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Location;
use App\Models\Category;
use App\Models\WorkOrder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;


class WorkOrderController extends Controller
{
    use AuthorizesRequests;

    public function request()
    {
        $departmentCollection = Department::all();
        $locationCollection = Location::all();
        $categoryCollection = Category::all();

        return view('user.work_order.request', [
            'title' => 'Request',
            'section' => 'Request',
            'departmentCollection' => $departmentCollection,
            'locationCollection' => $locationCollection,
            'categoryCollection' => $categoryCollection,
            'desc' => 'This page is used to request work order',
            'active' => 'Work Order'
        ]);
    }

    public function store(Request $request)
    {
        // validasi input yang didapatkan dari request
        $validator = Validator::make($request->all(), [
            'workOrderName' => 'required|string|max:255',
            'idCategory' => 'required',
            'fromDept' => 'required',
            'toDept' => 'required',
            'idLocation' => 'required',
            // 'estimate' => 'required|string|max:255',
            'description' => 'required',
            'userId' => 'required',
            'startWorkOrder' => 'required|date',
        ]);

        // kalau ada error kembalikan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // simpan data ke database
        try {
            DB::beginTransaction();

            // insert ke tabel departments
            WorkOrder::create([
                'workOrderName' => $request->workOrderName,
                'userId' => $request->userId,
                'fromDept' => $request->fromDept,
                'toDept' => $request->toDept,
                'idCategory' => $request->idCategory,
                'idLocation' => $request->idLocation,
                'startWorkOrder' => $request->startWorkOrder,
                // 'estimate' => $request->estimate,
                'description' => $request->description,
            ]);

            DB::commit();

            return redirect('/wo/request')->with('createSuccess', 'Data created successfully.');

        } catch(Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function received()
    {
        // data category
        $workOrders = WorkOrder::with('deptFrom', 'userWo')->where('toDept', auth()->user()->idDept)->orderByDesc('created_at')->paginate(5);

        $totalWo = WorkOrder::where('toDept', auth()->user()->idDept)->count();

        return view('user.work_order.received', [
            'title' => 'Received',
            'workOrders' => $workOrders,
            'totalWo' => $totalWo,
            'section' => 'Received',
            'desc' => 'This page is used to see received work order request',
            'active' => 'Work Order'
        ]);
    }

    public function edit($id)
    {
        // data category
        $workOrder = WorkOrder::with('deptFrom', 'deptTo', 'categoryWo', 'locationWo', 'userWo')->find($id);
        
        return view('user.work_order.edit', [
            'title' => 'Edit',
            'workOrder' => $workOrder,
            'section' => 'Received',
            'desc' => 'This page is used to see received work order request',
            'active' => 'Work Order'
        ]);
    }

    public function update(Request $request, $id)
    {
        $workOrder = WorkOrder::find($id);

        if (!$workOrder) {
            return redirect()->back()->with('errorDatanotfound', 'Data not found');
        }

        try{

            $fileName = null;
            if ($request->file('file')) {
                $file = $request->file('file');
                $fileName = Str::slug(Carbon::now()) . '-' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $fileName);
            }

            $workOrder->endWorkOrder = $request->endWorkOrder;
            $workOrder->completeBy = $request->completeBy;
            $workOrder->estimate = $request->estimate;
            $workOrder->status = $request->status;
            $workOrder->note = $request->note;
            $workOrder->photo = $fileName;
            
            $workOrder->save();

            return redirect('/wo/received')->with('successUpdate', 'Updated successfully');
        } catch(Exception $e) {
            dd($e);
            return redirect()->back()->with('failedUpdate', 'Updated failed');
        }
        
    }

    public function report(Request $request)
    {
        if ($request->idDept && $request->deptName) {
            session()->put('idDept', $request->idDept);
            session()->put('deptName', $request->deptName);
        } elseif (session('idDept')){
            // $idDept = session('idDept');
        }
        else {
            return redirect()->back()->with('fail', 'Gagal tidak ada department yang dipilih!');
        }
        
        if ($request->awal && $request->akhir) {
            // get data wo dengan tanggal
            $startDate = $request->awal;
            $endDate = $request->akhir;

            // simpan di session juga
            session()->put('startDate', $request->awal);
            session()->put('endDate', $request->akhir);

            $woPending = WorkOrder::where('status', 0)
                            ->when(session()->has('idDept'), function ($query) {
                                // Menambahkan kondisi where jika session 'idDept' di-set dan tidak null
                                return $query->where('toDept', session('idDept'));
                            })
                            ->whereBetween('startWorkOrder', [$startDate, $endDate])
                            ->count();
            $woProgress = WorkOrder::where('status', 1)
                            ->when(session()->has('idDept'), function ($query) {
                                // Menambahkan kondisi where jika session 'idDept' di-set dan tidak null
                                return $query->where('toDept', session('idDept'));
                            })
                            ->whereBetween('startWorkOrder', [$startDate, $endDate])
                            ->count();
            $woDone = WorkOrder::where('status', 2)
                            ->when(session()->has('idDept'), function ($query) {
                                // Menambahkan kondisi where jika session 'idDept' di-set dan tidak null
                                return $query->where('toDept', session('idDept'));
                            })
                            ->whereBetween('startWorkOrder', [$startDate, $endDate])
                            ->count();
                            
            $workOrders = WorkOrder::with('categoryWo')
                            ->when(session()->has('idDept'), function ($query) {
                                // Menambahkan kondisi where jika session 'idDept' di-set dan tidak null
                                return $query->where('toDept', session('idDept'));
                            })
                            ->whereBetween('startWorkOrder', [$startDate, $endDate])
                            ->orderByDesc('created_at')
                            ->paginate(10);
        } else {
            // get data wo dengan tanggal
            $woPending = WorkOrder::where('status', 0)->where('toDept', $request->idDept)->count();
            $woProgress = WorkOrder::where('status', 1)->where('toDept', $request->idDept)->count();
            $woDone = WorkOrder::where('status', 2)->where('toDept', $request->idDept)->count();
                            
            $workOrders = WorkOrder::with('categoryWo')
                            ->where('toDept', $request->idDept)
                            ->orderByDesc('created_at')
                            ->paginate(10);
        }

        return view('user.work_order.report', [
            'title' => 'Report',
            'woPending' => $woPending,
            'woProgress' => $woProgress,
            'woDone' => $woDone,
            'section' => 'Report',
            'desc' => 'Report work order request',
            'active' => 'Report'
        ]);
    }

    public function reportTable(Request $request)
    {

        if (session('startDate') && session('endDate')) {
            // get data wo dengan tanggal
            $startDate = session('startDate');
            $endDate = session('endDate');

            $workOrders = WorkOrder::with('categoryWo')
                            ->when(session()->has('idDept'), function ($query) {
                                // Menambahkan kondisi where jika session 'idDept' di-set dan tidak null
                                return $query->where('toDept', session('idDept'));
                            })
                            ->whereBetween('startWorkOrder', [$startDate, $endDate])
                            ->where('status', $request->status)
                            ->orderByDesc('created_at')
                            ->paginate(10);
        } else {
                            
            $workOrders = WorkOrder::with('categoryWo')
                            ->where('toDept', session('idDept'))
                            ->where('status', $request->status)
                            ->orderByDesc('created_at')
                            ->paginate(10);
        }

        return view('user.work_order.reportTable', [
            'title' => 'Report',
            'workOrders' => $workOrders,
            'section' => 'Report',
            'desc' => 'Report work order request',
            'active' => 'Report'
        ]);
    }

    public function reportByDepartment()
    {

        session()->forget('idDept');
        session()->forget('deptName');
        session()->forget('startDate');
        session()->forget('endDate');

        $departmentCollection = Department::all();

        return view('user.work_order.reportByDepart', [
            'title' => 'Report',
            'departmentCollection' => $departmentCollection,
            'section' => 'Report',
            'desc' => 'Report work order request',
            'active' => 'Report'
        ]);
    }

    public function detail($id)
    {
        
        // data category
        $workOrder = WorkOrder::with('deptFrom', 'deptTo', 'categoryWo', 'locationWo', 'userWo')->find($id);
        
        return view('user.work_order.detail', [
            'title' => 'Detail',
            'workOrder' => $workOrder,
            'section' => 'Work Order',
            'desc' => 'This page is used to see received work order request',
            'active' => 'Work Order'
        ]);
    }

    public function my_request()
    {
        $woPending = WorkOrder::where('status', 0)->where('userId', auth()->user()->id)->count();
        $woProgress = WorkOrder::where('status', 1)->where('userId', auth()->user()->id)->count();
        $woDone = WorkOrder::where('status', 2)->where('userId', auth()->user()->id)->count();

        $workOrders = WorkOrder::with('categoryWo')->where('userId', auth()->user()->id)->orderByDesc('created_at')->paginate(5);

        $categoryCollection = Category::all();

        return view('user.work_order.my_request', [
            'title' => 'My Request',
            'woPending' => $woPending,
            'woProgress' => $woProgress,
            'woDone' => $woDone,
            'workOrders' => $workOrders,
            'categoryCollection' => $categoryCollection,
            'section' => 'My Request',
            'desc' => 'My request work order',
            'active' => 'My Request'
        ]);
    }
}
