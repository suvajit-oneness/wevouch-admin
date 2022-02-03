<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Office::latest()->get();
        return view('admin.office.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:2|max:255',
            'code' => 'required|string|min:2|max:255',
            'email' => 'required|email|min:2|max:255|unique:offices',
            'mobile' => 'required|numeric|min:1|digits:10',
            'streetAddress' => 'required|string|min:2|max:255',
            'pincode' => 'required|numeric|min:1|digits:6',
            'city' => 'required|string|min:2|max:255',
            'state' => 'required|string|min:2|max:255',
            'comment' => 'nullable|string|min:2',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $office = new Office();
            $office->name = $request->name;
            $office->code = $request->code;
            $office->email = $request->email;
            $office->mobile = $request->mobile;
            $office->street_address = $request->streetAddress;
            $office->pincode = $request->pincode;
            $office->city = $request->city;
            $office->state = $request->state;
            $office->comment = $request->comment ?? '';
            $office->save();

            $route = "'".route('user.office.show')."'";

            return response()->json(['status' => 200, 'title' => 'success', 'message' => 'New office added', 'id' => $office->id, 'viewRoute' => $route]);
        } else {
            return response()->json(['status' => 400, 'title' => 'failure', 'message' => $validator->errors()->first()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = Office::findOrFail($request->id);
        $office_id = $data->id;
        $office_name = $data->name;
        $office_code = $data->code;
        $office_mobile = $data->mobile;
        $office_email = $data->email;
        $office_street_address = $data->street_address;
        $office_pincode = $data->pincode;
        $office_city = $data->city;
        $office_state = $data->state;
        $office_comment = $data->comment;
        $office_created_at = $data->created_at;

        return response()->json(['error' => false, 'data' => ['id' => $office_id, 'name' => $office_name, 'code' => $office_code, 'mobile' => $office_mobile, 'email' => $office_email, 'street_address' => $office_street_address, 'pincode' => $office_pincode, 'city' => $office_city, 'state' => $office_state, 'comment' => $office_comment, 'created_at' => $office_created_at]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());

        $rules = [
            'id' => 'required|numeric|min:1',
            'name' => 'required|string|min:2|max:255',
            'code' => 'required|string|min:2|max:255',
            'email' => 'required|email|min:2|max:255',
            'mobile' => 'required|numeric|min:1|digits:10',
            'streetAddress' => 'required|string|min:2|max:255',
            'pincode' => 'required|numeric|min:1|digits:6',
            'city' => 'required|string|min:2|max:255',
            'state' => 'required|string|min:2|max:255',
            'comment' => 'nullable|string|min:2',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $office = Office::findOrFail($request->id);
            $office->name = $request->name;
            $office->code = $request->code;
            $office->email = $request->email;
            $office->mobile = $request->mobile;
            $office->street_address = $request->streetAddress;
            $office->pincode = $request->pincode;
            $office->city = $request->city;
            $office->state = $request->state;
            $office->comment = $request->comment ?? '';
            $office->save();

            $route = "'".route('user.office.show')."'";

            return response()->json(['status' => 200, 'title' => 'success', 'message' => 'Office updated', 'id' => $office->id, 'viewRoute' => $route]);
        } else {
            return response()->json(['status' => 400, 'title' => 'failure', 'message' => $validator->errors()->first()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Office::where('id', $request->id)->delete();
        return response()->json(['error' => false, 'title' => 'Deleted', 'message' => 'Record deleted', 'type' => 'success']);
    }
}
