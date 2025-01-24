<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
//use Illuminate\Validation\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PembayaranController extends Controller
{
    //menampilkan data di index
    public  function index(){
        return view('pembayaran.index');
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {
            $data = Pembayaran::latest()->get();
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

      public function store(Request $request)
    {
        // define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'data_pembayaran' => 'required',
            'img' => 'required|image|mimes:png,jpg,svg,jfif|max:2048',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
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
        $pembayarans = Pembayaran::create([
            'name' => $request->name,
            'data_pembayaran'=>$request->data_pembayaran,
            'img' => $imageName,
        ]);

        // return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data' => $pembayarans
        ]);
    }

     /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pembayarans = Pembayaran::find($id);

        return response()->json($pembayarans);
    }

      /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the user by ID
        $user = Pembayaran::find($id);

        // Check if the user exists
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran not found'
            ], 404);
        }

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name-edit2' => 'unique:pembayarans,name,' . $user->id,
            'data_pembayaran-edit2' => 'unique:pembayarans,data_pembayaran' . $user->id,
            'img-edit2' => 'nullable'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
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
        $user->data_pembayaran = $request->data_pembayaran;
        $user->save();

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Pembayaran Berhasil Diupdate!',
            'data' => $user,
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pembayarans = Pembayaran::findOrFail($id);

        // Delete the associated image if it exists
        if ($pembayarans->img) {
            $imagePath = public_path('images') . '/' . $pembayarans->img;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $pembayarans->delete();

        return response()->json(['message' => 'Pembayaran deleted successfully']);
    }
}
