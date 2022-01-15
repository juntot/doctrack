<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TimelineController extends Controller
{
    //
    public function viewTimeline(){
        // if( $request->has('invitee') ) {
        //     $request->query('invitee');
        // }
        // request()->query('invitee');

        $docId = request('docId');
        
        
        // $timeline = DB::select('select dcx.*, d.deptName
        // from docs dcx
        // join DEPARTMENT d
        //     on dcx.to = d.deptId
        // where docId = :docId', [
        //     'docId' => $docid
        // ]);
        
        $timeline = DB::table('docs as dcx')
        ->select('dcx.history', 'd.deptName', 'dcx.status')
        ->join('DEPARTMENT as d' , 'dcx.to','d.deptId')
        ->where('docId', $docId)
        ->first();

        if($timeline)
        $timeline->history = json_decode($timeline->history);
        // return $timeline;
        return view('timeline', compact('timeline', 'docId'));
    }
}
