<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Service;
use App\Models\Resource;
use App\Models\Staff;
use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
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

        $staffMembers = [
    
    ['name' => 'Emma Carter', 'email' => 'emma@cafe.com', 'position' => 'Barista'],
    ['name' => 'Lucas Reed', 'email' => 'lucas@cafe.com', 'position' => 'Server'],
    ['name' => 'Sophia Kim', 'email' => 'sophia@cafe.com', 'position' => 'Event Coordinator'],
];

foreach ($staffMembers as $member) {

    $user = User::create([
        'name' => $member['name'],
        'email' => $member['email'],
        'password_hash' => Hash::make('password_staff'),
        'role_id' => $staffRole->id,
    ]);

    Staff::create([
        'user_id' => $user->id,
        'position' => $member['position'],
        'status' => 'active',
    ]);
}
//adding categories
$dessertsCategory = ProductCategory::create([
    'name' => 'Desserts',
    'description' => 'Signature desserts.'
]);

$coffeeCategory = ProductCategory::create([
    'name' => 'Coffee',
    'description' => 'Espresso based drinks.'
]);

$teaCategory = ProductCategory::create([
    'name' => 'Tea',
    'description' => 'Tea and matcha.'
]);

$giftCategory = ProductCategory::create([
    'name' => 'Gifts',
    'description' => 'Gift cards and plushies.'
]);

//more products
Product::create([
    'category_id'=>$coffeeCategory->id,
    'name'=>'Espresso',
    'description'=>'Double espresso shot.',
    'price'=>2.50,
    'stock'=>80,
    'status'=>'available'
]);

Product::create([
    'category_id'=>$coffeeCategory->id,
    'name'=>'Cappuccino',
    'description'=>'Classic Italian cappuccino.',
    'price'=>4.00,
    'stock'=>70,
    'status'=>'available'
]);

Product::create([
    'category_id'=>$coffeeCategory->id,
    'name'=>'Iced Latte',
    'description'=>'Cold espresso with milk.',
    'price'=>4.75,
    'stock'=>55,
    'status'=>'available'
]);
Product::create([
    'category_id'=>$teaCategory->id,
    'name'=>'Strawberry Matcha',
    'description'=>'Fresh strawberry puree with ceremonial matcha.',
    'price'=>6.50,
    'stock'=>30,
    'status'=>'available'
]);

Product::create([
    'category_id'=>$teaCategory->id,
    'name'=>'Peach Iced Tea',
    'description'=>'Fresh brewed peach tea.',
    'price'=>3.75,
    'stock'=>45,
    'status'=>'available'
]);

Product::create([
    'category_id'=>$dessertsCategory->id,
    'name'=>'Basque Cheesecake',
    'description'=>'Creamy burnt cheesecake.',
    'price'=>6.25,
    'stock'=>12,
    'status'=>'available'
]);

Product::create([
    'category_id'=>$dessertsCategory->id,
    'name'=>'Chocolate Brownie',
    'description'=>'Rich fudgy brownie.',
    'price'=>3.50,
    'stock'=>5,
    'status'=>'available'
]);

Product::create([
    'category_id'=>$dessertsCategory->id,
    'name'=>'Red Velvet Cake',
    'description'=>'Classic cream cheese frosting.',
    'price'=>5.75,
    'stock'=>8,
    'status'=>'available'
]);

Product::create([
    'category_id'=>$dessertsCategory->id,
    'name'=>'Macaron Box',
    'description'=>'Six assorted macarons.',
    'price'=>9.50,
    'stock'=>18,
    'status'=>'available'
]);

Product::create([
    'category_id'=>$giftCategory->id,
    'name'=>'Nook & Peony Plush Bear',
    'description'=>'Limited edition plush.',
    'price'=>18.00,
    'stock'=>10,
    'status'=>'available'
]);

Product::create([
    'category_id'=>$giftCategory->id,
    'name'=>'Gift Card ($25)',
    'description'=>'Redeemable café gift card.',
    'price'=>25.00,
    'stock'=>100,
    'status'=>'available'
]);

Product::create([
    'category_id'=>$giftCategory->id,
    'name'=>'Ceramic Café Mug',
    'description'=>'Official Nook & Peony mug.',
    'price'=>15.00,
    'stock'=>20,
    'status'=>'available'
]);
//adding services 
Service::create([
    'name'=>'Afternoon Tea Experience',
    'description'=>'Traditional afternoon tea set.',
    'duration_minutes'=>120,
    'price'=>30,
    'capacity'=>8,
    'status'=>'active',
    'required_resource_type'=>'room',
    'warning_threshold_percentage'=>75,
]);

Service::create([
    'name'=>'Book Club Evening',
    'description'=>'Weekly reading session.',
    'duration_minutes'=>120,
    'price'=>10,
    'capacity'=>20,
    'status'=>'active',
    'required_resource_type'=>'room',
    'warning_threshold_percentage'=>80,
]);

Service::create([
    'name'=>'Live Acoustic Night',
    'description'=>'Enjoy local musicians.',
    'duration_minutes'=>180,
    'price'=>15,
    'capacity'=>50,
    'status'=>'active',
    'required_resource_type'=>'stage',
    'warning_threshold_percentage'=>70,
]);

Service::create([
    'name'=>'Birthday Celebration Package',
    'description'=>'Reserved decorated room.',
    'duration_minutes'=>180,
    'price'=>150,
    'capacity'=>12,
    'status'=>'active',
    'required_resource_type'=>'room',
    'warning_threshold_percentage'=>100,
]);

Product::create([
    'category_id'=>$dessertsCategory->id,
    'name'=>'Pistachio Tart',
    'description'=>'Buttery tart with pistachio cream.',
    'price'=>6,
    'stock'=>2,
    'status'=>'available'
]);

Product::create([
    'category_id'=>$giftCategory->id,
    'name'=>'Mini Bunny Plush',
    'description'=>'Cute plush collectible.',
    'price'=>12,
    'stock'=>1,
    'status'=>'available'
]);

Product::create([
    'category_id'=>$coffeeCategory->id,
    'name'=>'Cold Brew',
    'description'=>'Slow-steeped coffee.',
    'price'=>5,
    'stock'=>0,
    'status'=>'out_of_stock'
]);

    }

    
    
}