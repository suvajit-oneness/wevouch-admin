<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\FieldParent;
use App\Models\InputType;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = (object)[];
        $data->parentFields = FieldParent::with('childRelation')->orderBy('position')->get();
        // $data->childFields = Field::get();
        return view('admin.field.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = (object)[];
        $data->input_types = InputType::get();
        return view('admin.field.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|min:1|max:255|unique:fields',
            'type' => 'required',
            'value' => 'nullable',
            'required' => 'required',
        ], [
            'type.required' => 'Select one of the types'
        ]);

        $agreement = new Field;
        $agreement->name = $request->name;
        $agreement->type = $request->type;
        $agreement->value = $request->value ? $request->value : '';
        $agreement->required = $request->required ? $request->required : 0;
        $agreement->key_name = generateKeyForForm($request->name);
        $agreement->save();

        return redirect()->route('user.field.list')->with('success', 'Field created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = Field::findOrFail($request->id);
        return response()->json(['error' => false, 'data' => $data]);
    }

    public function details(Request $request)
    {
        $data = Field::findOrFail($request->id);
        return view('admin.field.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data = Field::findOrFail($id);
        $data->input_types = InputType::get();
        return view('admin.field.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'type' => 'required',
            'value' => 'nullable',
            'required' => 'required',
        ]);

        $agreement = Field::findOrFail($id);
        $agreement->name = $request->name;
        $agreement->type = $request->type;
        $agreement->value = $request->value ? $request->value : '';
        $agreement->required = $request->required ? $request->required : 0;
        $agreement->key_name = generateKeyForForm($request->name);
        $agreement->save();

        return redirect()->route('user.field.list')->with('success', 'Field updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Field::where('id', $request->id)->delete();
        return response()->json(['error' => false, 'title' => 'Deleted', 'message' => 'Record deleted', 'type' => 'success']);
    }
}
