<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuperTransaction;
use App\Models\SeniorTransaction;
use App\Models\MasterTransaction;
use App\Models\AgentTransaction;
use App\Models\UserTransaction;
use App\Models\Super;
use App\Models\Senior;
use App\Models\Master;
use App\Models\Agent;
use App\Http\Requests\BalanceTransactionRequest;
use DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = SuperTransaction::with('super')->filterDates()->latest();
            return Datatables::of($query)
                    ->addIndexColumn()
                    ->addColumn('name', function ($row) {
                        return $row->super->name;
                    })
                    ->addColumn('username', function ($row) {
                        return $row->super->username;
                    })
                    ->addColumn('before', function ($row) {
                        return number_format($row->before);
                    })
                    ->addColumn('after', function ($row) {
                        return number_format($row->after);
                    })
                    ->addColumn('amount', function ($row) {
                        return number_format($row->amount);
                    })
                    ->addColumn('status', function ($row) {
                        if ($row->status == "deposit") {
                            return '<label class="label label-success">ထည့်</label>';
                        }else{
                            return '<label class="label label-danger">ထုတ်</label>';
                        }
                    })
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('search'))) {
                            $instance->whereHas('super', function($w) use($request){
                                $search = $request->get('search');
                                $w->where('name', 'LIKE', "%$search%");
                                $w->orWhere('username', 'LIKE', "%$search%");
                            });
                        }
                        if (!empty($request->get('status'))) {
                            $instance->where(function($w) use($request){
                                $status = $request->get('status');
                                $w->whereStatus($status);
                            });
                        }
                    })
                    ->rawColumns(['status'])
                    ->make(true);
        }
        $seniors = Senior::select(['id', 'username'])->get();

        return view('backend.transactions.super', compact('seniors'));
    }

    public function store(BalanceTransactionRequest $request)
    {
        $validatedData = $request->validated();
        $super = Super::find($request->super_id_one);
        
        if ($request->status == "withdrawal" && $request->amount > $super->amount) {
            return response()->json([
                'success' => false,
                'message' => 'ထုတ်ယူနိုင်သည့် ပမာဏထက် ကျော်လွန်နေပါသည်!',
            ], 422);
        }
        $validatedData['super_id'] = $super->id;
        $validatedData['before'] = $super->amount;
        
        switch ($request->status) {
            case 'deposit':
                $validatedData['after'] = $super->amount + $request->amount;
                $super->update(['amount' => $super->amount + $request->amount]);
                break;
            
            default:
                $validatedData['after'] = $super->amount - $request->amount;
                $super->update(['amount' => $super->amount - $request->amount]);
                break;
        }
        SuperTransaction::create($validatedData);
        return response()->json(['success'=>'Transaction saved successfully.']);
    }

    public function seniorTransaction(Request $request)
    {
        if ($request->ajax()) {
            $query = SeniorTransaction::with('senior', 'super')->filterDates()->latest();
            return Datatables::of($query)
                    ->addIndexColumn()
                    ->addColumn('super', function ($row) {
                        return $row->super->username;
                    })
                    ->addColumn('name', function ($row) {
                        return $row->senior->name;
                    })
                    ->addColumn('username', function ($row) {
                        return $row->senior->username;
                    })
                    ->addColumn('before', function ($row) {
                        return number_format($row->before);
                    })
                    ->addColumn('after', function ($row) {
                        return number_format($row->after);
                    })
                    ->addColumn('amount', function ($row) {
                        return number_format($row->amount);
                    })
                    ->addColumn('status', function ($row) {
                        if ($row->status == "deposit") {
                            return '<label class="label label-success">ထည့်</label>';
                        }else{
                            return '<label class="label label-danger">ထုတ်</label>';
                        }
                    })
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('search'))) {
                            $instance->whereHas('senior', function($w) use($request){
                                $search = $request->get('search');
                                $w->where('name', 'LIKE', "%$search%");
                                $w->orWhere('username', 'LIKE', "%$search%");
                            });
                        }
                        if (!empty($request->get('status'))) {
                            $instance->where(function($w) use($request){
                                $status = $request->get('status');
                                $w->where('status', $status);
                            });
                        }
                        if (!empty($request->get('username'))) {
                            $instance->whereHas('senior', function($w) use($request) {
                                $username = $request->get('username');
                                $w->whereId($username);
                            });
                        }
                    })
                    ->rawColumns(['status'])
                    ->make(true);
        }
        $supers = Senior::select(['id', 'username'])->get();

        return view('backend.transactions.senior', compact('supers'));
    }

    public function masterTransaction(Request $request)
    {
        if ($request->ajax()) {
            $query = MasterTransaction::with('senior', 'master')->filterDates()->latest();
            return Datatables::of($query)
                    ->addIndexColumn()
                    ->addColumn('senior', function ($row) {
                        return $row->super->username;
                    })
                    ->addColumn('name', function ($row) {
                        return $row->master->name;
                    })
                    ->addColumn('username', function ($row) {
                        return $row->master->username;
                    })
                    ->addColumn('before', function ($row) {
                        return number_format($row->before);
                    })
                    ->addColumn('after', function ($row) {
                        return number_format($row->after);
                    })
                    ->addColumn('amount', function ($row) {
                        return number_format($row->amount);
                    })
                    ->addColumn('status', function ($row) {
                        if ($row->status == "deposit") {
                            return '<label class="label label-success">ထည့်</label>';
                        }else{
                            return '<label class="label label-danger">ထုတ်</label>';
                        }
                    })
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('search'))) {
                            $instance->whereHas('senior', function($w) use($request){
                                $search = $request->get('search');
                                $w->where('name', 'LIKE', "%$search%");
                                $w->orWhere('username', 'LIKE', "%$search%");
                            });
                        }
                        if (!empty($request->get('status'))) {
                            $instance->where(function($w) use($request){
                                $status = $request->get('status');
                                $w->where('status', $status);
                            });
                        }
                        if (!empty($request->get('username'))) {
                            $instance->whereHas('senior', function($w) use($request) {
                                $username = $request->get('username');
                                $w->whereId($username);
                            });
                        }
                    })
                    ->rawColumns(['status'])
                    ->make(true);
        }
        $seniors = Senior::select(['id', 'username'])->get();

        return view('backend.transactions.master', compact('seniors'));
    }

    public function agentTransaction(Request $request)
    {
        if ($request->ajax()) {
            $query = AgentTransaction::with('agent', 'master')->filterDates()->latest();
            return Datatables::of($query)
                    ->addIndexColumn()
                    ->addColumn('master', function ($row) {
                        return $row->master->username;
                    })
                    ->addColumn('name', function ($row) {
                        return $row->agent->name;
                    })
                    ->addColumn('username', function ($row) {
                        return $row->agent->username;
                    })
                    ->addColumn('before', function ($row) {
                        return number_format($row->before);
                    })
                    ->addColumn('after', function ($row) {
                        return number_format($row->after);
                    })
                    ->addColumn('amount', function ($row) {
                        return number_format($row->amount);
                    })
                    ->addColumn('status', function ($row) {
                        if ($row->status == "deposit") {
                            return '<label class="label label-success">ထည့်</label>';
                        }else{
                            return '<label class="label label-danger">ထုတ်</label>';
                        }
                    })
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('search'))) {
                            $instance->whereHas('user', function($w) use($request){
                                $search = $request->get('search');
                                $w->orWhere('name', 'LIKE', "%$search%");
                                $w->orWhere('phone', 'LIKE', "%$search%");
                            });
                        }
                        if (!empty($request->get('status'))) {
                            $instance->where(function($w) use($request){
                                $status = $request->get('status');
                                $w->where('status', $status);
                            });
                        }
                        if (!empty($request->get('referral_code'))) {
                            $instance->whereHas('agent', function($w) use($request) {
                                $agent = $request->get('referral_code');
                                $w->whereId($agent);
                            });
                        }
                    })
                    ->rawColumns(['status'])
                    ->make(true);
        }
        $masters = Master::select(['id', 'username'])->get();

        return view('backend.transactions.agent', compact('masters'));
    }

    public function userTransaction(Request $request)
    {
        if ($request->ajax()) {
            $query = UserTransaction::with('agent', 'user')->filterDates()->latest();
            return Datatables::of($query)
                    ->addIndexColumn()
                    ->addColumn('agent', function ($row) {
                        return $row->agent->username;
                    })
                    ->addColumn('name', function ($row) {
                        return $row->user->name;
                    })
                    ->addColumn('username', function ($row) {
                        return $row->user->username;
                    })
                    ->addColumn('before', function ($row) {
                        return number_format($row->before);
                    })
                    ->addColumn('after', function ($row) {
                        return number_format($row->after);
                    })
                    ->addColumn('amount', function ($row) {
                        return number_format($row->amount);
                    })
                    ->addColumn('status', function ($row) {
                        if ($row->status == "deposit") {
                            return '<label class="label label-success">ထည့်</label>';
                        }else{
                            return '<label class="label label-danger">ထုတ်</label>';
                        }
                    })
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('search'))) {
                            $instance->whereHas('user', function($w) use($request){
                                $search = $request->get('search');
                                $w->where('name', 'LIKE', "%$search%");
                                $w->orWhere('phone', 'LIKE', "%$search%");
                            });
                        }
                        if (!empty($request->get('status'))) {
                            $instance->where(function($w) use($request){
                                $status = $request->get('status');
                                $w->where('status', $status);
                            });
                        }
                        if (!empty($request->get('referral_code'))) {
                            $instance->whereHas('agent', function($w) use($request) {
                                $agent = $request->get('referral_code');
                                $w->whereId($agent);
                            });
                        }
                    })
                    ->rawColumns(['status'])
                    ->make(true);
        }
        $agents = Agent::select(['id', 'name'])->get();
        
        return view('backend.transactions.user', compact('agents'));
    }
}