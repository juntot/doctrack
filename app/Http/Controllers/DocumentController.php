<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Services\FileService;
use DB;


class DocumentController extends Controller
{
    //submitDocs
    function submitDocs(){
        date_default_timezone_set("Asia/Hong_Kong");
        $now    = Carbon::now();
        $docId  = 'JRB'.$now->valueOf();
        
        
        // save file
        $file = '';
        if(request()->has('attachment'))
        $file = FileService::saveAttachment('attachment', date("Y-m-d"));

        
        $history = array(
            "from"          => session()->get('auth.fullName'), 
            "to"            => $this->getDeptName(request('to')),
            "datesubmitted" => $now,
            "remarks"       => request('remarks'),
            "file"          => $file,
            "status"        => 'Sent',
        );

        
        request()->merge([
            'docId'         => $docId,
            'from'          => session()->get('auth.fullName'),
            'datesubmitted' => $now,
            'history'       => json_encode(array($history))
        ]);

        // return request()->all();
        DB::table('docs')->insert(request()->except('_token', 'file', 'attachment'));
        
        
        return redirect('/docs-tracknum/'.$docId);

        // var_dump(json_decode($jsonobj));
    }

    function trackNum(){
        
        return view('Tracker');
    }

    // send documents
    function docsView(){
        $depts = DB::table('DEPARTMENT')->where('status', 1)->orderBy('deptName')->get();
        return view('docs', compact('depts'));
    }


    // reciever docs
    function getReceiverDocs(){
        // docstat is file active or not
        // status is still in process 0, 1 confirmed
        $docs = DB::select('select dcx.*, d.deptName
        from docs dcx
        join DEPARTMENT d
            on dcx.to = d.deptId
        where 
            dcx.docstat = 0 
            and dcx.to = :departmentId 
            and dcx.status = 0',
        [
            session()->get('auth.dept')
        ]);

        // $depts 
        $depts = DB::table('DEPARTMENT')->where('status', 1)->orderBy('deptName')->get();
        return view('docs-res', compact('docs', 'depts'));
    }

    // confirmed
    function confirmDocs(){
        date_default_timezone_set("Asia/Hong_Kong");
        $now    = Carbon::now();
        $id = request('docId');

        // save file
        $file = '';
        if(request()->has('attachment'))
        $file = FileService::saveAttachment('attachment', date("Y-m-d"));


        // return request()->all();
        /**
         * get the history of selected docid
         */
        
        $doc = DB::table('docs')
        ->where('docId',  $id)
        ->first();

        /**
         * append prev history to next history
         */
        $newHistory = array(
            "from"          => session()->get('auth.fullName'), 
            "to"            => $this->getDeptName(session()->get('auth.dept')), 
            "datesubmitted" => $now,
            "remarks"       => request('remarks'),
            "file"          => $file,
            "status"        => 'Sent',
            
        );
        $prevHistory = json_decode($doc->history);
        $prevHistory[] = $newHistory;

        request()->merge([
            'docId'         => $id,
            'from'          => session()->get('auth.fullName'),
            'to'            => session()->get('auth.dept'),
            'datesubmitted' => $now,
            'history'       => json_encode($prevHistory),
            'status'        =>  1,
        ]);
        // return request()->all();
        return DB::table('docs')
            ->where('docId', $id)
            ->update(request()->except('attachment'));
        // return $docs;
        // return view('docs-res', compact('docs'));
    }

    // forwarded
    function forwardDocs(){
        date_default_timezone_set("Asia/Hong_Kong");
        $now    = Carbon::now();

        $id = request('docId');

        // save file
        $file = '';
        if(request()->has('attachment'))
        $file = FileService::saveAttachment('attachment', date("Y-m-d"));

        /**
         * get the history of selected docid
         */

        $doc = DB::table('docs')
        ->where('docId',  $id)
        ->first();

        /**
         * append prev history to next history
         */
        $newHistory = array(
            "from"          => session()->get('auth.fullName'), 
            "to"            => $this->getDeptName(request('to')),
            "datesubmitted" => $now,
            "remarks"       => request('remarks'),
            "file"          => $file,
            "status"        => 'Sent'
        );
        $prevHistory = json_decode($doc->history);
        $prevHistory[] = $newHistory;

        request()->merge([
            'docId'         => $id,
            'from'          => session()->get('auth.fullName'),
            'datesubmitted' => $now,
            'history'       => json_encode($prevHistory)
        ]);

        return DB::table('docs')
            ->where('docId', $id)
            ->update(request()->except('attachment'));
        // return $docs;
    }

    // Attachment
    function addAttachment(){
        date_default_timezone_set("Asia/Hong_Kong");

        $location = FileService::saveAttachment('attachment', date("Y-m-d"));
        return $location;
    }

    // get deptname
    function getDeptName($id){
        $deptName = DB::table('DEPARTMENT')->select('deptName')->where('deptId', $id)->first();
        if($deptName)
            return $deptName->deptName;
        if(!$deptName)
            return '';
    }
}

