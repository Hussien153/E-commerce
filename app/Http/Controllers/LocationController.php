<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'street' => 'required',
            'building' => 'required',
            'area' => 'required'
        ]);

        $location = new Location();
        $location->user_id = Auth::id();
        $location->street=$request->street;
        $location->area=$request->area;
        $location->building=$request->building;
        $location->save();

        return response()->json('Location Added',201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'street' => 'required',
            'building' => 'required',
            'area' => 'required'
        ]);

        $location=Location::find($id);
        if($location) {
        $location->street=$request->street;
        $location->building=$request->building;
        $location->area=$request->area;
        $location->save();
        }
        else return response()->json('Location is not found');
    }
    
    public function destroy($id)
    {
        $location = Location::find($id);
        if($location)
        {
            $location->delete();
            return response()->json('Location deleted');
        }
        else return response()->json('Location is not found');
    }
}
