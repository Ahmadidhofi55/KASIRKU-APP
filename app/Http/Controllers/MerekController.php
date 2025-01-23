<?php

namespace App\Http\Controllers;

use App\Models\Merek;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MerekController extends Controller
{
      //menampilkan data di index
      public  function index(){
        return view('merek.index');
    }

     //menmapilkan data melalui ajax
     public function get(Request $request)
     {
         if ($request->ajax()) {
             $data = Merek::latest()->get();
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

     //input data kedalam database
     public function store(Request $request)
     {
         // define validation rules
         $validator = Validator::make($request->all(), [
             'name' => 'required',
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
         $merek = Merek::create([
             'name' => $request->name,
             'img' => $imageName,
         ]);

         // return response
         return response()->json([
             'success' => true,
             'message' => 'Data Berhasil Disimpan!',
             'data' => $merek
         ]);
     }

          /**
     * Display the specified resource.
     */
     public function show($id)
    {
        $jenis = Merek::find($id);

        return response()->json($jenis);
    }

      /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the user by ID
        $user = Merek::find($id);

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
        $user->save();

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Merek Produk Berhasil Diupdate!',
            'data' => $user,
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $Merek = Merek::findOrFail($id);

        // Delete the associated image if it exists
        if ($Merek->img) {
            $imagePath = public_path('images') . '/' . $Merek->img;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $Merek->delete();

        return response()->json(['message' => 'Merek Produk Berhasil Dihapus']);
    }
}
