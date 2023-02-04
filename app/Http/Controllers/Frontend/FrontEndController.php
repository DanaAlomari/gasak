<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Customer\CheckoutFormRequest;
use App\Http\Requests\Frontend\Customer\CustomerRegisterFormRequest;
use App\Http\Requests\Frontend\Customer\UpdateCustomerFormRequest;
use App\Models\CartOperation;
use App\Models\Product;
use App\Models\User;
use App\Models\CartSale;
use App\Models\CartTemp;
use App\Models\Category;
use App\Models\Service;
use App\Traits\UploadImageTrait;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class FrontEndController extends Controller
{

    use UploadImageTrait;

    // ================================================================
    // ======================= Profile Function =======================
    // ================================================================
    public function profile()
    {
        if (Auth::guard('customers')->check()) {

            $orders = CartSale::where(['user_id' => auth('customers')->user()->id])->get();
            return view('front_end_files.user-profile', compact('orders'));
        } else {
            return view('front_end_files.login');
        }
    }

    public function welcome($category_id = null)
    {

        $products =  Product::where('status', 1)->inRandomOrder()->limit(3)->get();
        $products1 =  Product::where('status', 1)->inRandomOrder()->limit(3)->get();


        return view('welcome', compact('products', 'products1'));
    }
    public function services()
    {



        return view('front_end_files.services');
    }
    public function createServices(Request $request)
    {



        $created_data = [
            'name' => $request->name,
            'email' => $request->email,
            'date' => $request->date,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime,
            'description' => $request->description,
        ];

        DB::transaction(function () use ($created_data) {
            Service::create($created_data);
        });

        return redirect()->route('welcome')->with('success', 'The data has been successfully updated');
    }
    public function product_details($id)
    {

        $products =  Product::find($id);
        $products = $products;
        // return  $products;

        return view('front_end_files.single_product', compact('products'));
    }
    public function products($category_id = null)
    {

        $products = new Product();
        $products = $products->select('*');
        $products = $products->where('status', 1);

        if ($category_id != null) {
            $category = Category::find($category_id);
            if($category){
                $products = $products->where('category_id', $category_id)->orderBy('created_at', 'desc')->paginate(20);
                return view('front_end_files.gas', compact('products','category'));
            }
            else{
                return redirect()->back()->with('danger','Category Not Found !!!');
            }
        }
        $products = $products->orderBy('created_at', 'desc')->paginate(20);
        return view('front_end_files.gas', compact('products'));
    }


    public function __construct()
    {
        $this->middleware('guest:customers')->except('logout');
    }

    public function register()
    {
        return view('front_end_files.register');
    }


    public function register_submit(CustomerRegisterFormRequest $request)
    {

        $user_status = 1;
        $user_type = 2;

        $user = User::create([
            'name_en' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'user_status' => $user_status,
            'user_type' => $user_type
        ]);


        if (Auth::guard('customers')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('welcome'));
        } else {
            return redirect()->back();
        }
    }



    public function updateProfile(UpdateCustomerFormRequest $request)
    {

        $user = Auth::guard('customers')->user();

        if ($user) {
            // Standard Updated Data :
            $update_data['name_en'] = $request->name_en;
            $update_data['email'] = $request->email;
            $update_data['phone'] = $request->phone;

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

                DB::table('users')->where('id', $user->id)->update($update_data);


            return redirect()->back()->with('success', 'The data has been successfully updated');
        } else {
            return redirect()->back()->with('danger', 'This record does not exist in the records');
        }

    }


    public function showLoginForm()
    {
        return view('front_end_files.login');
    }

    public function login(Request $request)
    {
        // return $request;
        // Validate form data
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', $request->email)->get()->first();

        if ($user) {
            if ($user->user_type != 2) {
                return redirect()->back()->with('danger', 'Not User !!!!!!');
            }
        }

        // Attempt to log the user in
        if (Auth::guard('customers')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('welcome'));
        }

        // if unsuccessful
        $errors = [
            'username' => 'username or password is incorrect',
        ];
        return redirect()->back()->withInput($request->only('username', 'remember'))->withErrors($errors);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect(route('customers.login'));
    }

    function addToCart(Route $route, Request $request)
    {



        $product_id = decrypt($request->cart_product_id);
        $quantity = $request->cart_product_quantity == null ? 1 : $request->cart_product_quantity;
        $product = Product::find($product_id);


        if ($product) {


            $old_cart = CartTemp::where([
                ['user_id', Auth::guard('customers')->user()->id],
                ['product_id', $product->id]
            ])->get()->first();


            if ($old_cart) {

                $old_cart->update([
                    'quantity' => $quantity
                ]);
                // return $old_cart ;
                return redirect()->back()->with('success', 'Cart Updated Successfully');
            } else {

                $cart =  CartTemp::create([
                    'user_id' => Auth::guard('customers')->user()->id,
                    'user_type' => 'Customer',
                    'product_id' => $product->id,
                    'quantity' => $quantity
                ]);

                // return $cart;
                return redirect()->back()->with('success', 'Added To Cart Successfully');
            }
        } else {
            return redirect()->back()->with('danger', 'Product Not Found !!!');
        }
    }

    function updateCart(Request $request)
    {

        $request->validate([
            'cart_id' => 'required',
            'qty' => 'required|numeric'
        ]);



        $cart_id = $request->cart_id;

        if (!auth('customers')->user()) {
            return redirect()->route('customers.login');
        }

        $cart = CartTemp::find($cart_id);
        if ($cart) {

            $product = Product::find($cart->product_id);


            if ($request->qty > $product->quantity_limit) {
                return redirect()->back()->with('danger', 'Out Of Stock !!!');
            }

            if ($request->qty != 0) {
                $cart->update([
                    'quantity' => $request->qty
                ]);
                return redirect()->route('customers.cart')->with('success', 'Updated Successfully');
            } else {
                $cart->delete();
                return redirect()->route('customers.cart')->with('success', 'Deleted Successfully');
            }
        } else {
            return redirect()->back()->with('danger', 'Product not found in cart !!!');
        }
    }

    function getTotal()
    {
        // $withlist_count = ProductWishlist::where('customer_id', Auth::guard('customer')->user()->id)->count();
        $public_customer_carts = CartTemp::where(['user_id' => Auth::guard('customers')->user()->id, 'user_type' => 'Customer'])->get();
        $endTotal = 0;
        foreach ($public_customer_carts as $public_customer_cart) {
            $sub_total = 0;

                $public_customer_cart->cart_product = Product::find($public_customer_cart->product_id);

            if ($public_customer_cart->cart_product->on_sale_price_status == 'Active') {
                $endTotal += $public_customer_cart->quantity * $public_customer_cart->cart_product->on_sale_price;
                $sub_total = $public_customer_cart->quantity * $public_customer_cart->cart_product->on_sale_price;
            } else {
                $endTotal += $public_customer_cart->quantity * $public_customer_cart->cart_product->sale_price;
                $sub_total = $public_customer_cart->quantity * $public_customer_cart->cart_product->sale_price;
            }
            $public_customer_cart->sub_total = $sub_total;
        }
        $public_customer_carts->endTotal = $endTotal;
        return number_format($public_customer_carts->endTotal, 2);
    }

    function cart()
    {
        if (Auth::guard('customers')->check()) {
            $public_customer_carts = CartTemp::where(['user_id' => Auth::guard('customers')->user()->id, 'user_type' => 'Customer'])->get();
            $endTotal = 0;
            foreach ($public_customer_carts as $public_customer_cart) {
                $sub_total = 0;

                $public_customer_cart->cart_product = Product::find($public_customer_cart->product_id);

                if ($public_customer_cart->cart_product->on_sale_price_status == 'Active') {
                    $endTotal += $public_customer_cart->quantity * $public_customer_cart->cart_product->on_sale_price;
                    $sub_total = $public_customer_cart->quantity * $public_customer_cart->cart_product->on_sale_price;
                } else {
                    $endTotal += $public_customer_cart->quantity * $public_customer_cart->cart_product->sale_price;
                    $sub_total = $public_customer_cart->quantity * $public_customer_cart->cart_product->sale_price;
                }
                $public_customer_cart->sub_total = $sub_total;
            }
            $public_customer_carts->endTotal = $endTotal;
            $public_customer_carts_count = $public_customer_carts->count();


            return view('front_end_files.cart', compact('public_customer_carts', 'public_customer_carts_count'));
        } else {
            return redirect()->route('customers.login');
        }
    }


    function checkout(CheckoutFormRequest $request)
    {
        if (Auth::guard('customers')->check()) {
            $public_customer_carts = CartTemp::where(['user_id' => Auth::guard('customers')->user()->id, 'user_type' => 'Customer'])->get();
            $endTotal = 0;
            if($public_customer_carts && $public_customer_carts->count() > 0){

            foreach ($public_customer_carts as $public_customer_cart) {
                $sub_total = 0;

                    $public_customer_cart->cart_product = Product::find($public_customer_cart->product_id);

                if ($public_customer_cart->cart_product->on_sale_price_status == 'Active') {
                    $endTotal += $public_customer_cart->quantity * $public_customer_cart->cart_product->on_sale_price;
                    $sub_total = $public_customer_cart->quantity * $public_customer_cart->cart_product->on_sale_price;
                } else {
                    $endTotal += $public_customer_cart->quantity * $public_customer_cart->cart_product->sale_price;
                    $sub_total = $public_customer_cart->quantity * $public_customer_cart->cart_product->sale_price;
                }
                $public_customer_cart->sub_total = $sub_total;
            }

            $public_customer_carts_count = $public_customer_carts->count();


            $cart_sale = CartSale::create([
                'user_id'=>Auth::guard('customers')->user()->id,
                'product_count'=>$public_customer_carts_count,
                'total'=>$endTotal,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'name'=>$request->name,
                'address'=>$request->address,
                'more_info'=>$request->more_details,
            ]);


            foreach ($public_customer_carts as $public_customer_cart) {
                CartOperation::create([
                    'cart_sale_id'=>$cart_sale->id,
                    'product_id'=>$public_customer_cart->product_id,
                    'quantity'=>$public_customer_cart->quantity
                ]);

                $public_customer_cart->delete();
            }

            return redirect()->route('welcome')->with('success','Order Placed Successfully');

            }
            return redirect()->route('welcome')->with('danger','Cart Not Found !!!!');
        } else {
            return redirect()->route('customers.login');
        }
    }



    function checkoutPage()
    {
        if (Auth::guard('customers')->check()) {
            $public_customer_carts = CartTemp::where(['user_id' => Auth::guard('customers')->user()->id, 'user_type' => 'Customer'])->get();
            $endTotal = 0;
            foreach ($public_customer_carts as $public_customer_cart) {
                $sub_total = 0;

                    $public_customer_cart->cart_product = Product::find($public_customer_cart->product_id);

                if ($public_customer_cart->cart_product->on_sale_price_status == 'Active') {
                    $endTotal += $public_customer_cart->quantity * $public_customer_cart->cart_product->on_sale_price;
                    $sub_total = $public_customer_cart->quantity * $public_customer_cart->cart_product->on_sale_price;
                } else {
                    $endTotal += $public_customer_cart->quantity * $public_customer_cart->cart_product->sale_price;
                    $sub_total = $public_customer_cart->quantity * $public_customer_cart->cart_product->sale_price;
                }
                $public_customer_cart->sub_total = $sub_total;
            }
            $public_customer_carts->endTotal = $endTotal;
            $public_customer_carts_count = $public_customer_carts->count();


            return view('front_end_files.checkout', compact('public_customer_carts', 'public_customer_carts_count'));
        } else {
            return redirect()->route('customers.login');
        }
    }


    function deleteFromCart($id)
    {
        $cart = CartTemp::find($id);
        if ($cart) {
            $cart->delete();
            return redirect()->back()->with('success', 'Deleted Successfully');
        } else {
            return redirect()->back()->with('danger', 'Product Not Found In Cart !!!');
        }
    }



    function getOrderDetails(Request $request)
    {
        $request->validate([
            'sale_id' => 'required'
        ]);

        $sale_id = $request->sale_id;

        $auth = Auth::guard('customers')->user();

        $cartSale = CartSale::where('id', $sale_id)->get()->first();

        if ($cartSale) {

            $output = '';
            $output .= '<div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="timeline-tab">
                                <div class="media mt-3 profile-timeline-media">
                                    <div class="media-body">
                                        <h3 class="py-3 text-dark"><i class="mdi mdi-information"></i> Main Order Information :
                                        </h3>
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th><i class="mdi mdi-account"></i> Order ID: <span style="color:blue;">';
            if (isset($cartSale->id)) {
                $output .= $cartSale->id;
            } else {
                $output .= '<span style="color:red;">Undefined</span>';
            }
            $output .= '</span></th>
                                                    <th><i class="mdi mdi-account"></i> Number Of Product : <span
                                                            style="color:blue;">';
            if (isset($cartSale->product_count)) {
                $output .= $cartSale->product_count . ' products';
            } else {
                $output .= '<span style="color:red;">Undefined</span>';
            }
            $output .= '</span></th>
                                                </tr>
                                                <tr>
                                                    <th><i class="mdi mdi-account"></i> Sub Total : <span
                                                            style="color:blue;">';
            if (isset($cartSale->total)) {
                $output .= $cartSale->total . '<small> $</small>';
            } else {
                $output .= '<span style="color:red;">Undefined</span>';
            }
            $output .= '</span></th>
                                                    <th><i class="mdi mdi-account"></i> Total : <span
                                                            style="color:blue;">';
            if (isset($cartSale->total)) {
                $output .= $cartSale->total . '<small> $</small>';
            } else {
                $output .= '<span style="color:red;">Undefined</span>';
            }
            $output .= '</span></th>
                                                </tr>

                                                <tr>
                                                    <th><i class="mdi mdi-account-multiple"></i> Customer Email : <span
                                                            style="color:blue;">';
            if (isset($cartSale->email)) {
                $output .= $cartSale->email;
            } else {
                $output .= '<span style="color:red;">Undefined</span>';
            }
            $output .= '</span></th>
                                                    <th><i class="mdi mdi-phone"></i> Customer Phone : <span
                                                            style="color:blue;">';
            if (isset($cartSale->phone)) {
                $output .= $cartSale->phone;
            } else {
                $output .= '<span style="color:red;">Undefined</span>';
            }
            $output .= '</span></th>
                                                </tr>
                                                <tr>
                                                    <th><i class="mdi mdi-clock-outline mdi-spin"></i> Order Added Since : <span
                                                            style="color:blue;">';
            if (isset($cartSale->created_at)) {
                $output .= $cartSale->created_at->diffForHumans();
            } else {
                $output .= '<span style="color:red;">Undefined</span>';
            }
            $output .= '</span></th>
                                                    <th><i class="mdi mdi-clock-outline mdi-spin"></i> Date & Time of Addtion :
                                                        <span style="color:blue;">';
            if (isset($cartSale->created_at)) {
                $output .= date('Y.d.m / h:i A', strtotime($cartSale->created_at));
            } else {
                $output .= '<span style="color:red;">Undefined</span>';
            }
            $output .= '</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
<h3 class="py-3 text-dark"><i class="mdi mdi-information"></i> Order Details :
                                        </h3>
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th><span style="color:blue;">Image</th>
                                                    <th><span style="color:blue;">Product</th>
                                                    <th><span style="color:blue;">Quantity</th>
                                                    <th><span style="color:blue;">Unit Price</th>
                                                    <th><span style="color:blue;">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
            if (isset($cartSale->cartOperations) && $cartSale->cartOperations->count()) {
                foreach ($cartSale->cartOperations as $cartOperation) {
                    $output .= '<tr>
                                                            <td>';
                    if (isset($cartOperation->product->image) && $cartOperation->product->image && file_exists($cartOperation->product->image)) {
                        $output .= '<img src="' . asset($cartOperation->product->image) . '"
                                                                        alt="" width="90">';
                    } else {
                        $output .= '<img src="' . asset('front_end_style/images/default.png') . '"
                                                                        alt="" width="100">';
                    }
                    $output .= '</td>
                                                            <td>';
                    if (isset($cartOperation->product->name_en)) {
                        $output .= $cartOperation->product->name_en;
                    } else {
                        $output .= '<span style="color: red;">Undefined</span>';
                    }
                    $output .= '</td>
                                                            <td>';
                    if (isset($cartOperation->quantity)) {
                        $output .= $cartOperation->quantity;
                    } else {
                        $output .= 0;
                    }
                    $output .= '</td>
                                                            <td>';
                    if (isset($cartOperation->product->sale_price)) {
                        $output .= $cartOperation->product->sale_price . '<small> $</small>';
                    } else {
                        $output .= '<span style="color: red;">Undefined</span>';
                    }
                    $output .= '</td>
                                                            <td>';
                    if (isset($cartOperation->quantity) && isset($cartOperation->product->sale_price)) {
                        $output .= $cartOperation->quantity * $cartOperation->product->sale_price . '<small> $</small>';
                    } else {
                        $output .= '<span style="color: red;">Undefined</span>';
                    }
                    $output .= '</td>

                                                        </tr>';
                }
            }
            $output .= '<tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>';


            return response()->json(['status' => true, 'output' => $output]);
        }
    }
}
