<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    //menampilkan data di index
    public  function index()
    {
        return view('member.index');
    }

    //menmapilkan data melalui ajax
    public function get(Request $request)
    {
        if ($request->ajax()) {
            $data = Member::latest()->get();
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
            'no_hp' => 'required|max_digits:13'
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // create user
        $member = Member::create([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
        ]);

        // return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data' => $member
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $member = Member::find($id);

        return response()->json($member);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the user by ID
        $user = Member::find($id);

        // Check if the user exists
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Member not found'
            ], 404);
        }

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name-edit2' => 'unique:member,name,' . $user->id,
            'no_hp-edit2' => 'nullable|max_digits:13'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update the user
        $user->name = $request->input('name');
        $user->no_hp = $request->input('no_hp-edit2');

        $user->save();

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Member Berhasil Diupdate!',
            'data' => $user,
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);

        $member->delete();

        return response()->json(['message' => 'Member Berhasil Dihapus']);
    }
}
