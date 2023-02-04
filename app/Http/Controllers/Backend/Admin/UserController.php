<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Users\StoreUserFormRequest;
use App\Http\Requests\Backend\Users\UpdateUserFormRequest;
use App\Traits\UploadImageTrait;
use App\Traits\SharedMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Route;

class UserController extends Controller
{
    use UploadImageTrait;
    use SharedMethod;

    // ================================================================
    // ======================== index Function ========================
    // ================================================================
    public function index(Request $request)
    {

            $users = new User();
            $users = $users->select('*')->orderBy('created_at', 'asc')->get();

            return view('admin.users.index', compact('users'));

    }

    // ================================================================
    // ======================= Create Function ========================
    // ================================================================
    public function create(Route $route)
    {

            return view('admin.users.create');

    }


    // ================================================================
    // ======================= Store Function =========================
    // ================================================================
    public function store(StoreUserFormRequest $request)
    {


            // Upload Image Section :
            if (isset($request->profile_photo_path)) {
                $orginal_image = $request->file('profile_photo_path');
                $upload_location = 'storage/profile-photos/';
                $last_image = $this->saveFile($orginal_image,$upload_location);

            } else {
                $last_image = null;
            }

            $created_data = [
                'name_en' => $request->name_en,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'user_type' => $request->user_type,
                'user_status' => $request->user_status,
                'profile_photo_path' => $last_image
            ];

            DB::transaction(function () use ($created_data) {
                // Save Main User Information Section :
               User::create($created_data);
            });

            return redirect()->route('super_admin.users-index')->with('success', 'The data has been successfully updated');

    }



    // ================================================================
    // ======================== Edit Function =========================
    // ================================================================
    public function edit($user_id)
    {
             $user = User::find($user_id);

            if ($user) {
                return view('admin.users.edit', compact('user'));
            } else {
                return redirect()->route('super_admin.users-index')->with('danger', 'This record is not in the records');
            }

    }

    // ================================================================
    // ======================= Update Function ========================
    // ================================================================
    public function update($user_id, UpdateUserFormRequest $request)
    {

                $user = User::find($user_id);


            if ($user) {
                // Standard Updated Data :
                $update_data['name_en'] = $request->name_en;
                $update_data['email'] = $request->email;
                $update_data['phone'] = $request->phone;
                $update_data['user_status'] = $user->id == 1 ? 1 : $request->user_status;

                // Add Password to updated date if exist :
                if (isset($request->password)) {
                    $update_data['password'] = Hash::make($request->password);
                }

                // Upload Image Section :
                if (isset($request->profile_photo_path)) {
                    $orginal_image = $request->file('profile_photo_path');
                    $upload_location = 'storage/profile-photos/';
                    $update_data['profile_photo_path'] = $this->saveFile($orginal_image,$upload_location);

                    File::delete($user->profile_photo_path);
                }

                    DB::table('users')->where('id', $user_id)->update($update_data);


                return redirect()->route('super_admin.users-index')->with('success', 'The data has been successfully updated');
            } else {
                return redirect()->route('super_admin.users-index')->with('danger', 'This record does not exist in the records');
            }

    }



    // ================================================================
    // =============== Active/Inactive Single User ====================
    // ================================================================
    public function activeInactiveSingle($user_id)
    {

            if ($user_id == 1) {
                return redirect()->back()->with('danger', 'This action is not allowed on the super admin');
            } else{
                $user = User::find($user_id);
            }

            if ($user) {
                if ($user->user_status == 1) {
                    $user->user_status = 2;  // 2 => Inactive
                    $user->save();
                } elseif ($user->user_status == 2) {
                    $user->user_status = 1;  // 1 => Active
                    $user->save();
                }
                return redirect()->back()->with('success', 'The process has successfully');
            } else {
                return redirect()->back()->with('danger', 'This record is not in the records');
            }

    }
}
