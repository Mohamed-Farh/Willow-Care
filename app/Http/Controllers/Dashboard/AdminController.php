<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AdminRequest;
use App\Http\Requests\Dashboard\ChangePasswordRequest;
use App\Models\Admin;
use App\Models\Category;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use HelperTrait;

    public function index()
    {
        $admins = Admin::all();

        return view('dashboard.admin.index', compact('admins'));
    }

    public function changeStatus(Request $request)
    {

        $admin = Admin::find($request->admin_id);
        $admin->active = $request->active;
        $admin->save();
        return response()->json(['success' => 'Status change successfully.']);


    }

    public function create()
    {
        return view('dashboard.admin.create');
    }

    public function store(AdminRequest $request)
    {
        $input = $request->all();
        $input['active'] = $request->input('active') == TRUE ? "1" : "0";
        if ($request->hasFile('image')) {
            $img = $this->uploadImages($request->image, "uploads/admin");
            $input['image'] = $img;
        }
        $input['role'] = 1;
        Admin::create($input);
        return redirect()->route('admin.index')->withToastSuccess('Admin Created Successfully!');
    }

    public function massDestroy(Request $request)
    {

        $ids = $request->ids;
        foreach ($ids as $id) {
            $admin = Admin::findorfail($id);
            if (File::exists($admin->image)) :
                unlink($admin->image);
            endif;
            if ($admin->role == 0) {
                return response()->json([
                    'error' => true,
                ], 402);
            }
            $admin->delete();
        }
        return response()->json([
            'error' => false,
        ], 200);

    }

    public function destroy(Admin $admin)
    {
        if (File::exists($admin->image)) :
            unlink($admin->image);
        endif;
        $admin->delete();
        return redirect()->route('admin.index')->withToastSuccess('Admin Deleted Successfully!');
    }

    public function show(Admin $admin)
    {

        return view('dashboard.admin.show', compact('admin'));
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        $input = $request->all();
        $admin->update($input);
        if ($request->file("image")) :
            $img = $this->uploadImages($request->file("image"), "uploads/admin");
            $admin->update(["image" => $img]);
        endif;
        return redirect()->route('admin.index')->withToastSuccess('Admin Updated Successfully!');
    }

    public function deleteattachment(Request $request)
    {
        $record = Admin::findOrFail($request->id);
        if ($record) {
            if (File::exists($record->image)) {
                unlink($record->image);
                $record->image = null;
                $record->save();
            }
        }
        return response()->json([
            'error' => false,
            'admin' => $record,
        ], 200);

    }

    public function showChangePassword($id)
    {

        $admin = Admin::findOrFail($id);
        return view('dashboard.admin.change-password', compact('admin'));
    }

    public function changePassword(ChangePasswordRequest $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->update([
            'password' => Hash::make($request->new_password),
        ]);
        Auth::logout();
        return redirect()->route('login');
    }
}
