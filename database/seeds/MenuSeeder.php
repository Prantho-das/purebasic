<?php

use Illuminate\Database\Seeder;
use App\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // Header: Dashboard
        $dashboard = Menu::create([
            'name' => 'Dashboard',
            'slug' => 'dashboard',
            'menu_type' => 'header',
            'sort_order' => 1,
            'link_type' => 'custom',
            'custom_url' => '/admin/dashboard',
            'is_active' => true,
        ]);

        // Header: Students
        $students = Menu::create([
            'name' => 'Students',
            'slug' => 'students',
            'menu_type' => 'header',
            'sort_order' => 2,
            'link_type' => 'custom',
            'custom_url' => '/admin/students',
            'is_active' => true,
        ]);

        // Nested under Students: Batches
        Menu::create([
            'name' => 'Batches',
            'slug' => 'batches',
            'parent_id' => $students->id,
            'menu_type' => 'header',
            'sort_order' => 1,
            'link_type' => 'model',
            'model_name' => 'Batch',
            'route_name' => 'batches.index',
            'is_active' => true,
        ]);

        // Nested under Students: Classes
        Menu::create([
            'name' => 'Classes',
            'slug' => 'classes',
            'parent_id' => $students->id,
            'menu_type' => 'header',
            'sort_order' => 2,
            'link_type' => 'model',
            'model_name' => 'Class',
            'route_name' => 'classes.index',
            'is_active' => true,
        ]);

        // Footer: Contact
        Menu::create([
            'name' => 'Contact Us',
            'slug' => 'contact',
            'menu_type' => 'footer',
            'sort_order' => 1,
            'link_type' => 'custom',
            'custom_url' => '/contact',
            'is_active' => true,
        ]);

        // Footer: Privacy
        Menu::create([
            'name' => 'Privacy Policy',
            'slug' => 'privacy',
            'menu_type' => 'footer',
            'sort_order' => 2,
            'link_type' => 'custom',
            'custom_url' => '/privacy',
            'is_active' => true,
        ]);
    }
}