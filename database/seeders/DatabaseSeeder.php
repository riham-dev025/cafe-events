<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Service;
use App\Models\Resource;
use App\Models\Staff;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. SEED SYSTEM ROLES
        // ==========================================
        $adminRole = Role::create(['name' => 'Admin', 'description' => 'Store Owner']);
        $staffRole = Role::create(['name' => 'Staff', 'description' => 'Café Employee / Barista']);
        $customerRole = Role::create(['name' => 'Customer', 'description' => 'Regular Patron']);

        // ==========================================
        // 2. SEED DEMO USERS (With Hashed Passwords)
        // ==========================================
        User::create([
            'name' => 'Café Admin',
            'email' => 'admin@cafe.com',
            'password_hash' => Hash::make('password_admin'),
            'role_id' => $adminRole->id,
        ]);

        $staffUser = User::create([
            'name' => 'Barista Sam',
            'email' => 'sam@cafe.com',
            'password_hash' => Hash::make('password_staff'),
            'role_id' => $staffRole->id,
        ]);

        // Link employee details to the staff user profile
        Staff::create([
            'user_id' => $staffUser->id,
            'position' => 'Head Barista',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Jane Doe',
            'email' => 'jane@gmail.com',
            'password_hash' => Hash::make('jane123'),
            'role_id' => $customerRole->id,
        ]);

        // ==========================================
        // 3. SEED PHYSICAL RESOURCES (Your Cafe Assets)
        // ==========================================
        
        // Let's dynamically generate a beautiful array of 50 tables with different sizes!
        for ($i = 1; $i <= 50; $i++) {
            // Mix up the capacities: tables 1-20 (2-seaters), 21-40 (4-seaters), 41-50 (6-seaters)
            if ($i <= 20) {
                $capacity = 2;
            } elseif ($i <= 40) {
                $capacity = 4;
            } else {
                $capacity = 6;
            }

            Resource::create([
                'name' => "Table " . $i,
                'type' => 'table',
                'capacity' => $capacity,
                'status' => 'active',
            ]);
        }

        // Special dynamic locking spaces
        $privateRoom = Resource::create([
            'name' => 'Private Glass Room',
            'type' => 'room',
            'capacity' => 12,
            'status' => 'active',
        ]);

        $stage = Resource::create([
            'name' => 'Main Acoustic Stage Area',
            'type' => 'stage',
            'capacity' => 1, // acts as a singular binary block
            'status' => 'active',
        ]);

        $wholeVenue = Resource::create([
            'name' => 'Entire Café Venue Floor',
            'type' => 'venue',
            'capacity' => 150, // max safety fire capacity for total venue rental
            'status' => 'active',
        ]);

        // ==========================================
        // 4. SEED SERVICES / BOOKABLE OPTIONS
        // ==========================================
        
        // A standard table reservation (requires a table, warning at 100% since tables are individual slots)
        Service::create([
            'name' => 'General Table Reservation',
            'description' => 'Reserve a standard table for coffee, meals, or remote work.',
            'duration_minutes' => 90,
            'price' => 0.00, // free to book
            'capacity' => 6, // max seats on our largest single table
            'status' => 'active',
            'required_resource_type' => 'table',
            'warning_threshold_percentage' => 100,
        ]);

        // A group masterclass (locks down the private glass room, warnings flash at 50% capacity)
        Service::create([
            'name' => 'Espresso & Brewing Masterclass',
            'description' => 'Learn professional pour-over and espresso pulling techniques from our head barista.',
            'duration_minutes' => 60,
            'price' => 45.00,
            'capacity' => 6, // maximum of 6 tickets sold per session slot
            'status' => 'active',
            'required_resource_type' => 'room',
            'warning_threshold_percentage' => 50, // Trigger FOMO warning badge early!
        ]);

        // A full cafe rental (blocks everything, locks down the entire venue)
        Service::create([
            'name' => 'Private Event Venue Hire',
            'description' => 'Rent out the entire café premises for weddings, corporate parties, or private birthdays.',
            'duration_minutes' => 240, // 4 hour blocks
            'price' => 500.00,
            'capacity' => 1, // Only 1 buyout booking allowed per time frame
            'status' => 'active',
            'required_resource_type' => 'venue',
            'warning_threshold_percentage' => 100,
        ]);

        // ==========================================
        // 5. SEED PRODUCTS (Menu Catalog)
        // ==========================================
       
       $drinksCategory = \App\Models\ProductCategory::create([
            'name' => 'Beverages',
            'description' => 'Hot and cold handcrafted cafe drinks.'
        ]);

        $bakeryCategory = \App\Models\ProductCategory::create([
            'name' => 'Bakery',
            'description' => 'Freshly baked pastries and treats.'
        ]);
       
        Product::create([
            'category_id'=> $drinksCategory->id,
            'name' => 'Ceremonial Matcha Latte',
            'description' => 'Uji ceremonial grade matcha whisked to order with organic oat milk.',
            'price' => 5.50,
            'stock' => 100,
            'status' => 'available',
        ]);

        Product::create([
            'category_id'=> $bakeryCategory->id,
            'name' => 'Almond Croissant',
            'description' => 'Flaky house-baked French pastry filled with sweet almond frangipane paste.',
            'price' => 4.25,
            'stock' => 15, // Low stock example to test frontend limit guards!
            'status' => 'available',
        ]);
    }
}