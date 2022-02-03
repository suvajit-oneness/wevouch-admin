<?php

namespace App\Http\Controllers;

use App\Models\ProductIcon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductIconController extends Controller
{
    public function index(Request $request)
    {
        $data = ProductIcon::where([
            [function ($query) use ($request) {
                if ($term = $request->term) {
                    $query
                        ->orWhere('category', 'LIKE', '%' . $term . '%')
                        ->orWhere('icon', 'LIKE', '%' . $term . '%')
                        ->get();
                }
            }]
        ])->paginate(50);

        return view('admin.product-icon.index', compact('data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $rules = [
            'category' => 'required|string',
            'icon' => 'nullable|mimes:jpeg,jpg,png,gif|max:5000000',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $productIcon = new ProductIcon();
            $productIcon->category = $request->category;

            // image upload
            $upload_location = 'admin/uploads/product-icons/';
            $new_file_name = time().'.'.strtolower($request->icon->extension());
            $request->icon->move(public_path($upload_location), $new_file_name);
            $productIcon->icon = $upload_location.$new_file_name;
            // image upload
            $productIcon->save();

            return redirect()->back()->with('success', 'Product icon added successfully');
        } else {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
    }

    public function show(Request $request)
    {
        $data = ProductIcon::findOrFail($request->id);
        return response()->json(['error' => false, 'data' => ['id' => $data->id, 'category' => $data->category, 'icon' => asset($data->icon), 'created_at' => $data->created_at]]);
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $rules = [
            'editId' => 'required|numeric|min:1',
            'category' => 'required|string',
            'icon' => 'nullable|mimes:jpeg,jpg,png,gif|max:5000000',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $productIcon = ProductIcon::findOrFail($request->editId);
            $productIcon->category = $request->category;

            // image upload
            if ( $request->hasFile('icon') ) {
                \File::delete($productIcon->icon);
                $upload_location = 'admin/uploads/product-icons/';
                $new_file_name = time().'.'.strtolower($request->icon->extension());
                $request->icon->move(public_path($upload_location), $new_file_name);
                $productIcon->icon = $upload_location.$new_file_name;
            }
            // image upload
            $productIcon->save();

            return redirect()->back()->with('success', 'Product icon updated successfully');
        } else {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
    }

    public function destroy(Request $request)
    {
        $productIcon = ProductIcon::where('id', $request->id)->first();
        // dd($productIcon->icon);
        \File::delete($productIcon->icon);
        $productIcon->delete();
        return response()->json(['error' => false, 'title' => 'Deleted', 'message' => 'Record deleted', 'type' => 'success']);
    }
}
