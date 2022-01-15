<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DepartmentController extends Controller
{
    // get all department
    function getDepartments(){
        $depts = DB::select('select * from DEPARTMENT order by deptName');
        return view('manageDepartment', compact('depts'));
    }


    // get department by id
    function getDepartmentId(){
        $deptId = request('id');
        $depts = DB::select('select * from DEPARTMENT where deptId = :deptId', [
            'deptId' => $deptId
        ]);
        return  $depts;
    }

    // add
    function addDepartment(){
        if(!request('deptName'))
        return redirect()->back();

    	$data = DB::table('DEPARTMENT')->insertOrIgnore(request()->except(['_token']));        
        return redirect()->back();
    }

    // update
    function updateDepartment(){
        $id = request('deptId');
        DB::table('DEPARTMENT')->where('deptId', $id)->update(request()->except(['_token']));
        return redirect()->back();
    }

    
}
