<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{


    /**
     * Display a listing of the Users table.
     */
    public function userList(Request $request)
    {
        $pagination = 15;

        // Check if a search query exists
        if ($request->has('s')) {
            $data['user_list'] = User::where('name', 'like', '%' . $request->s . '%')
                ->orWhere('email', 'like', '%' . $request->s . '%')
                ->orderBy('id', 'desc')
                ->paginate($pagination);
        } else {
            $data['user_list'] = User::orderBy('id', 'desc')->paginate($pagination);
        }

        return view('user.list', $data);
    }




    /**
     * Show the form for creating a new Users table.
     */
    public function userAdd()
    {
        return view('user.addEdit');
    }



    /**
     * Store a newly created resource in Users table.
     */
    public function userPost(Request $request)
    {
        // ✅ Determine if updating an existing user
        $isUpdating = !empty($request->id);

        // ✅ Validation rules
        $validationRules = [
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users,username' . ($isUpdating ? ',' . $request->id : ''),
            'email' => 'required|email|unique:users,email' . ($isUpdating ? ',' . $request->id : ''),
            'password' => $isUpdating ? 'nullable|min:6' : 'required|min:6',
            'role' => 'required|string',
            'status' => 'required',
            'gender' => 'required|string',
            'phone' => 'nullable|numeric',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ];

        // ✅ Validate request
        $validatedData = $request->validate($validationRules);

        // ✅ Fetch existing user or create new instance
        $user = $isUpdating ? User::findOrFail($request->id) : new User();

        // ✅ Assign values
        $user->fill([
            'name' => trim($validatedData['name']),
            'username' => trim($validatedData['username']),
            'email' => trim($validatedData['email']),
            'role' => trim($validatedData['role']),
            'status' => $validatedData['status'],
            'gender' => $validatedData['gender'],
            'phone' => $validatedData['phone'] ?? null,
        ]);

        // ✅ Hash password if provided
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        // ✅ Handle file upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
            $user->image = $fileName;
        }

        // ✅ Set timestamps manually
        $user->timestamps = false;
        if ($isUpdating) {
            $user->updated_at = now()->setTimezone('Asia/Karachi')->format('Y-m-d H:i:s');
        } else {
            $user->created_at = now()->setTimezone('Asia/Karachi')->format('Y-m-d H:i:s');
        }

        // ✅ Save user
        $user->save();

        // ✅ Return success response
        return redirect()->back()->with([
            'voice_message' => $isUpdating ? "Updated successfully" : "Added successfully",
            'success' => $isUpdating ? "Updated successfully" : "Added successfully",
        ]);
    }


    /**
     * Edit the specified resource in Users table.
     */
    public function userEdit($id)
    {
        $data['singleUser'] = User::find($id);
        return view('user.addEdit', $data);
    }



    /**
     * Remove the specified resource from Users table.
     */
    public function userDestroy(string $id)
    {
        // Find user
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        // Update status and set deleted_by
        $user->update([
            'status' => 0,
            'is_deleted' => NOW(),
        ]);

        return redirect()->back()->with([
            'voice_message' => "Deleted successfully",
            'success' => "Deleted successfully"
        ]);
    }





    /**
     * Display a listing of the Users table.
     */
    public function studentList(Request $request)
    {
        $pagination = 15;

        if ($request->has('s')) {
            $data['student_list'] = Student::where('full_name', 'like', '%' . $request->s . '%')
                ->orWhere('guardian_name', 'like', '%' . $request->s . '%')
                ->orWhere('guardian_phone', 'like', '%' . $request->s . '%')
                ->orderBy('id', 'desc')
                ->paginate($pagination);
        } else {
            $data['student_list'] = Student::orderBy('id', 'desc')->paginate($pagination);
        }

        return view('student.list', $data);
    }


    /**
     * Show the form for creating a new Users table.
     */
    public function studentAdd()
    {
        return view('student.addEdit');
    }



    /**
     * Store a newly created resource in Users table.
     */
    public function studentPost(Request $request)
    {
        // dd($request->all());

        // ✅ Determine if updating an existing user
        $isUpdating = !empty($request->id);

        // ✅ Validation rules
        $validationRules = [
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:students,email' . ($isUpdating ? ',' . $request->id : ''),
            'guardian_name' => 'required|string',
            'guardian_phone' => 'required|numeric',
            'class_name' => 'required|string',
            'dob' => 'required|date',
            'admission_date' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'status' => 'nullable|in:0,1',
            'address' => 'nullable|string',
            'profile_photo' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ];

        // ✅ Validate request
        $validatedData = $request->validate($validationRules);

        // ✅ Fetch existing student or create new instance
        $student = $isUpdating ? Student::findOrFail($request->id) : new Student();

        // ✅ Assign values
        $student->fill([
            'full_name'=> trim($validatedData['full_name']),
            'email' => trim($validatedData['email']),
            'guardian_name' => trim($validatedData['guardian_name']),
            'guardian_phone' => $validatedData['guardian_phone'],
            'class_name' => trim($validatedData['class_name']),
            'dob' => $validatedData['dob'],
            'admission_date' => $validatedData['admission_date'],
            'gender'=> $validatedData['gender'],
            'status' => $validatedData['status'],
            'address' => $validatedData['address'],
        ]);
        
        // ✅ Handle file upload
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
            $student->profile_photo = $fileName;
        }

        // ✅ Set timestamps manually
        $student->timestamps = false;
        if ($isUpdating) {
            $student->updated_at = now()->setTimezone('Asia/Karachi')->format('Y-m-d H:i:s');
        } else {
            $student->created_at = now()->setTimezone('Asia/Karachi')->format('Y-m-d H:i:s');
        }

        // ✅ Save student
        $student->save();

        // ✅ Return success response
        return redirect()->back()->with([
            'voice_message' => $isUpdating ? "Updated successfully" : "Added successfully",
            'success' => $isUpdating ? "Updated successfully" : "Added successfully",
        ]);
    }




    /**
     * Edit the specified resource in Users table.
     */
    public function studentEdit($id)
    {
        $data['singleStudent'] = Student::find($id);
        return view('student.addEdit', $data);
    }


    /**
     * Remove the specified resource from Users table.
     */
    public function studentDestroy(string $id)
    {
        // Find student
        $student = Student::find($id);

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }

        // Update status and set deleted_by
        $student->update([
            'status' => 0,
            'is_deleted' => NOW(),
        ]);

        return redirect()->back()->with([
            'voice_message' => "Deleted successfully",
            'success' => "Deleted successfully"
        ]);
    }
}
