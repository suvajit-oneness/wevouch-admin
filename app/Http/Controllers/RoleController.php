<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $data = UserType::get();
        return view('admin.role.index', compact('data'));
    }

    public function show(Request $request)
    {
        $data = UserType::findOrFail($request->id);
        return response()->json(['error' => false, 'data' => $data]);
    }

    public function store(Request $request)
    {
        if ($request->type == 'create') {
            $rules1 = ['name' => 'required|string|min:1|unique:App\Models\UserType'];
        } else {
            $rules1 = ['name' => 'required|string|min:1'];
        }

        $rules2 = [
            'color' => 'required|string|min:1',
            'id' => 'required',
            'type' => 'required',
        ];

        $rules = array_merge($rules1, $rules2);

        $validate = validator()->make($request->all(), $rules);

        if (!$validate->fails()) {
            if ($request->type == 'create') {
                $userType = new UserType();
                $userType->name = $request->name;
                $userType->color = $request->color;
                $userType->save();
                return response()->json(['status' => 200, 'message' => 'New role added successfully', 'data' => $userType]);
            } else {
                $userType = UserType::findOrFail($request->id);
                $userType->name = $request->name;
                $userType->color = $request->color;
                $userType->save();
                return response()->json(['status' => 200, 'message' => 'Role updated successfully', 'data' => $userType]);
            }
        } else {
            return response()->json(['status' => 400, 'message' => $validate->errors()->first()]);
        }

        $data = UserType::findOrFail($request->id);
        return response()->json(['error' => false, 'data' => $data]);
    }

    public function destroy(Request $request)
    {
        UserType::where('id', $request->id)->delete();
        return response()->json(['error' => false, 'title' => 'Deleted', 'message' => 'Record deleted', 'type' => 'success']);
    }

    // public function edit(Request $request, $id)
    // {
    //     $data = (object)[];
    //     $data->user = UserType::findOrFail($id);
    //     $data->users = UserType::select('id', 'name', 'user_type')->where('id', '!=', $id)->orderBy('name')->get();
    //     $data->user_type = UserType::all();
    //     return view('admin.role.edit', compact('data'));
    // }
}
