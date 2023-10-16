<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super;
use Carbon\Carbon;
use DataTables;
use Illuminate\Validation\Rule;
use App\Http\Requests\AccountCreatedRequest;
use App\Services\AccountCreatedService;

class SuperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Super::latest();

            return Datatables::of($query)
                    ->addIndexColumn()
                    ->addColumn('amount', function($agent){
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$agent->id.'" data-original-title="Edit" class="addTransaction"><i class="icon feather icon-repeat f-w-600 f-16 m-r-15 text-c-green"></i></a>';
                            $btn = $btn. number_format($agent->amount);
                        return $btn;
                    })
                    ->addColumn('action', function ($super) {
                        if ($super->banned_till === null) {
                            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$super->id.'" data-original-title="Edit" class="editSenior"><i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i></a>';
                            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$super->id.'" data-original-title="Delete" class="deleteSenior"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$super->id.'" data-original-title="Edit" class="editSenior"><i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i></a>';
                            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$super->id.'" data-original-title="Delete" class="deleteSenior"><i class="feather icon-trash-2 f-w-600 f-16  m-r-15 text-c-red"></i></a>';
                            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$super->id.'" data-original-title="Unban" class="restoreSenior"><i class="icon feather icon-unlock f-w-600 f-16 text-c-green"></i></a>';
                        }

                        return $btn;
                    })
                    ->filter(function ($instance) use ($request) {
                        if (! empty($request->get('search'))) {
                            $instance->where(function ($w) use ($request) {
                                $search = $request->get('search');
                                $w->orWhere('username', 'LIKE', "%$search%");
                                $w->orWhere('name', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->rawColumns(['action', 'amount'])
                    ->make(true);
        }

        return view('backend.supers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AccountCreatedRequest $request, AccountCreatedService $account_created_service)
    {
        $ban = null;
        if (isset($request->banned_till)) {
            $ban = $account_created_service->ban($request->banned_till);
        }
        $username = $account_created_service->username();
        Super::updateOrCreate([
            'id' => $request->super_id,
        ], [
            'name' => $request->name,
            'percentage' => $request->percentage,
            'username' => $username,
            'password' => $request->password,
            'banned_till' => $ban
        ]);

        return response()->json(['success'=>'Super saved successfully.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $super = Super::find($id);

        return response()->json($super);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Super::find($id)->delete();

        return response()->json(['success'=>'Super deleted successfully.']);
    }

    public function restoreDeletedSuper($id)
    {
        $super = Super::find($id);
        $super->banned_till = null;
        $super->save();

        return response()->json([
            'success'=> true, 
            'message' => 'You have successfully unban the super from the banned lists'
        ]);
    }
}
