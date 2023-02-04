<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Products\StoreProductFormRequest;
use App\Http\Requests\Backend\Products\UpdateProductFormRequest;
use App\Models\Category;
use App\Models\Product;
use App\Traits\SharedMethod;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    use UploadImageTrait;
    use SharedMethod;

    // ================================================================
    // ======================== index Function ========================
    // ================================================================
    public function index(Request $request)
    {

            $products = Product::select('*')->orderBy('created_at', 'desc')->paginate(100);
            return view('admin.products.index', compact('products'));

    }

    // ================================================================
    // ======================= Create Function ========================
    // ================================================================
    public function create()
    {

            $categories = Category::get();
            return view('admin.products.create', compact('categories'));

    }



    // ================================================================
    // ======================= Store Function =========================
    // ================================================================
    public function store(StoreProductFormRequest $request)
    {

            // Upload Image Section :
            if (isset($request->image)) {
                $orginal_image = $request->file('image');
                $upload_location = 'storage/products/';
                $last_image = $this->saveFile($orginal_image,$upload_location);
            } else {
                $last_image = null;
            }

            $created_data = [
                'category_id' => $request->category_id,
                'name_en' => $request->name_en,
                'main_description_en' => $request->main_description_en,
                'sub_description_en' => $request->sub_description_en,
                'sale_price' => $request->sale_price,
                'quantity_limit' => $request->quantity_limit,
                'image' => $last_image,
                'status' => $request->status,
                'updated_by' => auth()->user()->id,
                'weight' => $request->weight
            ];

            DB::transaction(function () use ($created_data) {
                Product::create($created_data);
            });

            return redirect()->route('super_admin.products-index')->with('success', 'The data has been successfully updated');

    }

    // ================================================================
    // ======================== Edit Function =========================
    // ================================================================
    public function edit($product_id)
    {

            $categories = Category::get();
            $product = Product::find($product_id);

            if ($product) {
                return view('admin.products.edit', compact('product', 'categories'));
            } else {
                return redirect()->route('super_admin.products-index')->with('danger', 'This record is not in the records');
            }

    }

    // ================================================================
    // ======================= Update Function ========================
    // ================================================================
    public function update($product_id, UpdateProductFormRequest $request)
    {

            $product = Product::find($product_id);
            if ($product) {
                // Standard Updated Data :
                $update_data['category_id'] = $request->category_id;
                $update_data['name_en'] = $request->name_en;
                $update_data['main_description_en'] = $request->main_description_en;
                $update_data['sub_description_en'] = $request->sub_description_en;
                $update_data['sale_price'] = $request->sale_price;
                $update_data['quantity_limit'] = $request->quantity_limit;
                $update_data['status'] = $request->status;
                $update_data['weight'] = $request->weight;
                $update_data['updated_by'] = auth()->user()->id;

                // Upload Image Section :
                if (isset($request->image)) {
                    $orginal_image = $request->file('image');
                    $upload_location = 'storage/products/';
                    $update_data['image'] = $this->saveFile($orginal_image,$upload_location);
                    File::delete($product->image);
                }

                DB::table('products')->where('id', $product_id)->update($update_data);

                return redirect()->route('super_admin.products-index')->with('success', 'The data has been successfully updated');
            } else {
                return redirect()->route('super_admin.products-index')->with('danger', 'This record does not exist in the records');
            }

    }

    // ================================================================
    // ================== Active/Inactive Single ======================
    // ================================================================
    public function activeInactiveSingle($product_id)
    {

            $product = Product::find($product_id);
            if ($product) {
                if ($product->status == 1) {
                    $product->status = 2;  // 2 => Inactive
                    $product->save();
                } elseif ($product->status == 2) {
                    $product->status = 1;  // 1 => Active
                    $product->save();
                }
                return redirect()->back()->with('success', 'The process has successfully');
            } else {
                return redirect()->back()->with('danger', 'This record is not in the records');
            }

    }

    // ========================================================================
    // ========================== Destroy Function ============================
    // ==================== Created By : Mohammed Salah ======================
    // ========================================================================
    public function destroy($category_id)
    {

            $product = Product::where('id', $category_id)->get()->first();
            if ($product) {
                File::delete($product->image);
                $product->delete();
                return redirect()->back()->with('success', 'The process has successfully');
            } else {
                return redirect()->back()->with('danger', 'This record is not in the records');
            }

    }

}
