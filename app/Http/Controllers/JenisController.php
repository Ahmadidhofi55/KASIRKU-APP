<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class JenisController extends Controller
{
     //menampilkan data di index
     public  function index(){
        return view('jenis.index');
    }

    //menmapilkan data melalui ajax
    public function get(Request $request)
    {
        if ($request->ajax()) {
            $data = Jenis::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" id="btn-edit-post" data-id="' . $row->id . '" class="edit btn btn-success btn-sm"><i class="fas fa-eye"></i></a> <a href="javascript:void(0)" data-id="' . $row->id . '" id="btn-edit-post2" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a> <button onclick="deleteData(' . $row->id . ')" class="delete btn btn-danger btn-sm mr-2"><i class="fas fa-trash"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    //menginput data kedalam database
    public function store(Request $request)
    {
        // define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'img' => 'required|image|mimes:png,jpg,svg,jfif|max:2048',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal!',
                'errors' => $validator->errors()
            ], 422);
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
        $jenis = Jenis::create([
            'name' => $request->name,
            'img' => $imageName,
        ]);

        // return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data' => $jenis
        ]);
    }

     /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jenis = Jenis::find($id);

        return response()->json($jenis);
    }

      /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the user by ID
        $user = Jenis::find($id);

        // Check if the user exists
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Jenis Produk not found'
            ], 404);
        }

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name-edit2' => 'unique:jenis,name,' . $user->id,
            'img-edit2' => 'nullable',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal!',
                'errors' => $validator->errors()
            ], 422);
        }
        // Process the image
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
            'message' => 'Jenis Produk Berhasil Diupdate!',
            'data' => $user,
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Cari data jenis berdasarkan ID
            $jenis = Jenis::findOrFail($id);

            // Hapus gambar jika ada
            if (!empty($jenis->img)) {
                $imagePath = public_path('images') . '/' . $jenis->img;

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Hapus data dari database
            $jenis->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Jenis Produk Berhasil Dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus jenis produk. Terjadi kesalahan!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
