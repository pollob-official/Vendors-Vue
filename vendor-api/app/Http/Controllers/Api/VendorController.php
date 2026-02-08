<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{

    public function index()
    {
        $vendors = Vendor::all();
        return response()->json(compact("vendors"), 200);
    }


    public function store(Request $request)
    {
        try {
            $vendor = new Vendor();
            $vendor->name = $request->name;
            $vendor->email = $request->email;
            $vendor->phone = $request->phone;
            $vendor->address = $request->address;

            $vendor->save();

            return response()->json(["success" =>  $request->all()], 200);

        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 200);
        }
    }


    public function show(string $id)
    {
        $vendor = Vendor::find($id);
        return response()->json(["vendor" => $vendor], 200);
    }


    public function update(Request $request, string $id)
    {
        try {
            $vendor = Vendor::find($id);
            $vendor->name = $request->vendor["name"];
            $vendor->email = $request->vendor["email"];
            $vendor->phone = $request->vendor["phone"];
            $vendor->address = $request->vendor["address"];
            $vendor->save();

            return response()->json(["vendor" => "Vendor Updated Successfully"], 200);

        } catch (\Throwable $th) {
            return response()->json(["err" => $th->getMessage()], 200);
        }
    }


    public function destroy(string $id)
    {
        $vendor = Vendor::find($id);
        $vendor->delete();

        return response()->json(["success" => "Vendor deleted succesfully"], 200);
    }
}
