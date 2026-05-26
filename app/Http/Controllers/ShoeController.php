<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class ShoeController extends Controller
{
    public function getProducts()
    {
        return [
            // LOKAL
            [
                'id' => 1,
                'brand' => 'Ventela',
                'name' => 'Ventela Court Original',
                'price' => 389000,
                'original_price' => null,
                'discount' => null,
                'image' => '/images/products/ventela.jpg',
                'is_new' => true,
                'reviews' => 128,
                'category' => 'casual',
                'type' => 'lokal',
            ],
            [
                'id' => 2,
                'brand' => 'Compass',
                'name' => 'Compass Gazelle',
                'price' => 299000,
                'original_price' => 350000,
                'discount' => 14,
                'image' => '/images/products/compass.jpg',
                'is_new' => false,
                'reviews' => 94,
                'category' => 'casual',
                'type' => 'lokal',
            ],
            [
                'id' => 3,
                'brand' => 'Brodo',
                'name' => 'Brodo Leather Derby',
                'price' => 799000,
                'original_price' => null,
                'discount' => null,
                'image' => '/images/products/brodo.jpg',
                'is_new' => true,
                'reviews' => 56,
                'category' => 'formal',
                'type' => 'lokal',
            ],
            [
                'id' => 4,
                'brand' => 'Geoff Max',
                'name' => 'Geoff Max Authorized',
                'price' => 450000,
                'original_price' => 520000,
                'discount' => 13,
                'image' => '/images/products/geoffmax.jpg',
                'is_new' => false,
                'reviews' => 210,
                'category' => 'casual',
                'type' => 'lokal',
            ],
            [
                'id' => 5,
                'brand' => 'Aerostreet',
                'name' => 'Aerostreet Running Pro',
                'price' => 189000,
                'original_price' => null,
                'discount' => null,
                'image' => '/images/products/aerostreet.jpg',
                'is_new' => true,
                'reviews' => 340,
                'category' => 'sport',
                'type' => 'lokal',
            ],
            [
                'id' => 6,
                'brand' => 'Saint Barkley',
                'name' => 'Saint Barkley Monde',
                'price' => 519000,
                'original_price' => null,
                'discount' => null,
                'image' => '/images/products/saintbarkley.jpg',
                'is_new' => false,
                'reviews' => 77,
                'category' => 'casual',
                'type' => 'lokal',
            ],

            // INTERNASIONAL
            [
                'id' => 7,
                'brand' => 'Nike',
                'name' => 'Nike Air Max 270',
                'price' => 1899000,
                'original_price' => 2100000,
                'discount' => 10,
                'image' => '/images/products/nike-am270.jpg',
                'is_new' => false,
                'reviews' => 502,
                'category' => 'casual',
                'type' => 'internasional',
            ],
            [
                'id' => 8,
                'brand' => 'Nike',
                'name' => 'Nike Air Force 1 Low',
                'price' => 1499000,
                'original_price' => null,
                'discount' => null,
                'image' => '/images/products/nike-af1.jpg',
                'is_new' => true,
                'reviews' => 389,
                'category' => 'casual',
                'type' => 'internasional',
            ],
            [
                'id' => 9,
                'brand' => 'Adidas',
                'name' => 'Adidas Stan Smith',
                'price' => 1299000,
                'original_price' => 1500000,
                'discount' => 13,
                'image' => '/images/products/adidas-stan.jpg',
                'is_new' => false,
                'reviews' => 415,
                'category' => 'casual',
                'type' => 'internasional',
            ],
            [
                'id' => 10,
                'brand' => 'Adidas',
                'name' => 'Adidas Ultraboost 23',
                'price' => 2399000,
                'original_price' => null,
                'discount' => null,
                'image' => '/images/products/adidas-ub.jpg',
                'is_new' => true,
                'reviews' => 267,
                'category' => 'sport',
                'type' => 'internasional',
            ],
            [
                'id' => 11,
                'brand' => 'New Balance',
                'name' => 'New Balance 574 Core',
                'price' => 1199000,
                'original_price' => null,
                'discount' => null,
                'image' => '/images/products/nb574.jpg',
                'is_new' => false,
                'reviews' => 183,
                'category' => 'casual',
                'type' => 'internasional',
            ],
            [
                'id' => 12,
                'brand' => 'Vans',
                'name' => 'Vans Old Skool Classic',
                'price' => 899000,
                'original_price' => 1000000,
                'discount' => 10,
                'image' => '/images/products/vans.jpg',
                'is_new' => false,
                'reviews' => 621,
                'category' => 'casual',
                'type' => 'internasional',
            ],
            [
                'id' => 13,
                'brand' => 'Converse',
                'name' => 'Converse Chuck Taylor 70',
                'price' => 999000,
                'original_price' => null,
                'discount' => null,
                'image' => '/images/products/converse.jpg',
                'is_new' => true,
                'reviews' => 298,
                'category' => 'casual',
                'type' => 'internasional',
            ],
            [
                'id' => 14,
                'brand' => 'Puma',
                'name' => 'Puma Suede Classic XXI',
                'price' => 849000,
                'original_price' => 950000,
                'discount' => 11,
                'image' => '/images/products/puma.jpg',
                'is_new' => false,
                'reviews' => 156,
                'category' => 'casual',
                'type' => 'internasional',
            ],
        ];
    }

    public function home()
    {
        $products = $this->getProducts();
        $featuredProducts = array_slice($products, 0, 6);
        return view('pages.home', compact('featuredProducts'));
    }

    public function products(Request $request)
    {
        $products = $this->getProducts();

        if ($request->has('search') && $request->search !== '') {
            $search = strtolower($request->search);
            $products = array_filter($products, function ($p) use ($search) {
                return str_contains(strtolower($p['name']), $search) ||
                    str_contains(strtolower($p['brand']), $search);
            });
        }
        if ($request->has('type') && $request->type !== '') {
            $products = array_filter($products, fn($p) => $p['type'] === $request->type);
        }
        if ($request->has('category') && $request->category !== '') {
            $products = array_filter($products, fn($p) => $p['category'] === $request->category);
        }

        $brandFilterName = null;
        $brandFilterSlug = null;
        if ($request->filled('brand')) {
            $brandFilterName = $this->resolveBrandFilter($request->brand);
            if ($brandFilterName) {
                $products = array_filter(
                    $products,
                    fn($p) => strcasecmp($p['brand'], $brandFilterName) === 0
                );
                $brandFilterSlug = $this->canonicalSlugForBrand($brandFilterName);
            }
        }

        return view('pages.products', [
            'products' => array_values($products),
            'search' => $request->search ?? '',
            'brandFilterName' => $brandFilterName,
            'brandFilterSlug' => $brandFilterSlug,
        ]);
    }

    public function brands()
    {
        return view('pages.brands');
    }

    public function brandReviews(string $slug)
    {
        $slug = strtolower($slug);
        $catalog = $this->getBrandReviewsCatalog();
        if (!isset($catalog[$slug])) {
            abort(404);
        }

        return view('pages.brand-reviews', [
            'slug' => $slug,
            'page' => $catalog[$slug],
        ]);
    }

    public function orderReceipt()
    {
        $order = session('last_order');
        if (!$order || !is_array($order)) {
            return redirect()->route('home')->with('error', 'Belum ada nota pembelian. Silakan checkout dulu.');
        }

        return view('cart.success', compact('order'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    // ===== CART =====
    public function cartIndex()
    {
        $cart = session('cart', []);
        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));
        return view('cart.index', compact('cart', 'subtotal'));
    }

    public function cartAdd(Request $request)
    {
        $products = $this->getProducts();
        $id = $request->product_id;
        $size = $request->size ?? '42';
        $product = collect($products)->firstWhere('id', (int) $id);

        if (!$product) {
            return back()->with('error', 'Produk tidak ditemukan.');
        }

        $cart = session('cart', []);
        $key = $id . '_' . $size;

        if (isset($cart[$key])) {
            $cart[$key]['qty'] += 1;
        } else {
            $cart[$key] = [
                'id'    => $product['id'],
                'brand' => $product['brand'],
                'name'  => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'size'  => $size,
                'qty'   => 1,
            ];
        }

        session(['cart' => $cart]);

        // Jika dari tombol "Pesan Sekarang", langsung redirect ke checkout
        if ($request->redirect === 'checkout') {
            return redirect()->route('checkout');
        }

        return back()->with('success', $product['name'] . ' ditambahkan ke keranjang!');
    }

    public function cartUpdate(Request $request, $key)
    {
        $cart = session('cart', []);
        if (isset($cart[$key])) {
            if ($request->action === 'increase') {
                $cart[$key]['qty'] += 1;
            } elseif ($request->action === 'decrease') {
                $cart[$key]['qty'] -= 1;
                if ($cart[$key]['qty'] <= 0) {
                    unset($cart[$key]);
                }
            }
        }
        session(['cart' => $cart]);
        return back();
    }

    public function cartRemove($key)
    {
        $cart = session('cart', []);
        unset($cart[$key]);
        session(['cart' => $cart]);
        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function cartClear()
    {
        session()->forget('cart');
        return back()->with('success', 'Keranjang dikosongkan.');
    }

    // ===== CHECKOUT =====
    public function checkout()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }
        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));
        return view('cart.checkout', compact('cart', 'subtotal'));
    }

    public function checkoutProcess(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string',
            'hp'      => 'required|string',
            'alamat'  => 'required|string',
            'kota'    => 'required|string',
            'payment' => 'required|string',
        ]);

        $cart = session('cart', []);
        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));

        $order = [
            'id'      => strtoupper(substr(md5(time()), 0, 8)),
            'nama'    => $request->nama,
            'hp'      => $request->hp,
            'alamat'  => $request->alamat,
            'kota'    => $request->kota,
            'payment' => $request->payment,
            'total'   => $subtotal,
            'items'   => $cart,
        ];

        // Simpan ke Database untuk Admin Panel
        $dbOrder = Order::create([
            'id'      => $order['id'],
            'nama'    => $order['nama'],
            'hp'      => $order['hp'],
            'alamat'  => $order['alamat'],
            'kota'    => $order['kota'],
            'payment' => $order['payment'],
            'total'   => $order['total'],
            'status'  => 'Pending',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'   => $dbOrder->id,
                'product_id' => $item['id'],
                'brand'      => $item['brand'],
                'name'       => $item['name'],
                'price'      => $item['price'],
                'size'       => $item['size'],
                'qty'        => $item['qty'],
                'image'      => $item['image'],
            ]);
        }

        session()->forget('cart');
        session(['last_order' => $order]);

        return view('cart.success', compact('order'));
    }

    private function canonicalSlugForBrand(string $brand): string
    {
        return match ($brand) {
            'Geoff Max' => 'geoff-max',
            'Saint Barkley' => 'saint-barkley',
            'New Balance' => 'new-balance',
            default => strtolower(str_replace(' ', '-', $brand)),
        };
    }

    private function resolveBrandFilter(?string $query): ?string
    {
        if ($query === null || trim($query) === '') {
            return null;
        }

        $k = strtolower(str_replace([' ', '_'], '-', trim($query)));

        $map = [
            'ventela' => 'Ventela',
            'compass' => 'Compass',
            'brodo' => 'Brodo',
            'aerostreet' => 'Aerostreet',
            'geoffmax' => 'Geoff Max',
            'geoff-max' => 'Geoff Max',
            'saintbarkley' => 'Saint Barkley',
            'saint-barkley' => 'Saint Barkley',
            'nike' => 'Nike',
            'adidas' => 'Adidas',
            'newbalance' => 'New Balance',
            'new-balance' => 'New Balance',
            'vans' => 'Vans',
            'converse' => 'Converse',
            'puma' => 'Puma',
        ];

        return $map[$k] ?? null;
    }

    /**
     * @return array<string, array{brand: string, avg: float, count: int, reviews: list<array{author: string, rating: int, text: string, when: string}>}>
     */
    private function getBrandReviewsCatalog(): array
    {
        $mk = fn(array $reviews): array => $reviews;

        return [
            'ventela' => [
                'brand' => 'Ventela',
                'avg' => 4.8,
                'count' => 612,
                'reviews' => $mk([
                    ['author' => 'Raka D.', 'rating' => 5, 'text' => 'Sol empuk, jahitan rapi. Cocok buat jalan harian di kampus.', 'when' => '5 hari lalu'],
                    ['author' => 'Intan M.', 'rating' => 5, 'text' => 'Warnanya sama seperti foto. Pengiriman cepat dari V-Store.', 'when' => '2 minggu lalu'],
                    ['author' => 'Bagus H.', 'rating' => 4, 'text' => 'Sizing pas ikuti chart. Harga segini worth it untuk lokal.', 'when' => '1 bulan lalu'],
                ]),
            ],
            'compass' => [
                'brand' => 'Compass',
                'avg' => 4.7,
                'count' => 540,
                'reviews' => $mk([
                    ['author' => 'Salsa K.', 'rating' => 5, 'text' => 'Kanvas tebal, klasik banget. Sudah repeat order warna lain.', 'when' => '3 hari lalu'],
                    ['author' => 'Yoga P.', 'rating' => 4, 'text' => 'Retro look juara. Agak keras pertama pakai tapi cepat muai.', 'when' => '12 hari lalu'],
                    ['author' => 'Fitri A.', 'rating' => 5, 'text' => 'Brand kesukaan dari SMA. Di V-Store ori dan packing aman.', 'when' => '3 minggu lalu'],
                ]),
            ],
            'brodo' => [
                'brand' => 'Brodo',
                'avg' => 4.9,
                'count' => 288,
                'reviews' => $mk([
                    ['author' => 'Andre W.', 'rating' => 5, 'text' => 'Kulitnya halus, dipakai meeting keliatan sharp.', 'when' => '1 minggu lalu'],
                    ['author' => 'Laras T.', 'rating' => 5, 'text' => 'Hadiah untuk suami, ukuran sesuai. Dia suka banget.', 'when' => '18 hari lalu'],
                    ['author' => 'Dimas R.', 'rating' => 4, 'text' => 'Perlu perawatan leather sedikit, tapi kualitas top.', 'when' => '2 bulan lalu'],
                ]),
            ],
            'aerostreet' => [
                'brand' => 'Aerostreet',
                'avg' => 4.5,
                'count' => 1034,
                'reviews' => $mk([
                    ['author' => 'Omar S.', 'rating' => 5, 'text' => 'Buat lari pagi ringan di kaki. Harga bersahabat.', 'when' => '4 hari lalu'],
                    ['author' => 'Wulan E.', 'rating' => 4, 'text' => 'Anak sekolah pakai nyaman. Motifnya banyak pilihan.', 'when' => '10 hari lalu'],
                    ['author' => 'Iqbal N.', 'rating' => 5, 'text' => 'Sudah beli beberapa pasang di sini, konsisten bagus.', 'when' => '1 bulan lalu'],
                ]),
            ],
            'geoff-max' => [
                'brand' => 'Geoff Max',
                'avg' => 4.6,
                'count' => 421,
                'reviews' => $mk([
                    ['author' => 'Kevin L.', 'rating' => 5, 'text' => 'Street style kece, detailnya mirip yang dipakai seleb.', 'when' => '6 hari lalu'],
                    ['author' => 'Putri C.', 'rating' => 4, 'text' => 'Empuk dan stabil buat jalan jauh.', 'when' => '20 hari lalu'],
                    ['author' => 'Rizky F.', 'rating' => 5, 'text' => 'Brand lokal favorit, pengiriman ke luar Jawa tetap aman.', 'when' => '5 minggu lalu'],
                ]),
            ],
            'saint-barkley' => [
                'brand' => 'Saint Barkley',
                'avg' => 4.7,
                'count' => 195,
                'reviews' => $mk([
                    ['author' => 'Hendra V.', 'rating' => 5, 'text' => 'Casual tapi kelas atas. Dipadu jeans cakep.', 'when' => '8 hari lalu'],
                    ['author' => 'Nadia S.', 'rating' => 4, 'text' => 'Box sampai mulus, ukuran standar.', 'when' => '3 minggu lalu'],
                    ['author' => 'Gilang A.', 'rating' => 5, 'text' => 'Tahan lama, sudah setahun pakai masih layak.', 'when' => '2 bulan lalu'],
                ]),
            ],
            'nike' => [
                'brand' => 'Nike',
                'avg' => 4.8,
                'count' => 2102,
                'reviews' => $mk([
                    ['author' => 'Michael B.', 'rating' => 5, 'text' => 'Air unit kerasa banget. Running ringan.', 'when' => '2 hari lalu'],
                    ['author' => 'Jessica O.', 'rating' => 5, 'text' => 'AF1 klasik, dapat yang ori. Legit.', 'when' => '9 hari lalu'],
                    ['author' => 'Steven C.', 'rating' => 4, 'text' => 'Sempit sedikit di bagian depan, naik setengah size solved.', 'when' => '1 bulan lalu'],
                ]),
            ],
            'adidas' => [
                'brand' => 'Adidas',
                'avg' => 4.7,
                'count' => 1876,
                'reviews' => $mk([
                    ['author' => 'Melisa K.', 'rating' => 5, 'text' => 'Stan Smith timeless. Putihnya mudah dibersihkan.', 'when' => '5 hari lalu'],
                    ['author' => 'Bayu M.', 'rating' => 5, 'text' => 'Ultraboost empuk banget buat commute.', 'when' => '11 hari lalu'],
                    ['author' => 'Clara J.', 'rating' => 4, 'text' => 'Packing rapi, barcode dan tag sesuai.', 'when' => '4 minggu lalu'],
                ]),
            ],
            'new-balance' => [
                'brand' => 'New Balance',
                'avg' => 4.8,
                'count' => 756,
                'reviews' => $mk([
                    ['author' => 'Adit Y.', 'rating' => 5, 'text' => '574 nyaman seharian, retro vibe.', 'when' => '7 hari lalu'],
                    ['author' => 'Rara P.', 'rating' => 5, 'text' => 'Brand ini cocok buat kaki lebar.', 'when' => '15 hari lalu'],
                    ['author' => 'Fajar K.', 'rating' => 4, 'text' => 'Warna sesuai listing, tidak ada defect.', 'when' => '6 minggu lalu'],
                ]),
            ],
            'vans' => [
                'brand' => 'Vans',
                'avg' => 4.7,
                'count' => 1432,
                'reviews' => $mk([
                    ['author' => 'Dito R.', 'rating' => 5, 'text' => 'Old Skool ikonik. Grip sole mantap.', 'when' => '3 hari lalu'],
                    ['author' => 'Amira Z.', 'rating' => 5, 'text' => 'Suka stripe sampingnya, cocok casual.', 'when' => '2 minggu lalu'],
                    ['author' => 'Reza H.', 'rating' => 4, 'text' => 'Awal agak kaku, setelah dipakai beberapa hari pas.', 'when' => '1 bulan lalu'],
                ]),
            ],
            'converse' => [
                'brand' => 'Converse',
                'avg' => 4.6,
                'count' => 921,
                'reviews' => $mk([
                    ['author' => 'Sinta G.', 'rating' => 5, 'text' => 'Chuck 70 lebih tebal dari All Star biasa, worth it.', 'when' => '4 hari lalu'],
                    ['author' => 'Doni P.', 'rating' => 4, 'text' => 'Kanvas premium, sol awet.', 'when' => '19 hari lalu'],
                    ['author' => 'Lia W.', 'rating' => 5, 'text' => 'Buat konser dan jalan-jalan serba cocok.', 'when' => '7 minggu lalu'],
                ]),
            ],
            'puma' => [
                'brand' => 'Puma',
                'avg' => 4.5,
                'count' => 598,
                'reviews' => $mk([
                    ['author' => 'Taufik S.', 'rating' => 5, 'text' => 'Suede halus, warna bold.', 'when' => '6 hari lalu'],
                    ['author' => 'Rini K.', 'rating' => 4, 'text' => 'Ringan dan breathable.', 'when' => '22 hari lalu'],
                    ['author' => 'Eko D.', 'rating' => 5, 'text' => 'Harga promo pas banget, barang mulus.', 'when' => '3 bulan lalu'],
                ]),
            ],
        ];
    }
}