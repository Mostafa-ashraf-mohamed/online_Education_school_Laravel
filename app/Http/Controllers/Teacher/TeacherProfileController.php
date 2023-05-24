<?php
namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TeacherProfileController extends Controller
{
    public function index()
    {
        if (session()->has('teacherData') && session()->has('type')) {
            if (session('type') == "teacher") {
                $teacher = session('teacherData');
                return view('teacher.profile', compact('teacher'));
            } else {
                session()->flush();
                return redirect('/')->with('error', 'Invalid user type');
            }
        } else {
            return redirect()->back()->with('error', 'Please log in');
        }
    }

    public function updateProfile(Request $request)
    {
        $teacher = session('teacherData');
        $oldPassword = $request->input('old');

        if ($teacher->getPassword() == $oldPassword) {
            $fname = $request->input('fn');
            $lname = $request->input('ln');
            $phone = $request->input('phone');
            $newPassword = $request->input('new');

            $teacher->setFname($fname);
            $teacher->setLname($lname);
            $teacher->setPhNumber($phone);
            $teacher->setPassword($newPassword);

            $teacher->save();

            return redirect()->back()->with('success', 'Profile updated successfully');
        } else {
            return redirect()->back()->with('error', 'Incorrect old password');
        }
    }

    public function updateProfileImage(Request $request)
    {
        if ($request->hasFile('proImage')) {
            $teacher = session('teacherData');
            $file = $request->file('proImage');
            $extension = $file->getClientOriginalExtension();

            if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                $fileName = 'profile_' . time() . '.' . $extension;
                $file->storeAs('upload/img', $fileName, 'public');

                if ($teacher->getImg() != "") {
                    Storage::disk('public')->delete('upload/img/' . $teacher->getImg());
                }
                $teacher->setImg($fileName);
                $teacher->save();

                return redirect()->back()->with('success', 'Profile image updated successfully');
            } else {
                return redirect()->back()->with('error', 'Invalid file extension. Allowed extensions are JPG, JPEG, and PNG.');
            }
        } else {
            return redirect()->back()->with('error', 'No image file selected');
        }
    }
}
