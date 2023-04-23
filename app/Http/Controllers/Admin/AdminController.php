<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard() {
        return view('admin.index');
    }

    public function AdminLogin() {
        return view('admin.admin_login');
    }


    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login/admin');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $admin_data = User::find($id);
        return view('admin.admin_profile', compact('admin_data'));
    }


    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('uploads/images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/images'),$filename);
            $data['photo'] = $filename;
        }

        $notification = array(
            'message' => 'Admin profile updated successfully',
            'alert-type' => 'success',
        );

        $data->save();
        return redirect()->back()->with($notification);


    }


    public function AdminChangePassword()
    {
        return view('admin.admin_change_password');
    }



    public function UpdateAdminPassword(Request $request){
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "Old password does not match!");
        }

        // Update The new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);
        return back()->with("status", " Password changes updated successfully");

    }


    public function InactiveVendor()
    {
        $inactiveVendor = User::where('status','inactive')->where('role','vendor')->latest()->get();
        return view('backend.vendor.inactive_vendor', compact('inactiveVendor'));
    }
    public function ActiveVendor()
    {
        $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        return view('backend.vendor.active_vendor', compact('activeVendor'));
    }


    public function InactiveVendorDetails($id)
    {
        $inactiveDetails = User::findOrFail($id);
        return view('backend.vendor.inactive_vendor_details', compact('inactiveDetails'));

    }


    public function ApproveVendor(Request $request){

        $vendor_id = $request->id;
        User::findOrFail($vendor_id)->update([
            'status' => 'active',
        ]);

        $notification = array(
            'message' => 'You have approved a new vendor.',
            'alert-type' => 'info',
        );

        return redirect()->route('active_vendor')->with($notification);
    }



    public function ActiveVendorDetails($id)
    {
        $activeDetails = User::findOrFail($id);
        return view('backend.vendor.active_vendor_details', compact('activeDetails'));

    }

    public function DisapproveVendor(Request $request){

        $vendor_id = $request->id;
        User::findOrFail($vendor_id)->update([
            'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'You have disapproved a  vendor.',
            'alert-type' => 'info',
        );

        return redirect()->route('inactive_vendor')->with($notification);
    }




}
