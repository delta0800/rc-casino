<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Master;
use App\Models\Senior;
use DataTables;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Master::latest();

            return Datatables::of($query)
                    ->addIndexColumn()
                    ->addColumn('super', function ($master) {
                        return $master->senior->super->username;
                    })
                    ->addColumn('senior', function ($master) {
                        return $master->senior->username;
                    })
                    ->addColumn('amount', function ($master) {
                        return number_format($master->amount);
                    })
                    ->filter(function ($instance) use ($request) {
                        if (! empty($request->get('referral_code'))) {
                            $instance->whereHas('senior', function ($w) use ($request) {
                                $referral_code = $request->get('referral_code');
                                $w->whereId($referral_code);
                            });
                        }
                        if (! empty($request->get('search'))) {
                            $instance->where(function ($w) use ($request) {
                                $search = $request->get('search');
                                $w->where('username', 'LIKE', "%$search%");
                                $w->orWhere('name', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->make(true);
        }
        $seniors = Senior::select('id','username')->get();

        return view('backend.masters.index', compact('seniors'));
    }
}
