<?php

namespace App\Http\Controllers;

use App\Models\ProductIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

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
        ])
        ->latest('id')
        ->paginate(50)
        ->appends(request()->query());

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

    // csv upload
    public function csvStore(Request $request)
    {
        if (!empty($request->file)) {
            // if ($request->input('submit') != null ) {
            $file = $request->file('file');
            // File Details 
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");
            // 50MB in Bytes
            $maxFileSize = 50097152;
            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {
                // Check file size
                if ($fileSize <= $maxFileSize) {
                    // File upload location
                    $location = 'admin/uploads/csv';
                    // Upload file
                    $file->move($location, $filename);
                    // Import CSV to Database
                    $filepath = public_path($location . "/" . $filename);
                    // Reading file
                    $file = fopen($filepath, "r");
                    $importData_arr = array();
                    $i = 0;
                    while (($filedata = fgetcsv($file, 10000, ",")) !== FALSE) {
                        $num = count($filedata);
                        // Skip first row
                        if ($i == 0) {
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    // echo '<pre>';print_r($importData_arr);exit();

                    // Insert into database
                    foreach ($importData_arr as $importData) {
                        $insertData = array(
                            "category" => isset($importData[0]) ? $importData[0] : null,
                            "function" => isset($importData[1]) ? $importData[1] : null,
                            "issue" => isset($importData[2]) ? $importData[2] : null,
                        );
                        // echo '<pre>';print_r($insertData);exit();
                        ProductIssue::insertData($insertData);
                    }
                    Session::flash('message', 'Import Successful.');
                } else {
                    Session::flash('message', 'File too large. File must be less than 50MB.');
                }
            } else {
                Session::flash('message', 'Invalid File Extension. supported extensions are ' . implode(', ', $valid_extension));
            }
        } else {
            Session::flash('message', 'No file found.');
        }

        return redirect()->route('user.product.issue.list');
    }
    // csv upload

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

    public function bulkDestroy(Request $request)
    {
        $delete_ids = $request->delete_check;
        foreach ($delete_ids as $index => $delete_id) {
            ProductIssue::where('id', $delete_id)->delete();
        }
        return redirect()->back()->with('success', 'Multiple Product issues deleted successfully');
    }
}
