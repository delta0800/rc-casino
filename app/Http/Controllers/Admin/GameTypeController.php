<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GameType;
use App\Services\DOService;
use DataTables;

class GameTypeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = GameType::latest();
            return Datatables::of($query)
                    ->addIndexColumn()
                    ->addColumn('img', function ($row) {
                        $do_service = new DOService();
                        return '<img src="'.$do_service->retrieveFile($row->img).'" width="50" height="50" class="img-circle">';
                    })
                    ->addColumn('action', function($row){
                        return '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-sm btn-outline-warning editProvider">Edit</a>';
                    })
                    ->filter(function ($instance) use ($request) {
                        if (! empty($request->get('search'))) {
                            $instance->where(function ($w) use ($request) {
                                $search = $request->get('search');
                                $w->where('name', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->rawColumns(['img', 'action'])
                    ->make(true);
        }
        
        return view('backend.game-types.index');
    }
}
