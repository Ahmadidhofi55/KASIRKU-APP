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
                        <a href="javascript:void(0)" id="btn-view-post" data-id="' . $row->id . '" class="view btn btn-success btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="javascript:void(0)" data-id="' . $row->id . '" id="btn-edit-post" class="edit btn btn-primary btn-sm">
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


    public function create()
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
            return response()->json($validator->errors(), 422);
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
        // Find the user by ID
        $user = Produk::find($id);

        // Check if the user exists
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Produk not found'
            ], 404);
        }

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name-edit2' => 'required' . $user->id,
            'qr_produk-edit2' => 'required' . $user->id,
            'qr_img-edit2' => 'required|image|mimes:png,jpg' . $user->id,
            'img-edit2' => 'required|image|mimes:png,jpg,svg,jfif|max:2048' . $user->id,
            'merek_id-edit2' => 'required' . $user->id,
            'jenis_id-edit2' => 'required' . $user->id,
            'supliyer_id-edit2' => 'required' . $user->id,
            'stok-edit2' => 'required' . $user->id,
            'harga_jual-edit2' => 'required' . $user->id,
            'harga_beli-edit2' => 'required' . $user->id,
            'diskon-edit2' => 'required' . $user->id,
            'tgl_exp-edit2' => 'required' . $user->id,

        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Process the image
        if ($request->hasFile('qr_img-edit2')) {
            // Hapus gambar lama jika ada
            if ($user->qr_img) {
                $oldImagePath = public_path('images') . '/' . $user->qr_img;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image2 = $request->file('qr_img-edit2');
            $imageName2 = time() . '_' . $image2->getClientOriginalName();
            $image2->move(public_path('images'), $imageName2);
            $user->qr_img = $imageName2; // Update kolom gambar dengan nama gambar baru
        }

        if ($request->hasFile('img-edit2')) {
            // Hapus gambar lama jika ada
            if ($user->img) {
                $oldImagePath = public_path('images') . '/' . $user->img;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('img-edit2');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $user->img = $imageName; // Update kolom gambar dengan nama gambar baru
        }

        // Update the user
        $user->name = $request->name;
        $user->save();

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Produk Berhasil Diupdate!',
            'data' => $user,
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Delete the associated image if it exists
        if ($produk->qr_img) {
            $imagePath = public_path('images') . '/' . $produk->qr_img;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        if ($produk->img) {
            $imagePath = public_path('images') . '/' . $produk->img;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $produk->delete();

        return response()->json(['message' => 'Produk deleted successfully']);
    }
}
