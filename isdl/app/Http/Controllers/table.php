<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class table extends Controller
{
    //
    function LTdata(Request $request){
       
        if(!isset($request->query()['day']))
            $table = DB::table('LTRecord')
                        ->get();
        else{
            $table = DB::table('LTRecord')
                        ->where('BookedDate',$request->query()['day'])
                        ->get();
        }
        $data = array();
       
        foreach( $table as $entry){
            $list = array();

            //Lt no
            $list['LT'] = $entry->LT;

            //booked date
            $list['BookedDate'] = $entry->BookedDate;

            //satrt time of lt request
            $list['startTime'] = $entry->startTime;

            //endtime of lt request
            $list['endTime'] = $entry->endTime;

            //lt booked by person
            $list['BookedFor'] = $entry->BookedFor;

            //Event for which lt is booked
            $list['BookedEvent'] = $entry->BookedEvent;
            
            $data[] = $list;
        }

        return json_encode(array('data' => $data));
    }
}
