<?php

namespace App\Providers;

use App\Models\CartTemp;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        Paginator::useBootstrap();
        View::composer('*', function ($view) {
            $public_user_types = ['Super Admin', 'Customer'];
            $public_products = Product::where('status', 1)->orderBy('created_at', 'asc')->get();
            $public_contact = ContactUs::first();


            $public_categories = Category::where('status',1)->get();
        view()->share([
            'public_categories' => $public_categories,
            'public_user_types' => $public_user_types,
            'public_products' => $public_products,
            'public_contact' => $public_contact
        ]);
    });
    }
}
