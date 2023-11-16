<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculateController extends Controller
{
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

        $timeSpan = $timeArray[0] * 3600 + $timeArray[1] * 60 + $timeArray[2];
        $eUsage = $device[$request->device] * ( $timeSpan / 3600 );
        $cost = $eUsage * $usage;

        // return [$timeSpan, $eUsage, $cost];
        return view('welcome', compact('timeSpan', 'eUsage', 'cost'));
    }
}
