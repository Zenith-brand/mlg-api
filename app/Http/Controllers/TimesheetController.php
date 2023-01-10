<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Timesheet;
use App\Models\User_status;

class TimesheetController extends Controller
{
    public function get_timesheets(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        // $timesheets = User_status::find(2)->user;
        $timesheets = Timesheet::all();

        return response()->json(['status code' => 200, 'timesheets' => $timesheets]);
    }
}
