<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Betting;
use App\Services\GameService;
use DataTables;

class BettingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Betting::latest();

            return Datatables::of($query)
                    ->addIndexColumn()
                    ->addColumn('name', function ($provider) {
                        return '<a href="'.route('game-lists.index', ['provider_code' => $provider->code]).'" data-id="'.$provider->id.'" class="btn btn-link">'.$provider->name.'</a>';
                    })
                    ->addColumn('img', function ($provider) {
                        $do_service = new DOService();
                        return '<img src="'.$do_service->retrieveFile($provider->img).'" width="50" height="50" class="img-circle">';
                    })
                    ->addColumn('status', function ($provider) {
                        return '<input type="checkbox" data-id="'. $provider->id  .'" name="status" class="js-single" '.($provider->status == 0 ? 'checked' : '').'>';
                    })
                    ->addColumn('action', function($provider){
                        return '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$provider->id.'" data-original-title="Edit" class="btn btn-sm btn-outline-warning editProvider">Edit</a>';
                    })
                    ->filter(function ($instance) use ($request) {
                        if (! empty($request->get('search'))) {
                            $instance->where(function ($w) use ($request) {
                                $search = $request->get('search');
                                $w->where('name', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->rawColumns(['name', 'img', 'status', 'action'])
                    ->make(true);
        }
        return view('backend.game-bettings.index');
    }
}
