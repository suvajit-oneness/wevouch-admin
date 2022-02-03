<?php

namespace App\Http\Controllers;

use App\Models\ProductIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductIssueController extends Controller
{
    public function index(Request $request)
    {
        $data = ProductIssue::where([
            [function ($query) use ($request) {
                if ($term = $request->term) {
                    $query
                        ->orWhere('category', 'LIKE', '%' . $term . '%')
                        ->orWhere('function', 'LIKE', '%' . $term . '%')
                        ->orWhere('issue', 'LIKE', '%' . $term . '%')
                        ->get();
                }
            }]
        ])->paginate(50);

        return view('admin.product-issue.index', compact('data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'category' => 'required|string',
            'function' => 'required|string',
            'issue' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $productIssue = new ProductIssue();
            $productIssue->category = $request->category;
            $productIssue->function = $request->function;
            $productIssue->issue = $request->issue;
            $productIssue->save();

            $route = "'".route('user.product.issue.show')."'";

            return response()->json(['status' => 200, 'title' => 'success', 'message' => 'New Product Issue added', 'id' => $productIssue->id, 'viewRoute' => $route]);
        } else {
            return response()->json(['status' => 400, 'title' => 'failure', 'message' => $validator->errors()->first()]);
        }
    }

    public function show(Request $request)
    {
        $data = ProductIssue::findOrFail($request->id);
        return response()->json(['error' => false, 'data' => ['id' => $data->id, 'category' => $data->category, 'function' => $data->function, 'issue' => $data->issue, 'created_at' => $data->created_at]]);
    }

    public function update(Request $request)
    {
        $rules = [
            'id' => 'required|numeric|min:1',
            'category' => 'required|string',
            'function' => 'required|string',
            'issue' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $productIssue = ProductIssue::findOrFail($request->id);
            $productIssue->category = $request->category;
            $productIssue->function = $request->function;
            $productIssue->issue = $request->issue;
            $productIssue->save();

            return response()->json(['status' => 200, 'title' => 'success', 'message' => 'Product Issue updated']);
        } else {
            return response()->json(['status' => 400, 'title' => 'failure', 'message' => $validator->errors()->first()]);
        }
    }

    public function destroy(Request $request)
    {
        ProductIssue::where('id', $request->id)->delete();
        return response()->json(['error' => false, 'title' => 'Deleted', 'message' => 'Record deleted', 'type' => 'success']);
    }
}
