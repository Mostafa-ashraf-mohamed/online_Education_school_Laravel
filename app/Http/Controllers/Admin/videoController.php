<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class videoController extends Controller
{
    public function show($id)
    {
        if (session()->missing('type')) {
            return abort(401, 'Unauthorized');
        } else {
            if (session('type') == "admin") {
                $video = DB::table('videos')->where('V_id', $id)->first();

                $comments = DB::table('comments')
                    ->join('students', 'comments.St_id', '=', 'students.St_id')
                    ->leftJoin('blocks', function ($join) {
                        $join->on('students.St_id', '=', 'blocks.St_id');
                    })
                    ->where('comments.V_id', $id)
                    ->orderBy('comments.C_id', 'DESC')
                    ->select('comments.*', 'students.St_fname', 'students.St_lname', 'students.St_img', 'students.St_gender', DB::raw('CASE WHEN blocks.St_id IS NULL THEN "not_blocked" ELSE "blocked" END as is_blocked'))
                    ->get();




                return view('admin.video', ['video' => $video, 'comments' => $comments]);
            } else {
                return abort(401, 'Unauthorized');
            }
        }
    }
    public function deleteComment($id)
    {
        $isdeleted = DB::table('comments')->where('C_id', $id)->delete();
        if ($isdeleted) {
            return back()->with('msg', 'comment deleted');
        } else {
            return back()->with('msg', 'comment not deleted');
        }
    }
    public function blockuser(Request $request)
    {
        $stid = $request->input('BlockID');
        $comment = $request->input('comment');

        $isInserted = DB::table('blocks')->insert([
            'St_id' => $stid,
            'T_name' => 'admin',
            'comment' => $comment
        ]);

        if ($isInserted) {
            return redirect()->back()->with('msg', 'User blocked');
        } else {
            return redirect()->back()->with('msg', 'Error occurred while blocking this user');
        }
    }
}
