<?php

namespace App\Http\Controllers;

use App\Models\ProductDatas;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ProductDatasController extends Controller
{
    public function index(Request $request)
    {
        $data = ProductDatas::where([
            [function ($query) use ($request) {
                if ($term = $request->term) {
                    $query
                        ->orWhere('category', 'LIKE', '%' . $term . '%')
                        ->orWhere('sub_category', 'LIKE', '%' . $term . '%')
                        ->orWhere('model_name', 'LIKE', '%' . $term . '%')
                        ->orWhere('model_no', 'LIKE', '%' . $term . '%')
                        ->get();
                }
            }]
        ])
        ->latest('id')
        ->paginate(50)
        ->appends(request()->query());

        return view('admin.product-data.index', compact('data'));
    }

    public function create(Request $request)
    {
        $data = Brand::orderBy('name')->get();
        return view('admin.product-data.create', compact('data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'brand_id' => 'required|integer|min:1',
            'category' => 'required|string|min:2|max:255',
            'sub_category' => 'required|string|min:2|max:255',
            'model_name' => 'required|string',
            'model_no' => 'required|string|min:2|max:255',
            'service_type' => 'nullable|integer|digits:1'
        ]);

        $productData = new ProductDatas();
        $productData->brand_id = $request->brand_id;
        $productData->category = $request->category;
        $productData->sub_category = $request->sub_category;
        $productData->model_name = $request->model_name;
        $productData->model_no = $request->model_no;
        $productData->service_type = $request->service_type ? $request->service_type : 0;
        $productData->save();

        return redirect()->route('user.product.data.list')->with('success', 'Product data added successfully');
    }

    public function bulkCreate(Request $request)
    {
        $data = Brand::orderBy('name')->get();
        return view('admin.product-data.create-bulk', compact('data'));
    }

    public function bulkStore(Request $request)
    {
        $brand_ids = $request->brand_id;
        $categories = $request->category;
        $sub_categories = $request->sub_category;
        $model_names = $request->model_name;
        $models_nos = $request->model_no; 
        $service_types = $request->service_type; 

        if(count($brand_ids)>0){
            for($i=0;$i<count($brand_ids);$i++){
                $brand_id = $brand_ids[$i];
                $category = $categories[$i];
                $sub_category = $sub_categories[$i];
                $model_name = $model_names[$i];
                $model_no = $models_nos[$i];
                $service_type = $service_types[$i];

                $productData = new ProductDatas();
                $productData->brand_id = $brand_id;
                $productData->category = $category;
                $productData->sub_category = $sub_category;
                $productData->model_name = $model_name;
                $productData->model_no = $model_no;
                $productData->service_type = $service_type;
                $productData->save();
            }
        }

        return redirect()->route('user.product.data.list')->with('success', 'Multiple product data added successfully');
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
                        $storeData = 0;
                        if(isset($importData[5]) == "Carry In") $storeData = 1;

                        $insertData = array(
                            "brand_id" => isset($importData[0]) ? $importData[0] : null,
                            "category" => isset($importData[1]) ? $importData[1] : null,
                            "sub_category" => isset($importData[2]) ? $importData[2] : null,
                            "model_name" => isset($importData[3]) ? $importData[3] : null,
                            "model_no" => isset($importData[4]) ? $importData[4] : null,
                            "service_type" => $storeData,
                        );
                        // echo '<pre>';print_r($insertData);exit();
                        ProductDatas::insertData($insertData);
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

        return redirect()->route('user.product.data.list');
    }
    // csv upload

    public function show(Request $request)
    {
        $data = ProductDatas::findOrFail($request->id);
        return response()->json(['error' => false, 'data' => ['id' => $data->id, 'brand' => $data->brandDetails->name, 'category' => $data->category, 'subcategory' => $data->sub_category, 'modelname' => $data->model_name, 'modelno' => $data->model_no, 'servicetype' => ($data->service_type == 1) ? 'Carry in' : 'On site', 'created_at' => $data->created_at]]);
    }

    public function edit(Request $request, $id)
    {
        $data = Brand::orderBy('name')->get();
        $product = ProductDatas::findOrFail($id);
        return view('admin.product-data.edit', compact('data', 'product', 'id'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $request->validate([
            'brand_id' => 'required|integer|min:1',
            'category' => 'required|string|min:2|max:255',
            'sub_category' => 'required|string|min:2|max:255',
            'model_name' => 'required|string',
            'model_no' => 'required|string|min:2|max:255',
            'service_type' => 'nullable|integer|digits:1'
        ]);

        $productData = ProductDatas::findOrFail($id);
        $productData->brand_id = $request->brand_id;
        $productData->category = $request->category;
        $productData->sub_category = $request->sub_category;
        $productData->model_name = $request->model_name;
        $productData->model_no = $request->model_no;
        $productData->service_type = $request->service_type ? $request->service_type : 0;
        $productData->save();

        return redirect()->back()->with('success', 'Product data updated successfully');
    }

    public function destroy(Request $request)
    {
        $productData = ProductDatas::where('id', $request->id)->delete();
        return response()->json(['error' => false, 'title' => 'Deleted', 'message' => 'Record deleted', 'type' => 'success']);
    }

    public function bulkDestroy(Request $request)
    {
        // dd($request->all());
        $delete_ids = $request->delete_check;
        foreach ($delete_ids as $index => $delete_id) {
            ProductDatas::where('id', $delete_id)->delete();
        }
        return redirect()->back()->with('success', 'Multiple Product data deleted successfully');
    }
}
