<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

use Validator;
use DB;
use Auth;

class MemberController extends Controller
{
   
    function index()
    {
        return view('member.member');
    }

    function newWinNumber(Request $request)
    {
        Log::channel('single')->error("LuckydrawController::genLuckyDrawResult Start.");
        $response = array('status'=>'');
        $this->validate($request,[
            'mName'             => 'required',
            'winNumber'         => 'required|alphaNum',            
        ]);

        $mName = $request->input('mName');        
        $winNumber = $request->input('winNumber');
        
        $results = DB::select('select id from members where name = :id', ['id' => $mName]);
        $winId = DB::select('select id from members_win_number where win_number = :num', ['num' => $winNumber]);
        if(!empty($winId)){
            $response['status'] = '1001';
            return $response;
        }
        
        try{
            DB::beginTransaction();
            
            if(empty($results)){
                $id = DB::table('members')->insertGetId(
                    array('name' => $mName, 'win_num_count' => 0, 'created_at' => now(), 'updated_at' => now())
                );
            }else{
                DB::update('update members'
                            .' set win_num_count = win_num_count + 1 '
                            .' where id = ?', [$results[0]->id]);
                $id = $results[0]->id;
            }

            DB::insert('insert into members_win_number'
                .' (m_id, win_number,created_at,updated_at)'
                .' values (?, ?, ?, ?)', [$id, $winNumber, now(), now()]);

            DB::commit();
        } catch(QueryException $ex){
            dd($ex->getMessage()); 
            Log::channel('single')->error($ex->getMessage());
            DB::rollBack();
        }

        $response['status'] = '0000';
        return json_encode($response);
    }
}
