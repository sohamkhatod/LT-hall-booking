<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class gsec extends Controller
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
            $list[] = $entry->subject;

            //Requested date
            $list[] = explode(' ', $entry->forDate)[0];

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

    function createRequest(Request $request){

        $data = $request->all();

        $insert = array();
        //validate here

        //Inserting here


        
        $insert['subject'] = $data['subject'];
        $insert['reason'] = $data['reason'];

        $insert['forDate'] = strtotime($data['date'].' '.$data['time']);
        $insert['endTime'] = strtotime('+'.$data['duration'].' hours',$insert['forDate']);
        $insert['forDate'] = date('Y-m-d H:i:s',$insert['forDate']);
        $insert['endTime'] = date('Y-m-d H:i:s',$insert['endTime']);
        
        $insert['equipment'] = 0;

        if($data['equipment']  == 'true'){
            $insert['equipmentDetails'] = $data['equipmentDetails'];
            $insert['equipment'] = 1;
            $insert['SAStatus'] = 'Pending';
        }
        $insert['size'] = $data['size'];
        $insert['createdBy'] = $request->session()->get('User');
        


        $id = DB::table('Request')->insertGetId($insert,'requestId');

        $mentor =  DB::table('Mentor')
                       ->select('mentor')
                       ->where('username',$request->session()->get('User'))
                       ->first();

        $msg = DB::table('UserRequest')->insertGetId([
            'requestId' => $id,
            'username' => $request->session()->get('User'),
        ]);

        $msg = DB::table('UserRequest')->insert([
            'requestId' => $id,
            'username' => $mentor->mentor,
        ]);
        
        if(!$msg)
            return response()->json(['status' => 'error', 'message' => 'Some error occured']);

        return response()->json(['status' => 'success', 'message' => 'Data successfully submitted']);
        

    }
}
