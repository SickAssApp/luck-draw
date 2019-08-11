<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;
use DB;

class ShowDrawController extends Controller
{
    //
    function index()
    {
        return view('show.showdraw');
    }

    function getDrawResult()
    {
        $response = array('status'=>'','info'=>[]);

        $results = DB::select(
                        'select 
                            IFNULL(id,"N/A") as id,
                            IFNULL(first_prize,"N/A") as first_prize,
                            IFNULL(second_prize_one,"N/A") as second_prize_one,
                            IFNULL(second_prize_two,"N/A") as second_prize_two,
                            IFNULL(third_prize_one,"N/A") as third_prize_one,
                            IFNULL(third_prize_two,"N/A") as third_prize_two,
                            IFNULL(third_prize_three,"N/A") as third_prize_three
                        from draw_winners'
                    );

        $response['status'] = '0000';
        $response['info'] = $results;
        return json_encode($response);
    }
}
