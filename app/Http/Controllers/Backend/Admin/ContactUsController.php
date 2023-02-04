<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Routing\Route;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ContactUs\UpdateContactUsFormRequest;
use App\Models\ContactUs;
use App\Models\ContactUsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactUsController extends Controller
{

    // ================================================================
    // ======================== index Function ========================
    // ================================================================
    public function index(Request $request, Route $route)
    {
            $contact = ContactUs::first();
            return view('admin.contact_us.index', compact('contact'));
    }

    // ================================================================
    // ======================== edit Function =========================
    // ================================================================
    public function edit()
    {
            $contact = ContactUs::first();
            return view('admin.contact_us.edit', compact('contact'));
    }



    // ================================================================
    // ======================= Update Function ========================
    // ================================================================
    public function update(UpdateContactUsFormRequest $request,  Route $route)
    {
            $contact = ContactUs::first();
            if ($contact) {
                $update_data = [
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address_en' => $request->address_en,
                ];

                DB::transaction(function () use ($update_data, $contact) {
                    DB::table('contact_us')->where('id', $contact->id)->update($update_data);
                });
                return redirect()->route('super_admin.contact_us-index')->with('success', 'The data has been successfully updated');
            } else {
                return redirect()->route('super_admin.contact_us-index')->with('danger', 'This record does not exist in the records');
            }

    }

    // ================================================================
    // ================= contact Us Requests Function =================
    // ================================================================
    public function requests(Request $request, Route $route)
    {
            $requests = ContactUsRequest::get();
            return view('admin.contact_us.requests', compact('requests'));

    }

    // ================================================================
    // ==================== show Request Function =====================
    // ================================================================
    public function showRequest($id, Route $route)
    {
            $request = ContactUsRequest::find($id);
            if ($request) {
                return view('admin.contact_us.show', compact('request'));
            } else {
                return redirect()->route('super_admin.contact_us-request')->with('danger', 'هذا المستخدم غير موجود في السجلات');
            }

    }

    // ================================================================
    // =================== destroy Request Function ===================
    // ================================================================
    public function destroyRequest($id, Route $route)
    {
            $request = ContactUsRequest::find($id);
            if ($request) {
                $delete_data = $request->toArray();
                DB::transaction(function () use ($request) {
                    $request->delete();
                });
                return redirect()->route('super_admin.contact_us-requests')->with('success', 'Deleted Successfully');
            } else {
                return redirect()->route('super_admin.contact_us-requests')->with('danger', 'This record does not exist in the records');
            }
    }
}
