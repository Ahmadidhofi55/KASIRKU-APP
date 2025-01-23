<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Member;
use App\Models\Merek;
use App\Models\Pembayaran;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    //public function index()
    //{
    // return view('home');
    //}

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function kasir(): View

    {
        return view('kasir.kasir');
    }

    //fuction fect data tabel
    public function getTransaksiCount()
    {
        //menampilkan jumlah pendapatan perhari
        $totalharga = Transaksi::sum('total_harga');
        $transaksiCount = Transaksi::count();
        $pembayanCount = Pembayaran::count();
        $produkCount = Produk::count();
        //menampilkan jumlah produk yang habis
        $produkhabis = Produk::where('stok',0)->count();
        $jenisproduk = Jenis::count();
        $merek = Merek::count();
        $member = Member::count();
        //totalharga
        return response()->json(['total_harga'=> $totalharga,'count' => $transaksiCount,'pembayaran'=> $pembayanCount,'produk'=>$produkCount, 'produkhabis'=>$produkhabis ,'jenisproduk'=>$jenisproduk,'merek'=>$merek,'member'=>$member]);
    }
    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function owner(): View

    {

        return view('owner.owner');
    }

    public function profile()
    {
        return view('profile.profile');
    }
}
