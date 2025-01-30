<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Merek;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supliyer;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    //menampilkan data di index
    public  function index()
    {
        return view('produk.index');
    }


    public function get(Request $request)
    {
        if ($request->ajax()) {
            // Memuat data produk beserta relasinya
            $data = Produk::with(['merek', 'jenis', 'supliyer'])->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('merek', function ($row) {
                    return $row->merek->name ?? '-'; // Mengambil nama merek
                })
                ->addColumn('jenis', function ($row) {
                    return $row->jenis->name ?? '-'; // Mengambil nama jenis
                })
                ->addColumn('supliyer', function ($row) {
                    return $row->supliyer->name ?? '-'; // Mengambil nama supliyer
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                          <a href="javascript:void(0)" id="btn-edit-post" data-id="' . $row->id . '" class="edit btn btn-success btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="javascript:void(0)" data-id="' . $row->id . '" id="btn-edit-post2" class="edit btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button onclick="deleteData(' . $row->id . ')" class="delete btn btn-danger btn-sm mr-2">
                            <i class="fas fa-trash"></i>
                        </button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function reading()
    {
        $jenis = Jenis::latest()->get();
        $merek = Merek::latest()->get();
        $supliyer = Supliyer::latest()->get();
        return view('produk.create', compact('jenis', 'merek', 'supliyer'));
    }

    public function store(Request $request)
    {
        // define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'qr_produk' => 'required',
            'qr_img' => 'required|image|mimes:png,jpg',
            'img' => 'required|image|mimes:png,jpg,svg,jfif|max:2048',
            'merek_id' => 'required',
            'jenis_id' => 'required',
            'supliyer_id' => 'required',
            'stok' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
            'diskon' => 'nullable',
            'tgl_exp' => 'required',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal!',
                'errors' => $validator->errors()
            ], 422);
        }

        if ($request->hasFile('qr_img')) {
            $image2 = $request->file('qr_img');
            $imageName2 = time() . '_' . $image2->getClientOriginalName();
            $image2->move(public_path('images'), $imageName2);
        } else {
            $imageName2 = null;
        }
        // process the image
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }
        // create user
        $produk = Produk::create([
            'name' => $request->name,
            'qr_produk' => $request->qr_produk,
            'qr_img' => $imageName2,
            'img' => $imageName,
            'merek_id' => $request->merek_id,
            'jenis_id' => $request->jenis_id,
            'supliyer_id' => $request->supliyer_id,
            'stok' => $request->stok,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'diskon' => $request->diskon,
            'tgl_exp' => $request->tgl_exp,
        ]);

        // return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data' => $produk
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produk = Produk::find($id);

        return response()->json($produk);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the product by ID
        $produk = Produk::find($id);

        // Check if the product exists
        if (!$produk) {
            return response()->json([
                'success' => false,
                'message' => 'Produk not found'
            ], 404);
        }

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name-edit2' => '',
            'qr_produk-edit2' => '',
            'qr_img-edit2' => '',
            'img-edit2' => '',
            'merek_id-edit2' => 'integer',
            'jenis_id-edit2' => 'integer',
            'supliyer_id-edit2' => 'integer',
            'stok-edit2' => 'integer|min:0',
            'harga_jual-edit2' => 'numeric|min:0',
            'harga_beli-edit2' => 'numeric|min:0',
            'diskon-edit2' => '',
            'tgl_exp-edit2' => 'date',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal!',
                'errors' => $validator->errors()
            ], 422);
        }

        if ($request->hasFile('qr_img-edit2')) {
            // Hapus gambar lama jika ada
            if ($produk->qr_img) {
                $oldImagePath = public_path('images') . '/' . $produk->qr_img;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $qrImage = $request->file('qr_img-edit2');
            $qrImageName = time() . '_qr_' . $qrImage->getClientOriginalName();
            $qrImage->move(public_path('images'), $qrImageName);
            $produk->qr_img = $qrImageName; // Update kolom gambar QR
        }

        if ($request->hasFile('img-edit2')) {
            // Hapus gambar lama jika ada
            if ($produk->img) {
                $oldImagePath = public_path('images') . '/' . $produk->img;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('img-edit2');
            $imageName = time() . '_img_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $produk->img = $imageName; // Update kolom gambar utama
        }

        // Update the product
        $produk->name = $request->input('name-edit2', $produk->name); // Fallback to existing value if null
        $produk->qr_produk = $request->input('qr_produk-edit2', $produk->qr_produk);
        $produk->merek_id = $request->input('merek_id-edit2', $produk->merek_id);
        $produk->jenis_id = $request->input('jenis_id-edit2', $produk->jenis_id);
        $produk->supliyer_id = $request->input('supliyer_id-edit2', $produk->supliyer_id);
        $produk->stok = $request->input('stok-edit2', $produk->stok);
        $produk->harga_jual = $request->input('harga_jual-edit2', $produk->harga_jual);
        $produk->harga_beli = $request->input('harga_beli-edit2', $produk->harga_beli);
        $produk->diskon = $request->input('diskon-edit2', $produk->diskon);
        $produk->tgl_exp = $request->input('tgl_exp-edit2', $produk->tgl_exp);

        $produk->save();


        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Produk Berhasil Diupdate!',
            'data' => $produk,
        ]);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $supliyer = Supliyer::findOrFail($id);
            $supliyer->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Supliyer Berhasil Dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus supliyer. Terjadi kesalahan!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
