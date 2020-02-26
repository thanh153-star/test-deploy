<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function ahihi()
    {
        return view('noti');
    }

    public function index(Request $request)
    {
        $data = Notification::create([
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        $a = [
            'title'       => $data->title,
            'description' => $data->description,
        ];

        $count = Notification::where('read', 0)->get()->count();
        //        dd($data);
        event(new SendMessage($data, $count));

        return view('noti');
    }

    public function clear()
    {
        $data = Notification::where('read', 0)->get();

        foreach ($data as $item) {
            $item->update([
                'read' => 1,
            ]);
        }

        return response()->json([
            'code'  => 200,
            'count' => 0,
        ]);
    }
}
