<?php

namespace App\Http\Controllers;

use App\Models\TicketIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketIssueController extends Controller
{
    public function index(Request $request)
    {
        $data = TicketIssue::where([
            [function ($query) use ($request) {
                if ($term = $request->term) {
                    $query
                        ->orWhere('title', 'LIKE', '%' . $term . '%')
                        ->orWhere('message', 'LIKE', '%' . $term . '%')
                        ->get();
                }
            }]
        ])->paginate(50);

        return view('admin.ticket.index', compact('data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'title' => 'required|string',
            'message' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $ticket = new TicketIssue();
            $ticket->title = $request->title;
            $ticket->message = $request->message;
            $ticket->textarea = $request->textarea ? $request->textarea : 0;
            $ticket->save();

            $route = "'".route('user.ticket.show')."'";

            return response()->json(['status' => 200, 'title' => 'success', 'message' => 'New Ticket Issue added', 'id' => $ticket->id, 'viewRoute' => $route]);
        } else {
            return response()->json(['status' => 400, 'title' => 'failure', 'message' => $validator->errors()->first()]);
        }
    }

    public function show(Request $request)
    {
        $data = TicketIssue::findOrFail($request->id);
        return response()->json(['error' => false, 'data' => ['id' => $data->id, 'name' => $data->title, 'message' => $data->message, 'textarea' => ($data->textarea) == 1 ? 'Needed' : 'Not needed', 'created_at' => $data->created_at]]);
    }

    public function update(Request $request)
    {
        $rules = [
            'id' => 'required|numeric|min:1',
            'name' => 'required|string',
            'message' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $ticket = TicketIssue::findOrFail($request->id);
            $ticket->title = $request->name;
            $ticket->message = $request->message;
            $ticket->textarea = $request->textarea ? $request->textarea : 0;
            $ticket->save();

            return response()->json(['status' => 200, 'title' => 'success', 'message' => 'Ticket Issue updated']);
        } else {
            return response()->json(['status' => 400, 'title' => 'failure', 'message' => $validator->errors()->first()]);
        }
    }

    public function destroy(Request $request)
    {
        TicketIssue::where('id', $request->id)->delete();
        return response()->json(['error' => false, 'title' => 'Deleted', 'message' => 'Record deleted', 'type' => 'success']);
    }
}
