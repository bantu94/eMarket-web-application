<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UserDashboard() {
        $id = Auth::user()->id;
        $user_data = User::find($id);
        return view('index', compact('user_data'));
    }



    public function UserProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);


        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('uploads/userImages/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/userImages'),$filename);
            $data['photo'] = $filename;
        }

        $notification = array(
            'message' => 'User profile updated successfully',
            'alert-type' => 'success',
        );

        $data->save();
        return redirect()->back()->with($notification);


    }
    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User logged out successfully',
            'alert-type' => 'success',
        );

        return redirect('/login')->with($notification);
    }


    public function UpdateUserPassword(Request $request){
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "Detected old password mismatch!");
        }

        // Update The new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);
        return back()->with("status", " Password changes updated successfully");

    }

}
