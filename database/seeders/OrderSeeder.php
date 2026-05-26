<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Order 1
        $o1 = Order::create([
            'id' => 'VS827A1B',
            'nama' => 'valentino Santoso',
            'hp' => '08123456789',
            'alamat' => 'Jl. Merdeka No. 45',
            'kota' => 'Jakarta',
            'payment' => 'tf_bank',
            'total' => 688000,
            'status' => 'Pending',
            'created_at' => now()->subHours(5),
        ]);

        OrderItem::create([
            'order_id' => $o1->id,
            'product_id' => 2,
            'brand' => 'Compass',
            'name' => 'Compass Gazelle',
            'price' => 299000,
            'size' => '42',
            'qty' => 1,
            'image' => '/images/products/compass.jpg',
        ]);

        OrderItem::create([
            'order_id' => $o1->id,
            'product_id' => 1,
            'brand' => 'Ventela',
            'name' => 'Ventela Court Original',
            'price' => 389000,
            'size' => '41',
            'qty' => 1,
            'image' => '/images/products/ventela.jpg',
        ]);

        // Order 2
        $o2 = Order::create([
            'id' => 'VS910C2D',
            'nama' => 'Valen Tino',
            'hp' => '08987654321',
            'alamat' => 'Jl. Sudirman Kav 21',
            'kota' => 'Bandung',
            'payment' => 'cod',
            'total' => 1499000,
            'status' => 'Processed',
            'created_at' => now()->subDays(1),
        ]);

        OrderItem::create([
            'order_id' => $o2->id,
            'product_id' => 8,
            'brand' => 'Nike',
            'name' => 'Nike Air Force 1 Low',
            'price' => 1499000,
            'size' => '43',
            'qty' => 1,
            'image' => '/images/products/nike-af1.jpg',
        ]);
    }
}
