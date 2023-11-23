<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CalculateController extends Controller
{
    public function index()
    {
        $calculations = Session::get('electricity_calculations', []);

        return view('welcome', ['calculations' => $calculations]);
    }

    public function calculate(Request $request)
    {
        $device = [
            'zero_watt_bulb' => 15,
            'cfl_bulb' => 15,
            'bulb' => 60,
            'tube_light' => 40,
            'ceiling_fan' => 60,
            'fridge_165_litre' => 100,
            'mixie' => 450,
            'washing_machine' => 325,
            'iron_box' => 750,
            'water_pump' => 750,
            'vacuum_cleaner' => 750,
            'television' => 100,
            'tape_recorder' => 20,
            'video_player' => 40,
            'mobile_charger' => 5,
            'computer' => 80,
            'air_conditioner' => 1500
        ];

        $time = $request->input('time');
        $timeArray = explode(':', $time);
        $usage = (int)str_replace(',', '', $request->usage);

        if ($request->device == "") {
            $error = True;
            return view('welcome', compact('error'));
        };

        $timeSpan = $timeArray[0] * 3600 + $timeArray[1] * 60 + $timeArray[2];
        $eUsage = ($device[$request->device] * ( $timeSpan / 3600 )) /100;
        $cost = $eUsage * $usage;

        $calculationId = uniqid();

        $calculations = Session::get('electricity_calculations', []);
        $calculations[$calculationId] = [
            'eUsage' => $eUsage,
            'cost' => $cost,
            'timeSpan' => $timeSpan,
        ];
        Session::put('electricity_calculations', $calculations);

        $calculations = Session::get('electricity_calculations', []);

        // return [$timeSpan, $eUsage, $cost];
        return view('welcome', ['calculations' => $calculations], compact('timeSpan', 'eUsage', 'cost'));
    }

    public function deleteCalculation($id)
    {
        $calculations = Session::get('electricity_calculations', []);

        if (isset($calculations[$id])) {
            unset($calculations[$id]);

            Session::put('electricity_calculations', $calculations);

            return redirect()->route('index');
        }

        return redirect()->route('index');
    }
}
