<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DesignationController extends Controller
{
    public function index()
    {
        $data = Designation::latest()->get();
        return view('admin.designation.index', compact('data'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:2|max:255|unique:designations',
            'salary' => 'required|integer|min:2|digits_between:1,8',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $designation = new Designation();
            $designation->name = $request->name;
            $designation->salary = $request->salary;
            $designation->save();

            $route = "'".route('user.designation.show')."'";

            return response()->json(['status' => 200, 'title' => 'success', 'message' => 'New Designation added', 'id' => $designation->id, 'viewRoute' => $route]);
        } else {
            return response()->json(['status' => 400, 'title' => 'failure', 'message' => $validator->errors()->first()]);
        }
    }

    public function show(Request $request)
    {
        $data = Designation::findOrFail($request->id);
        $designation_id = $data->id;
        $designation_name = $data->name;
        $designation_salary = $data->salary;
        $designation_created_at = $data->created_at;

        return response()->json(['error' => false, 'data' => ['id' => $designation_id, 'name' => $designation_name, 'salary' => $designation_salary, 'created_at' => $designation_created_at]]);
    }

    public function update(Request $request)
    {
        $rules = [
            'id' => 'required|numeric|min:1',
            'name' => 'required|string|min:2|max:255',
            'salary' => 'required|string|min:2|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $designation = Designation::findOrFail($request->id);
            $designation->name = $request->name;
            $designation->salary = $request->salary;
            $designation->save();

            return response()->json(['status' => 200, 'title' => 'success', 'message' => 'Designation updated']);
        } else {
            return response()->json(['status' => 400, 'title' => 'failure', 'message' => $validator->errors()->first()]);
        }
    }

    public function destroy(Request $request)
    {
        Designation::where('id', $request->id)->delete();
        return response()->json(['error' => false, 'title' => 'Deleted', 'message' => 'Record deleted', 'type' => 'success']);
    }
}
