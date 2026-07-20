<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'cart' => 'required|string',
        ]);

        $cart = json_decode($request->cart, true);
        if (!$cart || count($cart) === 0) {
            return back()->with('error', 'Keranjang Anda kosong!');
        }

        $startDate = Carbon::parse($request->start_date);
        $paymentRef = 'INV-' . strtoupper(uniqid());

        $totalAll = 0;
        $bookingIds = [];
        $itemsDesc = [];

        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            if (!$product) continue;

            $days = (int) $item['days'];
            $qty = (int) $item['qty'];
            
            // Logika promo: Sewa 3 hari gratis 1 hari (sama seperti di js)
            $paidDays = $days - floor($days / 3);
            $totalHarga = $product->price * $qty * $paidDays;
            
            $endDate = $startDate->copy()->addDays($days);

            $booking = Booking::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'tanggal_mulai' => $startDate,
                'tanggal_selesai' => $endDate,
                'quantity' => $qty,
                'total_harga' => $totalHarga,
                'status_pesanan' => 'Menunggu Pembayaran'
            ]);

            $totalAll += $totalHarga;
            $bookingIds[] = $booking->id;
            $itemsDesc[] = $qty . "x " . $product->name . " (" . $days . " hari)"; // 'name' in Product
        }

        if (count($bookingIds) === 0) {
            return back()->with('error', 'Item tidak valid.');
        }

        session([
            'payment_ref' => $paymentRef,
            'payment_total' => $totalAll,
            'payment_items' => implode(', ', $itemsDesc),
            'payment_booking_ids' => $bookingIds
        ]);

        return redirect()->route('booking.payment');
    }

    public function payment()
    {
        if (!session('payment_ref')) {
            return redirect()->route('katalog');
        }

        return view('booking.payment');
    }

    public function confirm(Request $request)
    {
        if (!session('payment_ref')) {
            return redirect()->route('katalog');
        }

        $bookingIds = session('payment_booking_ids', []);
        
        // Update status menjadi Dibayar dan Kurangi Stok Produk
        $bookings = Booking::whereIn('id', $bookingIds)->get();
        foreach($bookings as $booking) {
            $booking->update(['status_pesanan' => 'Dibayar']);
            
            // Kurangi stok
            $product = $booking->product;
            if ($product) {
                // Jangan sampai stok minus
                $newStock = max(0, $product->stock - $booking->quantity);
                $product->update(['stock' => $newStock]);
            }
        }

        $ref = session('payment_ref');
        $items = session('payment_items');
        $total = number_format(session('payment_total'), 0, ',', '.');
        $userName = Auth::user()->name;

        $msg = "Halo Admin Gading Rental!\n\nSaya sudah melakukan pembayaran via DANA.\n";
        $msg .= "Nama: $userName\n";
        $msg .= "ID Pesanan: $ref\n";
        $msg .= "Daftar Alat: $items\n";
        $msg .= "Total Bayar: Rp $total\n\n";
        $msg .= "Berikut saya lampirkan bukti transfernya:";

        session()->forget(['payment_ref', 'payment_total', 'payment_items', 'payment_booking_ids']);

        // Nomor WA Admin (ganti sesuai dengan yang asli)
        $phone = "628999086629"; 
        $waLink = "https://wa.me/" . $phone . "?text=" . rawurlencode($msg);

        return redirect()->away($waLink);
    }
}
