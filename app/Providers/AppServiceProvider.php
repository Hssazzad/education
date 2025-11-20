<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Dynamic menu for AdminLTE sidebar
        View::composer('adminlte::partials.sidebar.left-sidebar', function($view) {
            // Get main menus (parent_id null) with all nested children
            // 'children.children.children' প্যাটার্ন ব্যবহার করে আমরা একাধিক স্তর লোড করতে পারি।
            // সাধারণ অ্যাপ্লিকেশনের জন্য 3 থেকে 4 স্তর যথেষ্ট।
            $menus = Menu::with('children.children.children')
                         ->whereNull('parent_id')
                         ->orderBy('sequence')
                         ->get();

            // Pass to sidebar view as $adminlte_menu
            $view->with('adminlte_menu', $menus);
        });
    }
}
