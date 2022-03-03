<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidaysController extends Controller
{
    //

    public function index(Request $request) {
        if($request->ajax()) {
       
            $data = Holiday::whereDate('start', '>=', $request->start)
                      ->whereDate('end',   '<=', $request->end)
                      ->get(['id', 'title', 'start', 'end']);
 
            return response()->json($data);
       }

       return view('backend.holidays.index');
    }


    public function ajax(Request $request) {
        switch ($request->type) {
            case 'add':
               $event = Holiday::create([
                   'title' => $request->title,
                   'start' => $request->start,
                   'end' => $request->end,
               ]);
  
               return response()->json($event);
              break;
   
            case 'update':
               $event = Holiday::find($request->id)->update([
                   'title' => $request->title,
                   'start' => $request->start,
                   'end' => $request->end,
               ]);
  
               return response()->json($event);
              break;
   
            case 'delete':
               $event = Holiday::find($request->id)->delete();
   
               return response()->json($event);
              break;
              
            default:
              # code...
              break;
         }
    }
}
