<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GameProvider;
use App\Models\GameType;
use App\Services\DOService;
use App\Services\GameService;
use DataTables;

class GameProviderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = GameProvider::latest();

            return Datatables::of($query)
                    ->addIndexColumn()
                    ->addColumn('name', function ($provider) {
                        return '<a href="'.route('game-lists.index', ['provider_code' => $provider->code]).'" data-id="'.$provider->id.'" class="btn btn-link">'.$provider->name.'</a>';
                    })
                    ->addColumn('game_type', function($row)  {
                        $options = '';
                        foreach ($row->tag as $tag) {
                            $options .= '<label class="badge badge-inverse-danger">'.$tag->code.'</label> ';
                        }
                        return $options;
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
                    ->rawColumns(['name', 'game_type', 'img', 'status', 'action'])
                    ->make(true);
        }
        $types = GameType::get();

        return view('backend.game-providers.index', compact('types'));
    }

    public function store(Request $request, DOService $do_service)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'tag.*' => 'exists:game_types,id',
        ]);
        if ($request->hasFile('img'))
        {
            $file = strtolower($request->file('img')->getClientOriginalExtension());
            $fileName = uniqid() . '.' . $file; 
            $allowed  = ['jpg', 'jpeg', 'png', 'gif'];
            $check = in_array($file,$allowed);
            if ($check) {
                $img = $do_service->storeFile($request->file('img'), $fileName);
            }else{
                return back()->with('error', 'The img must be an image & must be a file of type: jpeg, png, jpg, gif.');
            }
            $validatedData['img'] = $fileName;
        }

        $game_provider = GameProvider::findOrFail($request->provider_id);
        $game_provider->update($validatedData);
        $game_provider->tag()->sync((array)$request->get('tag'));

        return response()->json(['message'=>'Game Provider saved successfully.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provider = GameProvider::with('tag')->find($id);
        return response()->json($provider);
    }

    public function changeProviderStatus(Request $request)
    {
        $provider = GameProvider::find($request->provider_id);
        $provider->status = $request->status;
        $provider->save();
        return response()->json(['message' => 'Game Provider status changed successfully.']);
    }
}
