<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function index()
    {
        $data = Department::latest()->get();
        return view('admin.department.index', compact('data'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:2|max:255|unique:departments',
            'code' => 'required|string|min:2|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $department = new Department();
            $department->name = $request->name;
            $department->code = $request->code;
            $department->save();

            $route = "'".route('user.department.show')."'";

            return response()->json(['status' => 200, 'title' => 'success', 'message' => 'New department added', 'id' => $department->id, 'viewRoute' => $route]);
        } else {
            return response()->json(['status' => 400, 'title' => 'failure', 'message' => $validator->errors()->first()]);
        }
    }

    public function show(Request $request)
    {
        $data = Department::findOrFail($request->id);
        $department_id = $data->id;
        $department_name = $data->name;
        $department_code = $data->code;
        $department_created_at = $data->created_at;

        return response()->json(['error' => false, 'data' => ['id' => $department_id, 'name' => $department_name, 'code' => $department_code, 'created_at' => $department_created_at]]);
    }

    public function update(Request $request)
    {
        $rules = [
            'id' => 'required|numeric|min:1',
            'name' => 'required|string|min:2|max:255',
            'code' => 'required|string|min:2|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $department = Department::findOrFail($request->id);
            $department->name = $request->name;
            $department->code = $request->code;
            $department->save();

            $route = "'".route('user.office.show')."'";

            return response()->json(['status' => 200, 'title' => 'success', 'message' => 'Office updated', 'id' => $department->id, 'viewRoute' => $route]);
        } else {
            return response()->json(['status' => 400, 'title' => 'failure', 'message' => $validator->errors()->first()]);
        }
    }

    public function destroy(Request $request)
    {
        Department::where('id', $request->id)->delete();
        return response()->json(['error' => false, 'title' => 'Deleted', 'message' => 'Record deleted', 'type' => 'success']);
    }
}
