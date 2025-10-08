<?php

namespace App\Http\Controllers;

use App\LectureBatch;
use App\LectureSheet;
use App\Membership;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LectureSheetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allsheet(Request $request)
    {

        $selected_batch = $request->has('batch') ? $request->batch : '';
        $selected_name = $request->has('batch') ? $request->name : '';
        $selected_subject = $request->has('batch') ? $request->subject : '';
        $allBatches = Membership::where('status', 1)->get(['id', 'plan']);
        $subjects = LectureSheet::where('status', 1)->distinct('category')->get(['category']);
        $batches = $allBatches->pluck('plan', 'id');
        if ($selected_name == '' && $selected_subject == '' && $selected_batch == '') {
          //  $allsheet = LectureSheet::with('batch')->where('status', 1)->orderBy('id', 'desc')->paginate(config('sys.perpage'));
            $allsheet = LectureSheet::with('batch')->where('status', 1)->orderBy('id', 'desc')->paginate('1000');

        } else {
            $allsheet = LectureSheet::with('batch')->where('status', 1)->orderBy('id', 'desc');
            $pageAppendArray = [];

            if (!empty($selected_subject)) {
                $allsheet = $allsheet->where('category', $selected_subject);
                $pageAppendArray['subject'] = $selected_subject;
            }

            if (!empty($selected_name)) {
                $allsheet = $allsheet->where('title', 'like', '%' . $selected_name . '%');
                $pageAppendArray['name'] = $selected_name;
            }

            if (!empty($selected_batch)) {
                $allLectureIds = LectureBatch::where('membershipe_id', $selected_batch)->pluck('lecture_id');
                $allsheet = $allsheet->whereIn('id', $allLectureIds);
                $pageAppendArray['batch'] = $selected_batch;
            }

            $allsheet = $allsheet->paginate(config('sys.perpage'));
            $allsheet->appends($pageAppendArray);
        }
        return view('admin.lecture.all', compact('allsheet', 'subjects', 'batches', 'selected_batch', 'selected_name', 'selected_subject'));
    }


    public function addSheet()
    {
        $data = Membership::where('status', 1)->get();
        
        $lastSerial = LectureSheet::where('cp_id', 1)->latest('id')->value('video_id');
        
        return view('admin.lecture.add', compact('data', 'lastSerial'));
    }

    public function sheetUploads(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'batch' => 'required',

        ], [
            'title.required' => 'Please enter title',
            'batch.required' => 'Please enter batch',

        ]);

        $data = [];
        $data['date_time'] = $request->dateTime;
        $data['title'] = $request->title;
        $data['category'] = $request->category;
        $data['cp_id'] = $request->cp_id;
        $data['position'] = $request->position;
        $data['levell'] = $request->levell;
        $data['video'] = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $request->youtube_video_id . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        $data['youtube_video_id'] = $request->youtube_video_id;
        $data['links'] = $request->links;
        $data['v_link'] = $request->v_link;
        $data['pdf'] = $request->pdf;
        $data['video_id'] = $request->video_id;
        $data['clinical_case'] = $request->clinical_case;
        $data['price'] = $request->price;


        $data['created_at'] = Carbon:: now()->toDateTime();


        if ($request->has('lc_image') && $request->has('lc_video')) {
            $image = $request->file('lc_image');
            $video = $request->file('lc_video');

            $imageName = 'lc_image' . str_random() . '.' . $image->getClientOriginalExtension();
            $videoName = 'lc_video' . str_random() . '.' . $video->getClientOriginalExtension();

            $image->move(public_path('uploads/video/'), $imageName);
            $video->move(public_path('uploads/video/'), $videoName);

            $data['thumb'] = $imageName;
            $data['lc_video'] = $videoName;
        }

        if (isset($request->member_type)) {
            $data['member_type'] = 'free';
        } else {
            $data['member_type'] = 'premium';
        }

        if (isset($request->isExam))
        {
            $data['isExam'] = $request->isExam;
        }
        else
        {
            $data['isExam'] = null;
        }


        $sheet = LectureSheet::insertGetId($data);
        foreach ($request->batch as $key => $batch) {
            LectureBatch::insert([
                'lecture_id' => $sheet,
                'membershipe_id' => $batch,
            ]);
        }


        if ($sheet) {
            session()->flash('success', 'value');
            return redirect('/admin/lecture-sheet');
        } else {
            session()->flash('error', 'value');
            return back();
        }

    }

    public function editSheet($id)
    {
        $tak = LectureSheet:: where('status', 1)->where('id', $id)->first();
        $dataa = Membership:: where('status', 1)->get();
        $datas = Membership:: where('status', 1)->get();
        return view('admin.lecture.edit', compact('tak', 'dataa', 'datas'));
    }

    public function sheetUpdate(Request $request)
    {

        $id = $request->id;
        $data = [];
        $data['date_time'] = $request->dateTime;
        $data['title'] = $request->title;
        $data['category'] = $request->category;
        $data['cp_id'] = $request->cp_id;
        $data['position'] = $request->position;
        $data['levell'] = $request->levell;
        $data['video'] = $request->video;
        $data['youtube_video_id'] = $request->youtube_video_id;
        $data['links'] = $request->links;
        $data['v_link'] = $request->v_link;
        $data['pdf'] = $request->pdf;
        $data['video_id'] = $request->video_id;
        $data['created_at'] = Carbon:: now()->toDateTime();
        $data['clinical_case'] = $request->clinical_case;
        $data['price'] = $request->price;



        if ($request->file('pdf')) {
            $file = $request->file('pdf');
            $filename = time() . '.' . $request->file('pdf')->extension();
            $filePath = public_path() . '/uploads/pdf/';
            $file->move($filePath, $filename);

            $data['pdf'] = $filename;
        }


        if ($request->has('lc_image') && $request->has('lc_video')) {
            $image = $request->file('lc_image');
            $video = $request->file('lc_video');

            $imageName = 'lc_image' . str_random() . '.' . $image->getClientOriginalExtension();
            $videoName = 'lc_video' . str_random() . '.' . $video->getClientOriginalExtension();

            $image->move(public_path('uploads/video/'), $imageName);
            $video->move(public_path('uploads/video/'), $videoName);

            $data['thumb'] = $imageName;
            $data['lc_video'] = $videoName;
        }
        if (isset($request->member_type)) {
            $data['member_type'] = 'free';
        } else {
            $data['member_type'] = 'premium';
        }

        if (isset($request->isExam))
        {
            $data['isExam'] = $request->isExam;
        }
        else
        {
            $data['isExam'] = null;
        }


        $sheet = LectureSheet::where('id', $id)->update($data);

        LectureBatch::where('lecture_id', $id)->delete();

        foreach ($request->batch as $key => $batch) {
            LectureBatch::insert([
                'lecture_id' => $id,
                'membershipe_id' => $batch,
            ]);
        }


        if ($sheet) {
            session()->flash('success', 'value');
            return redirect('/admin/lecture-sheet');
        } else {
            session()->flash('error', 'value');
            return back();
        }

    }

    public function viewSheet($id)
    {
        $data = LectureSheet:: where('status', 1)->where('id', $id)->first();
        return view('admin.lecture.view', compact('data'));
    }


    public function deleteSheet($id)
    {
        $deleteSheet = LectureSheet:: where('status', 1)->where('id', $id)->delete();
        if ($deleteSheet) {
            session()->flash('delete', 'value');
            return back();
        } else {
            session()->flash('error', 'value');
            return back();
        }
    }


    public function youtubevideoidupdate()
    {
        $total_left = LectureSheet:: where('status', 1)->where('youtube_video_id', '')->count();
        $taks = LectureSheet:: where('status', 1)->where('youtube_video_id', '')->limit(20)->latest()->get();
        return view('admin.lecture.youtubeidedit', compact('taks', 'total_left'));
    }

    public function youtubevideoidsubmit(Request $request)
    {
        if ($request->has('id')) {
            $ids = $request->id;
            $youtube_video_ids = $request->youtube_video_id;
            foreach ($ids as $id) {
                $is_exist = LectureSheet::find($id);

                if ($is_exist) {
                    if (!empty($youtube_video_ids[$id])) {
                        $is_exist->youtube_video_id = $youtube_video_ids[$id];
                        $is_exist->save();
                    }

                }
            }
        }

        return redirect('/admin/edit/lecturesheetupdate');
    }
}
