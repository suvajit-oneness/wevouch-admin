<?php

namespace App\Http\Controllers;

use App\Models\TrainingVideos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainingVideosController extends Controller
{
    public function index(Request $request)
    {
        $data = TrainingVideos::where([
            [function ($query) use ($request) {
                if ($term = $request->term) {
                    $query
                        ->orWhere('title', 'LIKE', '%' . $term . '%')
                        ->orWhere('link', 'LIKE', '%' . $term . '%')
                        ->get();
                }
            }]
        ])->paginate(50);

        return view('admin.training.index', compact('data'));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string',
            'link' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $training = new TrainingVideos();
            $training->title = $request->title;
            $training->link = $request->link;
            $training->save();

            $route = "'".route('user.training.show')."'";

            return response()->json(['status' => 200, 'title' => 'success', 'message' => 'New Training video added', 'id' => $training->id, 'viewRoute' => $route]);
        } else {
            return response()->json(['status' => 400, 'title' => 'failure', 'message' => $validator->errors()->first()]);
        }
    }

    public function show(Request $request)
    {
        $data = TrainingVideos::findOrFail($request->id);
        $training_id = $data->id;
        $training_name = $data->title;
        $training_link = $data->link;
        $training_created_at = $data->created_at;

        return response()->json(['error' => false, 'data' => ['id' => $training_id, 'name' => $training_name, 'link' => $training_link, 'created_at' => $training_created_at]]);
    }

    public function update(Request $request)
    {
        $rules = [
            'id' => 'required|numeric|min:1',
            'name' => 'required|string',
            'link' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $training = TrainingVideos::findOrFail($request->id);
            $training->title = $request->name;
            $training->link = $request->link;
            $training->save();

            return response()->json(['status' => 200, 'title' => 'success', 'message' => 'Training updated']);
        } else {
            return response()->json(['status' => 400, 'title' => 'failure', 'message' => $validator->errors()->first()]);
        }
    }

    public function destroy(Request $request)
    {
        TrainingVideos::where('id', $request->id)->delete();
        return response()->json(['error' => false, 'title' => 'Deleted', 'message' => 'Record deleted', 'type' => 'success']);
    }
}
