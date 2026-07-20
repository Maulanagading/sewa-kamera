<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Booking;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $totalBookings = Booking::count();
        $totalRevenue = Booking::where('status_pesanan', 'Selesai')->sum('total_harga');

        $recentBookings = Booking::with(['user', 'product'])->latest()->take(5)->get();

        // Data chart pesanan bulanan 
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = Booking::whereMonth('created_at', $i)->count();
        }

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalUsers',
            'totalBookings',
            'totalRevenue',
            'recentBookings',
            'chartData'
        ));
    }

    public function bookings()
    {
        $bookings = Booking::with(['user', 'product'])->latest()->get();
        return view('admin.bookings', compact('bookings'));
    }

    public function completeBooking($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status_pesanan !== 'Selesai') {
            $booking->update(['status_pesanan' => 'Selesai']);

            // Restok barang
            $product = $booking->product;
            if ($product) {
                $product->increment('stock', $booking->quantity);
            }
        }

        return back()->with('success', 'Pesanan telah diselesaikan dan stok berhasil dikembalikan.');
    }
}
