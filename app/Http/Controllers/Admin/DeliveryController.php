<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\District;
use App\Ward;
use App\City;
use App\FeeShip;

class DeliveryController extends Controller
{
    public function delivery(Request $request) {
        $city = City::orderBy('city_code','ASC')->get();
        return view('admin.delivery',compact('city'));
    }
    public function feeship_ajax(Request $request) {
        $feeship = FeeShip::orderBy('id','DESC')->get();
        $output = '';
        $output.='
        <div class = "table-responsive">
            <table class="table table-bordered">
                <thread>
                    <tr>
                        <th>Id</th>
                        <th>City</th>
                        <th>District</th>
                        <th>Ward</th>
                        <th>Fee ship</th>
                    </tr>
                </thread>
                <body>';
        foreach($feeship as $fee) {
            $output.='
                <tr>
                    <td>'.$fee->id.'</td>
                    <td>'.$fee->city->city_name.'</td>
                    <td>'.$fee->district->district_name.'</td>
                    <td>'.$fee->ward->ward_name.'</td>
                    <td contenteditable data-feeship_edit = "'.$fee->id.'" class="feeship_edit">'.$fee->feeship.'</td>
                </tr>';
        }
            $output.='
                </body>
            </table>
        </div>';
        echo $output;
    }
    public function add_feeship(Request $request ) {
        $data = $request->all();
        $feeship = FeeShip::create([
            'city_id' => $data['city_id'],
            'district_id' => $data['district_id'],
            'ward_id' => $data['ward_id'],
            'feeship' => $data['feeship']
        ]);
        $feeship->save();
    }
    public function update_feeship(Request $request) {
        $data = $request->all();
        $feeship = FeeShip::findOrFail($data['feeship_id']);
        $feeship->update([
           'feeship' => $data['feeship']
        ]);
        $feeship->save();
        return response()->json(['status'=>true,'message'=>'Update feeship thanh cong'],200);
    }
    public function address_ajax(Request $request)
    {
        $data = $request->all();
        $output = '';
        if ($data['attr']) {
            if ($data['attr'] == 'city') {
                $getDistrict = District::where('city_code', $data['code'])->get();
                $output .= '<option>Select District</option>';
                foreach ($getDistrict as $district) {
                    $output .= '<option value="' . $district->district_id . '">' . $district->district_name . '</option>';
                }
            }else {
                $getWard = Ward::where('district_id', $data['code'])->get();
                $output .= '<option>Select Ward</option>';
                foreach ($getWard as $ward) {
                    $output .= '<option value="'.$ward->ward_id.'">'.$ward->ward_name.'</option>';
                }
            }
        }
        echo $output;
    }
}
