<?php

namespace App\Http\Controllers\App;

use App\LectureSheet;
use App\Http\Controllers\Controller;

class VideoLectureController extends Controller
{
    public function playVideo($id)
    {
        $sheet = LectureSheet:: where('id', $id)->where('status', 1)->first();
        return view('app.lecture_video', compact('sheet'));
    }
}
