<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Senior;
use App\Models\Super;
use DataTables;

class SeniorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Senior::latest();

            return Datatables::of($query)
                    ->addIndexColumn()
                    ->addColumn('super', function ($master) {
                        return $master->super->username;
                    })
                    ->addColumn('amount', function($senior){
                        return number_format($senior->amount);
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
                    ->make(true);
        }
        $supers = Super::select('id','username')->get();

        return view('backend.seniors.index', compact('supers'));
    }
}
