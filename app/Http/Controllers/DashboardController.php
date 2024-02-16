<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $duties = auth()->user()->duties;
        $timeSecurity = 0;
        $timePatrol = 0;
        foreach($duties as $d)
        {
            if($d->service_type == 0)
            {
                $timePatrol += $d->stops_at->diffInSeconds($d->starts_at);
            } else {
                $timeSecurity += $d->stops_at->diffInSeconds($d->starts_at);
            }
        }

        return view('dashboard', ['time_on_duty' => ['patrol' => gmdate('H:i:s', $timePatrol), 'security' => gmdate('H:i:s', $timeSecurity)]]);
    }
}
