<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;
use DB;
use Auth;

class LuckydrawController extends Controller
{
    function index()
    {
        return view('lucky.luckydraw');
    }

    function genLuckyDrawResult(Request $request)
    {
        Log::channel('single')->error("LuckydrawController::genLuckyDrawResult Start.");
        $iRet = 0;
        $response = array('status'=>'');

        $prizeType = $request->input('prizeType');
        $genRandom = $request->input('genRandom');
        $winNumber = $request->input('winNumber');

        if($prizeType == 'please select' || $genRandom == 'please select'){
            $iRet = '1005';
            $response['status'] = $iRet;
            return json_encode($response);
        }

        if(empty($genRandom) && empty($winNumber)){
            $iRet = '1004';
            $response['status'] = $iRet;
            return json_encode($response);
        }

        if($genRandom == 0 && empty($winNumber)){
            $iRet = '1004';
            $response['status'] = $iRet;
            return json_encode($response);
        }

        if(empty($winNumber)){
            //prizeType(string) input will be 11,21,22,31..etc 
            switch($prizeType[0]){
                case '1':
                    $iRet = $this->getFirstPrize($prizeType, $genRandom, $winNumber);
                    break;
                case '2':
                    $iRet = $this->getSecondPrize($prizeType, $genRandom, $winNumber);
                    break;
                case '3':
                    $iRet = $this->getThirdPrize($prizeType, $genRandom, $winNumber);
                    break;
            }
        }

        if($iRet != 0){
            $response['status'] = $iRet;
            Log::channel('single')->error('genLuckyDrawResult() Error code: '.$iRet);
            return json_encode($response);
        }
        
        Log::channel('single')->error('Win number: '.$winNumber);

        $query = $this->genUpdateDrawWinners($prizeType, $winNumber);

        try{
            DB::beginTransaction();
            
            DB::update( $query, [$winNumber]);

            DB::commit();
        } catch(QueryException $ex){
            dd($ex->getMessage()); 
            Log::channel('single')->error($ex->getMessage());
            DB::rollBack();
            $response['status'] = '-1';
            return json_encode($response);
        }
                
        $response['status'] = '0000';
        return json_encode($response);
    }

    private function genUpdateDrawWinners($prizeType, $winNumber)
    {
        Log::channel('single')->error('genUpdateDrawWinners() Start');
        $query = "update draw_winners set ";
        if($prizeType[0] == '1'){
            $query .= ' first_prize = ? ';
        }
        if($prizeType[0] == '2' && $prizeType[1] == '1'){
            $query .= ' second_prize_one = ? ';
        }
        if($prizeType[0] == '2' && $prizeType[1] == '2'){
            $query .= ' second_prize_two = ? ';
        }
        if($prizeType[0] == '3' && $prizeType[1] == '1'){
            $query .= ' third_prize_one = ? ';
        }
        if($prizeType[0] == '3' && $prizeType[1] == '2'){
            $query .= ' third_prize_two = ? ';
        }
        if($prizeType[0] == '3' && $prizeType[1] == '3'){
            $query .= ' third_prize_three = ? ';
        }
        $query .= ' where id = 1';
        Log::channel('single')->error('query: '.$query);
        return $query;
    }

    private function getFirstPrize($prizeType, $genRandom, &$winNumber)
    {
        $results = DB::select('SELECT
                                    m.id,
                                    m.`name`,
                                    win_number
                                FROM
                                    members_win_number mwn
                                INNER JOIN members m ON m.id = mwn.m_id
                                where mwn.m_id in (
                                    select m_id from members_win_number
                                    GROUP BY m_id HAVING count(m_id) = (SELECT max(win_num_count)FROM	members	limit 1)
                                ) and (mwn.used_by is null or mwn.used_by = "") and (m.win_prize is null or m.win_prize = "")'
                            );
        if(empty($results)){
            return '1003';
        }

        $count = count($results);
        $key = rand(0, ($count-1));
        $m_id= $results[$key]->id; 
        $winNumber = $results[$key]->win_number;

        try{
            DB::beginTransaction();
            
            DB::update('update members_win_number'
                    .' set used_by = ? '
                    .' where m_id = ?', [$prizeType, $m_id]);

            DB::update('update members'
                        .' set win_prize = ? '
                        .' where id = ?', [$prizeType, $m_id]);

            DB::commit();
        } catch(QueryException $ex){
            dd($ex->getMessage()); 
            Log::channel('single')->error($ex->getMessage());
            DB::rollBack();
            return 1;
        }

        return 0;
    }

    private function getSecondPrize($prizeType, $genRandom, &$winNumber)
    {
        $results = DB::select('SELECT
                                    m.id,
                                    m.`name`,
                                    win_number,
                                    used_by
                                FROM
                                    members_win_number mwn
                                INNER JOIN members m ON m.id = mwn.m_id
                                where (mwn.used_by is null or mwn.used_by = "") 
                                and (m.win_prize is null or m.win_prize = "")'
                            );
        if(empty($results)){
            return '1003';
        }
Log::channel('single')->error('result: '.json_encode($results));
        $count = count($results);
        $key = rand(0, ($count-1));
        $m_id= $results[$key]->id; 
        $winNumber = $results[$key]->win_number;

        try{
            DB::beginTransaction();
            
            DB::update('update members_win_number'
                    .' set used_by = ? '
                    .' where m_id = ?', [$prizeType, $m_id]);

            DB::update('update members'
                        .' set win_prize = ? '
                        .' where id = ?', [$prizeType, $m_id]);

            DB::commit();
        } catch(QueryException $ex){
            dd($ex->getMessage()); 
            Log::channel('single')->error($ex->getMessage());
            DB::rollBack();
            return 1;
        }

        return 0;
    }

    private function getThirdPrize($prizeType, $genRandom, &$winNumber)
    {
        $results = DB::select('SELECT
                                    m.id,
                                    m.`name`,
                                    win_number,
                                    used_by
                                FROM
                                    members_win_number mwn
                                INNER JOIN members m ON m.id = mwn.m_id
                                where (mwn.used_by is null or mwn.used_by = "") 
                                and (m.win_prize is null or m.win_prize = "")'
                            );
        if(empty($results)){
            return '1003';
        }

        $count = count($results);
        $key = rand(0, ($count-1));
        $m_id= $results[$key]->id; 
        $winNumber = $results[$key]->win_number;

        try{
            DB::beginTransaction();
            
            DB::update('update members_win_number'
                    .' set used_by = ? '
                    .' where m_id = ?', [$prizeType, $m_id]);

            DB::update('update members'
                        .' set win_prize = ? '
                        .' where id = ?', [$prizeType, $m_id]);

            DB::commit();
        } catch(QueryException $ex){
            dd($ex->getMessage()); 
            Log::channel('single')->error($ex->getMessage());
            DB::rollBack();
            return 1;
        }

        return 0;
    }
}
