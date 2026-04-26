<?php

namespace App\Http\Controllers;

use App\WatchProgress;
use Illuminate\Http\Request;

class WatchProgressController extends Controller
{
    public function get($batch_id, $lecture_id)
    {
        $user_id = session()->get('id');
        $progress = WatchProgress::where('user_id', $user_id)
            ->where('batch_id', $batch_id)
            ->where('lecture_id', $lecture_id)
            ->first();

        return response()->json([
            'watched_seconds'  => $progress ? (int) $progress->watched_seconds  : 0,
            'duration_seconds' => $progress ? (int) $progress->duration_seconds : 0,
        ]);
    }

    public function save(Request $request)
    {
        $user_id = session()->get('id');
        if (!$user_id) {
            return response()->json(['ok' => false], 401);
        }

        WatchProgress::updateOrCreate(
            [
                'user_id'    => $user_id,
                'batch_id'   => (int) $request->batch_id,
                'lecture_id' => (int) $request->lecture_id,
            ],
            [
                'watched_seconds'  => max(0, (int) $request->watched_seconds),
                'duration_seconds' => max(0, (int) $request->duration_seconds),
            ]
        );

        return response()->json(['ok' => true]);
    }
}
