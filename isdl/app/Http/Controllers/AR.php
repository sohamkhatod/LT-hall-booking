<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;

class AR extends Controller
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


            $mentor = DB::table('UserRequest')
                        ->join('User','User.username','=','UserRequest.username')
                        ->where('role','mentor')
                        ->where('requestId',$entry->requestId)
                        ->first();
            //Mentor Status
            $list[] = $entry->MStatus.' by '.$mentor->username;

           

            //SA Status
            if($entry->SAStatus == 'NA')
                $list[] = $entry->SAStatus;
            else{
                $SA = DB::table('UserRequest')
                ->join('User','User.username','=','UserRequest.username')
                ->where('role','SA')
                ->where('requestId',$entry->requestId)
                ->first();

                 $list[] = $entry->SAStatus.' by '.$SA ->username;
            }

            //Assign LT
            $list[] = $entry->LTStatus;
            
            
            $data[] = $list;
        }
       
        return json_encode(array('data' => $data));
    }

    function availableLT(Request $request){

        $data = $request->input();

        $LTlist = DB::table('LTRecord')
                    ->select('LT')
                    ->where('BookedDate',$data['LT_date'])
                    ->where(function (Builder $query) use ($data) {
                        $query->where(function (Builder $query) use ($data) {
                                    $query->where('startTime','<=',$data['LT_start_time'])
                                            ->where('endTime', '>',$data['LT_start_time']);
                                    })
                                
                                ->orWhere(function (Builder $query) use ($data) {
                                
                                    $query->where('startTime','<',$data['LT_end_time'])
                                           ->where('endTime', '>=',$data['LT_end_time']);
                                })
                                ->orWhere(function (Builder $query) use ($data) {
                                
                                    $query->where('startTime','>',$data['LT_start_time'])
                                           ->where('endTime', '<',$data['LT_end_time']);
                                });
                            });
                    
       // dd($LTlist->toSql());
        $LTlist =  DB::table('LT')
                        ->select('LT_no')
                        ->where('size','=',$data['LT_size'])
                        ->whereNotIn('LT_no',$LTlist)
                        ->get();
        
        $list = array();

        foreach($LTlist as $temp){
            $list[] = $temp->LT_no;
        }
        
        return json_encode(array('list' => $list));
    }

    function bookLT(Request $request){
        $data = $request->input();

        if($data['LT_no'] != '-2')
            $msg =  DB::table('LTRecord')
                            ->insert([
                            'LT' => $data['LT_no'],   
                            'BookedDate' => $data['LT_date'],   
                            'startTime' => $data['LT_start_time'],
                            'endTime' => $data['LT_end_time'],
                            'BookedFor' => $data['LT_person'],  
                            'BookedEvent' => $data['LT_subject'],    

                            ]);

        if($data['requestId']){
            DB::table('Request')
                ->where('requestId', $data['requestId'])
                ->update([ 'LTStatus' => $data['LT_no']]);
        }

        return json_encode(array('data' => 'success','message' =>'LT Booked successfully'));
    }
}
