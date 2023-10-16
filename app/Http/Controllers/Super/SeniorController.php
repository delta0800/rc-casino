<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super;
use App\Models\Senior;
use Carbon\Carbon;
use DataTables;
use Illuminate\Validation\Rule;
use App\Http\Requests\AccountCreatedRequest;
use App\Services\AccountCreatedService;

class SeniorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Senior::latest();

            return Datatables::of($query)
                    ->addIndexColumn()
                    ->addColumn('amount', function($row){
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="addTransaction"><i class="icon feather icon-repeat f-w-600 f-16 m-r-15 text-c-green"></i></a>';
                            $btn = $btn. number_format($row->amount);
                        return $btn;
                    })
                    ->addColumn('action', function ($row) {
                        if ($row->banned_till === null) {
                            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="editSenior"><i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i></a>';
                            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="deleteSenior"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="editSenior"><i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i></a>';
                            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="deleteSenior"><i class="feather icon-trash-2 f-w-600 f-16  m-r-15 text-c-red"></i></a>';
                            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Unban" class="restoreSenior"><i class="icon feather icon-unlock f-w-600 f-16 text-c-green"></i></a>';
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

        return view('supers.senior-lists');
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
        Senior::updateOrCreate([
            'id' => $request->super_id,
        ], [
            'super_id' => auth()->guard('super')->user()->id,
            'name' => $request->name,
            'percentage' => $request->percentage,
            'username' => $username,
            'password' => $request->password,
            'banned_till' => $ban
        ]);

        return response()->json(['success'=>'Senior saved successfully.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $senior = Senior::find($id);

        return response()->json($senior);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Senior::find($id)->delete();

        return response()->json(['success'=>'Senior deleted successfully.']);
    }

    public function restoreDeletedSenior($id)
    {
        $senior = Senior::find($id);
        $senior->banned_till = null;
        $senior->save();

        return response()->json([
            'success'=> true, 
            'message' => 'You have successfully unban the senior from the banned lists'
        ]);
    }
}
