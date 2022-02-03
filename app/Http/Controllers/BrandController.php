<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $data = Brand::where([
            [function ($query) use ($request) {
                if ($term = $request->term) {
                    $query
                        ->orWhere('name', 'LIKE', '%' . $term . '%')
                        ->get();
                }
            }]
        ])->paginate(50);

        return view('admin.brand.index', compact('data'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:2|max:255|unique:brands,name',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->save();

            $route = "'".route('user.brand.show')."'";

            return response()->json(['status' => 200, 'title' => 'success', 'message' => 'New Brand added', 'id' => $brand->id, 'viewRoute' => $route]);
        } else {
            return response()->json(['status' => 400, 'title' => 'failure', 'message' => $validator->errors()->first()]);
        }
    }

    public function show(Request $request)
    {
        $data = Brand::findOrFail($request->id);
        $brand_id = $data->id;
        $brand_name = $data->name;
        $brand_created_at = $data->created_at;

        return response()->json(['error' => false, 'data' => ['id' => $brand_id, 'name' => $brand_name, 'created_at' => $brand_created_at]]);
    }

    public function update(Request $request)
    {
        $rules = [
            'id' => 'required|numeric|min:1',
            'name' => 'required|string|min:2|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $brand = Brand::findOrFail($request->id);
            $brand->name = $request->name;
            $brand->save();

            return response()->json(['status' => 200, 'title' => 'success', 'message' => 'Brand updated']);
        } else {
            return response()->json(['status' => 400, 'title' => 'failure', 'message' => $validator->errors()->first()]);
        }
    }

    public function destroy(Request $request)
    {
        Brand::where('id', $request->id)->delete();
        return response()->json(['error' => false, 'title' => 'Deleted', 'message' => 'Record deleted', 'type' => 'success']);
    }
}
