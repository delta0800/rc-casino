<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agent;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::latest();

            return Datatables::of($query)
                    ->addIndexColumn()
                    ->addColumn('super', function ($user) {
                        return $user->agent->master->senior->super->username;
                    })
                    ->addColumn('senior', function ($user) {
                        return $user->agent->master->senior->username;
                    })
                    ->addColumn('master', function ($user) {
                        return $user->agent->master->username;
                    })
                    ->addColumn('agent', function ($user) {
                        return $user->agent->username;
                    })
                    ->addColumn('amount', function ($user) {
                        return number_format($user->amount);
                    })
                    ->filter(function ($instance) use ($request) {
                        if (! empty($request->get('referral_code'))) {
                            $instance->whereHas('agent', function ($w) use ($request) {
                                $referral_code = $request->get('referral_code');
                                $w->whereId($referral_code);
                            });
                        }
                        if (! empty($request->get('search'))) {
                            $instance->where(function ($w) use ($request) {
                                $search = $request->get('search');
                                $w->orWhere('name', 'LIKE', "%$search%");
                                $w->orWhere('username', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->make(true);
        }
        $agents = Agent::select('id','username')->get();

        return view('backend.users.index', compact('agents'));
    }
}
