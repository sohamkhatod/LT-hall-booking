<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class mentor extends Controller
{
      function showList(Request $request){
        
        $table = DB::table('Request')
                    ->join('UserRequest','Request.requestId','=','UserRequest.requestId')
                    ->where('username',$request->session()->get('User'))
                    ->get();
        $data = array();
       
        foreach( $table as $entry){
            $list = array();

            //request ID
            $list[] = $entry->requestId;

            //Subject
            $list[] = '<a href="#Modal" data-bs-toggle="modal" data-bs-target="#Modal" data-bs-requestId='.$entry->requestId.'>'.$entry->subject.'</a>';

            //Requested date
            $list[] = $entry->forDate;

            //Equipment
            $list[] = $entry->equipmentDetails;

            //Mentor Status
            $list[] = $entry->MStatus;

            //SA status
            $list[] = $entry->SAStatus;

            //Assign LT
            $list[] = $entry->LTStatus;
            
            
            $data[] = $list;
        }
       
        return json_encode(array('data' => $data));
    }

    function reqestId(Request $request){
        
       
        $entry = DB::table('Request')
                    ->where('requestId',$request->query('requestId'))
                    ->first();

       
        
            $list = array();

            //request ID
            //$list[] = $entry->requestId;

            //Subject
            $list['subject'] = $entry->subject;

            $list['reason'] = $entry->reason;
            //Requested date
            $list['forDate'] = $entry->forDate;

            //Equipment
            $list['equipmentDetails'] = $entry->equipmentDetails;

            //
            $list['equipment'] = false;
            if($entry->equipment)
                $list['equipment'] = true;
            
            $list['size'] = $entry->size;
            $list['forDate'] = $entry->forDate;
            
            $list['endTime'] = $entry->endTime;
            $list['createdBy'] = $entry->createdBy;
            
            //Mentor Status
            $list['MStatus'] = $entry->MStatus;

            //SA status
            $list['SAStatus'] = $entry->SAStatus;

            $list['Status'] = $entry->MStatus;
            if($request->session()->get('role') == 'SA')
                $list['Status'] = $entry->SAStatus;
            //Assign LT
            $list['LTStatus'] = $entry->LTStatus;
       
        return json_encode(array('data' => $list));
    }
    function approve(Request $request){
        $data = $request->input();
        $data['username'] = $request->session()->get('User');
        //dd($data);
        
        $role = $request->session()->get('role');

        
        if($data['approval'] == 'Approved'){
            
            if($data['equipment'] == 'true' && $role == 'mentor'){
                $roleTemp = 'SA';
            }else{
                $roleTemp = 'AR';
            }

            $forwardTo  = DB::table('User')
            ->select('username')
            ->where('role',$roleTemp)
            ->first();

            DB::table('UserRequest')->insert([
                'requestId' => $data['requestId'],
                'username' => $forwardTo->username,
            ]);
        }

        $updateStatus = 'MStatus';
        if($role == 'SA')
            $updateStatus = 'SAStatus';
        $flag = DB::table('Request')
        ->where('requestId', $data['requestId'])
        ->update([ $updateStatus => $data['approval']]);
        
        if(!$flag){
            return response()->json(['status' => 'error', 'message' => 'Some error occured']);
        }
        return response()->json(['status' => 'success', 'message' => 'Request '.$data['approval']]);
    }
}
