<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EcsBankData;
use App\Models\EcsDetails;
use Auth;
use DB;
use Storage;

class ECSController extends Controller
{   
    private function returnDocName($key) {
        $doc_name = null;
        switch($key) {
            case 0:
            $doc_name = "transactions";
            break;
            case 1:
            $doc_name = "transactions_json";
            break;
            case 2:
            $doc_name = "returned";
            break;
            case 3:
            $doc_name = "returned_json";
            break;
            case 4:
            $doc_name = "rejected";
            break;
            case 5:
            $doc_name = "rejected_json";
        }
        return $doc_name;
    }
    private function returnFinalECS($bool) {
        $ecsData = EcsBankData::where([
            'ecs_month' => date('m'),
            'ecs_year' => date('Y'),
            'processed' => 0
            ])->first();
        if($ecsData == null) {
            return false;
        }
        $fields = json_decode($ecsData->pointers, true);
        $pointers = array();
        foreach($fields as $key=>$f) {
            $pointers[$key] = array();
            foreach($f as $k => $p)
            $pointers[$key][$p] = $k;
        }
        unset($fields);
        //dd($pointers);
        $returned = array();
        if($ecsData->returned_json) {
            $returned = Storage::get('ecs/'.$ecsData->returned_json);
            $returned = json_decode($returned, true);
            $temp_returned = array_column($returned, "data");
            $returned = array();
            $i = 0;
            foreach($temp_returned as $temp) {
                foreach($temp as $row_) {
                    $row = array_column($row_, "text");
                    if(empty($row[$pointers['returned']['Beneficiary_AccNo']]) && !empty($row[$pointers['returned']['Beneficiary_Name']])) {
                        $returned[$i-1]['name'] .= " ".$row[$pointers['returned']['Beneficiary_Name']];
                    } elseif(!empty($row[$pointers['returned']['Beneficiary_AccNo']]) && !empty($row[$pointers['returned']['Beneficiary_Name']])) {
                    $returned[$i] = array(
                        "name" => $row[$pointers['returned']['Beneficiary_Name']],
                        "accno" => $row[$pointers['returned']['Beneficiary_AccNo']],
                        "amount" => floatval(str_replace(',', '', $row[$pointers['returned']['Amount']])),
                        "status" => "Returned"
                    );
                    $i++;
                    }
                }
            }
            unset($temp_returned);
        }
        //dd($returned);

        $rejected = array();
        if($ecsData->rejected_json) {
            $rejected = Storage::get('ecs/'.$ecsData->rejected_json);
            $rejected = json_decode($rejected, true);
            $temp_rejected = array_column($rejected, "data");
            $rejected = array();
            $i = 0;
            foreach($temp_rejected as $temp) {
                foreach($temp as $row_) {
                    $row = array_column($row_, "text");
                    if(empty($row[$pointers['rejected']['Beneficiary_AccNo']]) && !empty($row[$pointers['rejected']['Beneficiary_Name']])) {
                        $rejected[$i-1]['name'] .= " ".$row[$pointers['rejected']['Beneficiary_Name']];
                    } elseif(!empty($row[$pointers['rejected']['Beneficiary_AccNo']]) && !empty($row[$pointers['rejected']['Beneficiary_Name']])) {
                    $rejected[$i] = array(
                        "name" => $row[$pointers['rejected']['Beneficiary_Name']],
                        "accno" => $row[$pointers['rejected']['Beneficiary_AccNo']],
                        "amount" => floatval(str_replace(',', '', $row[$pointers['rejected']['Amount']])),
                        "status" => "Rejected"
                    );
                    $i++;
                    }
                }
            }
            unset($temp_rejected);
        }
        //dd($rejected);
        $subtract = array_merge($rejected, $returned);
        unset($rejected);
        unset($returned);
        //dd($subtract);



        if($ecsData->transactions_json) {
            $all = Storage::get('ecs/'.$ecsData->transactions_json);
            $all = json_decode($all, true);
            $temp_all = array_column($all, "data");
            $all = array();
            $i = 0;
            foreach($temp_all as $temp) {
                foreach($temp as $row_) {
                    $row = array_column($row_, "text");
                    $status = "Successful";
                    $trust = 0;
                    $amount = floatval(str_replace(',', '', $row[$pointers['transaction']['Amount']]));
                    if(empty($row[$pointers['transaction']['Beneficiary_AccNo']]) && !empty($row[$pointers['transaction']['Beneficiary_Name']])) {
                        $all[$i-1]['Beneficiary_Name'] .= " ".$row[$pointers['transaction']['Beneficiary_Name']];
                    } elseif(!empty($row[$pointers['transaction']['Beneficiary_AccNo']]) && !empty($row[$pointers['transaction']['Beneficiary_Name']])) {
                        foreach($subtract as $key=>$temp) {
                            if($temp['accno'] == $row[$pointers['transaction']['Beneficiary_AccNo']]) {
                                $trust++;
                                $status = $temp['status'];
                                if($temp['amount'] == $amount) {
                                    $trust++;
                                    //unset($subtract[$key]);
                                }
                            }
                        }
                        if($bool){
                            $all[$i] = array(
                                "SNO" => $row[$pointers['transaction']['SNO']],
                                "UMRN" => $row[$pointers['transaction']['UMRN']],
                                "BankCode" => $row[$pointers['transaction']['BankCode']],
                                "Beneficiary_AccNo" => $row[$pointers['transaction']['Beneficiary_AccNo']],
                                "Beneficiary_Name" => str_replace(array("\r", "\n"), '', $row[$pointers['transaction']['Beneficiary_Name']]),
                                "Settlement_Date" => $row[$pointers['transaction']['Settlement_Date']],
                                "Amount" => $amount,
                                "Start_Date" => $row[$pointers['transaction']['Start_Date']],
                                "End_Date" => $row[$pointers['transaction']['End_Date']],
                                "Frequency" => $row[$pointers['transaction']['Frequency']],
                                "member_id" => 0,
                                "status" => $status,
                                "original_file_id" => $ecsData->id
                            );
                        } else {
                            $all[$i] = array(
                                "SNO" => $row[$pointers['transaction']['SNO']],
                                "UMRN" => $row[$pointers['transaction']['UMRN']],
                                "BankCode" => $row[$pointers['transaction']['BankCode']],
                                "Beneficiary_AccNo" => $row[$pointers['transaction']['Beneficiary_AccNo']],
                                "Beneficiary_Name" => str_replace(array("\r", "\n"), '', $row[$pointers['transaction']['Beneficiary_Name']]),
                                "Settlement_Date" => $row[$pointers['transaction']['Settlement_Date']],
                                "Amount" => $amount,
                                "Start_Date" => $row[$pointers['transaction']['Start_Date']],
                                "End_Date" => $row[$pointers['transaction']['End_Date']],
                                "Frequency" => $row[$pointers['transaction']['Frequency']],
                                "Status" => $status,
                                "surety" => $trust
                            );
                        }
                    $i++;
                    }
                }
            }
            unset($temp_all);
        }
        //dd($all);
            

        return array($ecsData, $all);
    }
    public function uploadFilesForm() {
        return view('ECS.ECSUpload');
    }
    public function uploadFiles(Request $request) {
        $id = EcsBankData::where(['ecs_month' => date('m'), 'ecs_year' => date('Y')])->first();
        if($id != null) {
            return redirect()->back()->with('error', 'Files Already Uploaded For This Month.');
        }
        $request->validate([
            "docs.0" => "required|file|mimes:pdf",
            "docs.1" => "required_with:docs.0|file|mimes:json,txt",
            "docs.2" => "nullable|file|mimes:pdf",
            "docs.3" => "required_with:docs.2|nullable|file|mimes:json,txt",
            "docs.4" => "nullable|file|mimes:pdf",
            "docs.5" => "required_with:docs.4|nullable|file|mimes:json,txt",
        ]);
        if(count($request->docs) > 0) {
            foreach($request->docs as $key=>$doc) {
                $extn = $doc->getClientOriginalExtension();
                $document = md5(str_random(20).time()) . '.' .$extn;
                $doc->storeAs(
                    'ecs', $document
                );
                $documents[$key] = $document;
            }
            //dd($documents);
            $ecsfiles = new EcsBankData;
            foreach($documents as $key => $doc) {
                $temp = $this->returnDocName($key);
                $ecsfiles->$temp = $doc;
            }
            $ecsfiles->ecs_month = date('m');
            $ecsfiles->ecs_year = date('Y');
            $ecsfiles->member_id = Auth::id();
            $ecsfiles->save();
            return redirect()->route('Process_ECS');
        }
        return redirect()->back();
    }
    public function processECS() {
        $ecsData = EcsBankData::where([
            'ecs_month' => date('m'),
            'ecs_year' => date('Y'),
            'processed' => 0
            ])->first();
        if($ecsData == null) {
            return redirect()->back();
        }
        if(session('step'))
        $step = session('step');
        else {
            $step = 1;
            session(['step' => 1]);
        }
        $json = null;
        switch($step) {
            case 1:
            if($ecsData->transactions_json)
            $json = Storage::get('ecs/'.$ecsData->transactions_json);
            break;
            case 2:
            if($ecsData->returned_json)
            $json = Storage::get('ecs/'.$ecsData->returned_json);
            break;
            case 3:
            if($ecsData->rejected_json)
            $json = Storage::get('ecs/'.$ecsData->rejected_json);
            break;
        }
        $result = array();
        $error = array();
        if($json) {
        $json = json_decode($json, true);
        $json = array_column($json, "data");
        $i = 0;
        foreach($json as $temp) {
            foreach($temp as $row) {
                $result[$i] = array_column($row, "text");
                if(intval($result[$i][0]) == 0)
                $result[$i][0] = $result[$i-1][0];
                elseif($i>0) {
                    $diff = intval($result[$i][0]) - intval($result[$i-1][0]);
                    if($diff != 1)
                    $error[] = $diff . " Rows missing before SNo: " .$result[$i][0];
                }
                $i++;
            }
        }}
        return view('ECS.ECSFileVerify')->with('result', array($result, $error));
    }
    public function processECS_delete(Request $request) {
        $ecsData = EcsBankData::where([
            'ecs_month' => date('m'),
            'ecs_year' => date('Y'),
            'processed' => 0
            ])->first();
        if($ecsData == null) {
            return redirect()->back();
        } else {
            $ecsData->delete();
        }
        $request->session()->forget('step');
        return redirect()->route('UploadEcsForm');
    }
    public function processECS_put(Request $request) {
        $ecsData = EcsBankData::where([
            'ecs_month' => date('m'),
            'ecs_year' => date('Y'),
            'processed' => 0
            ])->first();
        if($ecsData == null) {
            return redirect()->back();
        }
        if(session('step') == 1) {
            $fields = array("transaction"=>$request->input('fields'));
            $ecsData->pointers = json_encode($fields);
            $ecsData->save();
            session(['step' => 2]);
        } elseif(session('step') == 2) {
            if($ecsData->returned_json) {
                if(in_array("Beneficiary_AccNo", $request->fields) && in_array("Beneficiary_Name", $request->fields) && in_array("Amount", $request->fields)) {
                $fields = json_decode($ecsData->pointers, true);
                $fields["returned"] = $request->input('fields');
                $ecsData->pointers = json_encode($fields);
                $ecsData->save();
                } else {
                    return redirect()->back()->with('message', 'Beneficiary_AccNo, Beneficiary_Name, Amount must be pointed.');
                }
            }
            session(['step' => 3]);
        } elseif(session('step') == 3) {
            if($ecsData->rejected_json) {
                if(in_array("Beneficiary_AccNo", $request->fields) && in_array("Beneficiary_Name", $request->fields) && in_array("Amount", $request->fields)) {
                $fields = json_decode($ecsData->pointers, true);
                $fields["rejected"] = $request->input('fields');
                $ecsData->pointers = json_encode($fields);
                $ecsData->save();
                } else {
                    return redirect()->back()->with('message', 'Beneficiary_AccNo, Beneficiary_Name, Amount must be pointed.');
                }
            }
            $request->session()->forget('step');
            return redirect()->route('Finalize_ECS');
        }
        return redirect()->back();
    }
    public function FinalizeECS() {
        $result = $this->returnFinalECS(false);
        if($result == false)
        return redirect()->back();
        return view('ECS.ECSConfirm')->with('result', $result[1]);
    }
    public function InsertECS() {
        $result = $this->returnFinalECS(true);
        if($result == false)
        return redirect()->back();
        $ecsfile_id = $result[0]->id;
        $result[0]->processed = 1;
        $result[0]->save();
        EcsDetails::insert($result[1]);
        DB::update('UPDATE `ecs_details` inner join `users` on `ecs_details`.`Beneficiary_AccNo` = `users`.`acc_no` SET `ecs_details`.`member_id` = `users`.`id` where `users`.`ifsc_code` = `ecs_details`.`BankCode` or `users`.`name` = `ecs_details`.`Beneficiary_Name`');
        return redirect()->route('ECSTracking');
    }
    public function ECSTrackingView() {
        $ecs = EcsDetails::where(['member_id' => '0', 'existance' => 'untracked'])->with('pdf')->get();
        $bool = true;
        if($ecs->isEmpty()) {
            unset($ecs);
            $ecs = EcsDetails::where(['existance' => 'untracked'])->with('pdf')->get();
            $bool = false;
        }
        //return $ecs;
        return view('ECS.ECSTracking')->with('ecs_list', array($bool, $ecs));
    }
}