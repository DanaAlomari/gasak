<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Categories\StoreCategoryFormRequest;
use App\Http\Requests\Backend\Categories\UpdateCategoryFormRequest;
use App\Models\Category;
use App\Traits\SharedMethod;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MainCategoryController extends Controller
{
    use UploadImageTrait;
    use SharedMethod;

    // ================================================================
    // ======================== index Function ========================
    // ================================================================
    public function index(Request $request)
    {
            $mainCategories = new Category();
            $mainCategories = $mainCategories->select('*')->orderBy('created_at','asc')->paginate(100);
            return view('admin.main_categories.index', compact('mainCategories'));

    }

    // ================================================================
    // ======================= Create Function ========================
    // ================================================================
    public function create()
    {

            return view('admin.main_categories.create');

    }


    // ================================================================
    // ======================= Store Function =========================
    // ================================================================
    public function store(StoreCategoryFormRequest $request)
    {
            // Upload Image Section :
            if (isset($request->image)) {
                $orginal_image = $request->file('image');
                $upload_location = 'storage/main_categories/';
                $original_name = $orginal_image->getClientOriginalName();
                $last_image = $this->saveFile($orginal_image, $upload_location);
            } else {
                $last_image = null;
            }

            $created_data = [
                'name_en' => $request->name_en,
                'description_en' => $request->description_en,
                'status' => $request->status,
                'image' => $last_image,
                'updated_by' => auth()->user()->id,
            ];

            DB::transaction(function () use ($created_data) {
                Category::create($created_data);
            });

            return redirect()->route('super_admin.mainCategories-index')->with('success', 'The data has been successfully updated');

    }

    // ================================================================
    // ======================== Edit Function =========================
    // ================================================================
    public function edit($mainCategory_id)
    {
            $mainCategory = Category::find($mainCategory_id);
            if ($mainCategory) {
                return view('admin.main_categories.edit', compact('mainCategory'));
            } else {
                return redirect()->route('super_admin.mainCategories-index')->with('danger', 'This record is not in the records');
            }

    }

    // ================================================================
    // ======================= Update Function ========================
    // ================================================================
    public function update($mainCategory_id, UpdateCategoryFormRequest $request)
    {
            $mainCategory = Category::find($mainCategory_id);

            if ($mainCategory) {
                // Standard Updated Data :
                $update_data['name_en'] = $request->name_en;
                $update_data['description_en'] = $request->description_en;
                $update_data['status'] = $request->status;
                $update_data['updated_by'] = auth()->user()->id;

                // Upload Image Section :
                if (isset($request->image)) {
                    $orginal_image = $request->file('image');
                    $upload_location = 'storage/main_categories/';
                    $original_name = $orginal_image->getClientOriginalName();
                    $update_data['image'] = $this->saveFile('categories', 'image', $orginal_image, $original_name, $upload_location);
                    File::delete($mainCategory->image);
                }

                DB::table('main_categories')->where('id', $mainCategory_id)->update($update_data);

                return redirect()->route('super_admin.mainCategories-index')->with('success', 'The data has been successfully updated');
            } else {
                return redirect()->route('super_admin.mainCategories-index')->with('danger', 'This record does not exist in the records');
            }

    }

    // ================================================================
    // ================== Active/Inactive Single ======================
    // ================================================================
    public function activeInactiveSingle($mainCategory_id)
    {
            $mainCategory = Category::find($mainCategory_id);
            if ($mainCategory) {
                if ($mainCategory->status == 1) {
                    $mainCategory->status = 2;  // 2 => Inactive
                    $mainCategory->save();
                } elseif ($mainCategory->status == 2) {
                    $mainCategory->status = 1;  // 1 => Active
                    $mainCategory->save();
                }
                return redirect()->back()->with('success', 'The process has successfully');
            } else {
                return redirect()->back()->with('danger', 'This record is not in the records');
            }

    }


    // ================================================================
    // ===================== Destroy Function =========================
    // ================================================================
    public function destroy($mainCategory_id)
    {
            $mainCategory = Category::where('id', $mainCategory_id)->get()->first();
            if ($mainCategory) {
                File::delete($mainCategory->image);
                $mainCategory->delete();
                return redirect()->back()->with('success', 'The process has successfully');
            } else {
                return redirect()->back()->with('danger', 'This record is not in the records');
            }

    }
}
