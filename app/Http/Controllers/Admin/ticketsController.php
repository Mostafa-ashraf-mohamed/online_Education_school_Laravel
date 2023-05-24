<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ticketsController extends Controller
{
    public function auth()
    {
        if (session()->missing('type')) {
            return abort(401, 'Unauthorized');
        }else{
            return view('admin.tickets');
        }
    }
    public function index()
    {
        if (session()->missing('type')) {
            return abort(401, 'Unauthorized');
        } else {
            if (session('type') == "admin") {
                $tickets = DB::table('tickets')
                    ->join('students', 'tickets.St_id', '=', 'students.St_id')
                    ->orderBy('Ti_status', 'DESC')
                    ->select('*')
                    ->get();

                return redirect()->route('admin.tickets')->with('tickets',$tickets);
            } else {
                return abort(401, 'Unauthorized');
            }
        }
    }
    public function update($id){
        $update = DB::table('tickets')
    ->where('Ti_id', $id)
    ->update(['Ti_status' => 'close']);
    if ($update) {
        return redirect()->route('admin.tickets.index')->with('mgs','Record update successfully');
    } else {
        return redirect()->route('admin.tickets.index')->with('error',true);
    }
    }
}
