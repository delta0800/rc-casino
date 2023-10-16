<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Master;
use DataTables;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Agent::latest();

            return Datatables::of($query)
                    ->addIndexColumn()
                    ->addColumn('super', function ($agent) {
                        return $agent->master->senior->super->username;
                    })
                    ->addColumn('senior', function ($agent) {
                        return $agent->master->senior->username;
                    })
                    ->addColumn('master', function ($agent) {
                        return $agent->master->username;
                    })
                    ->addColumn('amount', function ($agent) {
                        return number_format($agent->amount);
                    })
                    ->filter(function ($instance) use ($request) {
                        if (! empty($request->get('referral_code'))) {
                            $instance->whereHas('master', function ($w) use ($request) {
                                $referral_code = $request->get('referral_code');
                                $w->whereId($referral_code);
                            });
                        }
                        if (! empty($request->get('search'))) {
                            $instance->where(function ($w) use ($request) {
                                $search = $request->get('search');
                                $w->orWhere('username', 'LIKE', "%$search%");
                                $w->orWhere('name', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->make(true);
        }
        $masters = Master::select('id', 'username')->get();

        return view('backend.agents.index', compact('masters'));
    }
}
