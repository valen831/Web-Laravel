<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ShoeController;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Email atau password salah.');
    }

    public function dashboard()
    {
        $products = (new ShoeController)->getProducts();
        $stats = [
            'total_produk'    => count($products),
            'total_pesanan'   => Order::count(),
            'total_pelanggan' => User::count(),
            'total_brand'     => count(array_unique(array_column($products, 'brand'))),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function produk()
    {
        $products = (new ShoeController)->getProducts();
        return view('admin.produk', compact('products'));
    }

    public function pesanan()
    {
        $orders = Order::with('items')->orderBy('created_at', 'desc')->get();
        return view('admin.pesanan', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'string', 'in:Pending,Processed,Completed,Cancelled'],
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan #' . $id . ' berhasil diperbarui.');
    }

    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return back()->with('success', 'Pesanan #' . $id . ' berhasil dihapus.');
    }

    public function pelanggan()
    {
        $customers = User::orderBy('created_at', 'desc')->get();
        return view('admin.pelanggan', compact('customers'));
    }

    public function brand()
    {
        $products = (new ShoeController)->getProducts();
        $brands = [];
        foreach ($products as $p) {
            $brandName = $p['brand'];
            if (!isset($brands[$brandName])) {
                $brands[$brandName] = [
                    'name' => $brandName,
                    'total_produk' => 0,
                    'total_price' => 0,
                ];
            }
            $brands[$brandName]['total_produk']++;
            $brands[$brandName]['total_price'] += $p['price'];
        }
        foreach ($brands as &$b) {
            $b['avg_price'] = $b['total_price'] / $b['total_produk'];
        }
        return view('admin.brand', compact('brands'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}