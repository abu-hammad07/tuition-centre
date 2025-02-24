<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class ActionsController extends Controller
{
    public function ajax_status(Request $request)
    {
        $post_id = $request->id;
        $value = $request->value;
        $action_for = $request->action_for;

        if (!$post_id || !$action_for) {
            return response()->json(['status' => 2, 'message' => 'Invalid request sent!']);
        }

        // For different types of status changes
        switch ($action_for) {

            case "user_status":
                $data_obj = User::find($post_id);
                break;

            case "student_status":
                $data_obj = Student::find($post_id);
                break;


            default:
                return response()->json(['status' => 2, 'message' => 'Incorrect action type!']);
        }

        if (!$data_obj) {
            return response()->json(['status' => 2, 'message' => 'Data not found!']);
        }

        // Change the status to active (1) or inactive (2).
        $data_obj->status = ($value == "1") ? 1 : 2;
        $data_obj->save();

        // Send message via AJAX
        return response()->json(['status' => 1, 'message' => 'Status changed successfully!']);
    }
}
