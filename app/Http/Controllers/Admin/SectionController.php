<?php
namespace App\Http\Controllers\Admin;

use App\Book;
use App\Http\Controllers\Controller;
use App\BatchCategory;
use App\HomeSection;
use App\Membership;
use App\Mentor;
use App\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    public function index()
    {
        $sections = HomeSection::orderBy('order_num')->get();
        return view('admin.sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.sections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'section_type' => 'required|string',
            'main_image' => 'nullable|image|max:2048',
            'order_num' => 'required|integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['dynamic_data'] = [];  // প্রথমে খালি

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('images', 'public');
        }

        $section = HomeSection::create($data);

        // সেকশন তৈরি হলে data-input পেজে রিডাইরেক্ট
        return redirect()
            ->route('admin.sections.data-input', $section->id)
            ->with('success', 'সেকশন তৈরি হয়েছে! এখন ডায়নামিক ডেটা অ্যাড করো।');
    }

    public function edit(HomeSection $section)
    {
        return view('admin.sections.edit', compact('section'));
    }

    public function update(Request $request, HomeSection $section)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'section_type' => 'required|string',
            'main_image' => 'nullable|image|max:2048',
            'order_num' => 'required|integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('main_image')) {
            if ($section->main_image) {
                Storage::disk('public')->delete($section->main_image);
            }
            $data['main_image'] = $request->file('main_image')->store('images', 'public');
        }

        $section->update($data);
        return redirect()->route('admin.sections.index')->with('success', 'সেকশন আপডেট হয়েছে!');
    }

    public function destroy(HomeSection $section)
    {
        if ($section->main_image) {
            Storage::disk('public')->delete($section->main_image);
        }
        $section->delete();
        return redirect()->route('admin.sections.index')->with('success', 'সেকশন ডিলিট হয়েছে!');
    }

    // নতুন: Data Input পেজ শো করো
    public function dataInput(HomeSection $section)
    {
        $mentors = Mentor::all();
        $batches = Membership::all();
        $batch_categories = BatchCategory::all();
        $books = Book::all();
        $problems = Problem::all();

        $notices = \DB::table('notices')->get();
        return view('admin.sections.data-input', compact('section', 'mentors', 'batches', 'batch_categories','books','problems','notices'));
    }

    // নতুন: Dynamic Data সেভ করো (mentor-এর জন্য)
    public function saveData(Request $request, $id)
    {
        $section = HomeSection::findOrFail($id);

        $mentors = [];
        if ($request->has('mentor_name')) {
            foreach ($request->mentor_name as $key => $name) {
                if (!empty($name)) {
                    $mentorData = [
                        'name' => $name,
                        'bio' => $request->mentor_bio[$key] ?? '',
                    ];

                    // ইমেজ হ্যান্ডল (আগের মতো)
                    if ($request->hasFile("mentor_image.$key")) {
                        $imagePath = $request->file("mentor_image.$key")->store('mentors', 'public');
                        $mentorData['image'] = $imagePath;
                    } elseif (isset($section->dynamic_data[$key]['image'])) {
                        $mentorData['image'] = $section->dynamic_data[$key]['image'];
                    }

                    // নতুন: YouTube URL অ্যাড
                    $youtubeUrl = $request->mentor_youtube_url[$key] ?? '';
                    if (!empty($youtubeUrl)) {
                        // সিম্পল ভ্যালিডেশন: YouTube URL চেক (যদি চাও, আরও ভালো করতে পারো)
                        if (strpos($youtubeUrl, 'youtube.com/watch?v=') !== false || strpos($youtubeUrl, 'youtu.be/') !== false) {
                            $mentorData['youtube_url'] = $youtubeUrl;
                        }
                    } elseif (isset($section->dynamic_data[$key]['youtube_url'])) {
                        $mentorData['youtube_url'] = $section->dynamic_data[$key]['youtube_url'];  // পুরানো রাখো
                    }

                    $mentors[] = $mentorData;
                }
            }
            $section->update(['dynamic_data' => $mentors]);
        } elseif ($section->section_type === 'home_slider') {
            $slides = [];
            if ($request->has('slide_title')) {
                $slideCount = count($request->slide_title);
                for ($i = 0; $i < $slideCount; $i++) {
                    if (!empty($request->slide_title[$i])) {
                        $slideData = [
                            'title' => $request->slide_title[$i],
                            'subtitle' => $request->slide_subtitle[$i] ?? '',
                            'enroll_text' => $request->slide_enroll_text[$i] ?? 'Click to Enroll in 30+ Free courses',
                            'enroll_link' => $request->slide_enroll_link[$i] ?? '#',
                        ];

                        // নতুন: Main Image হ্যান্ডল (প্রতি স্লাইডের জন্য)
                        if ($request->hasFile("slide_main_image.$i")) {
                            $imagePath = $request->file("slide_main_image.$i")->store('slider-images', 'public');
                            $slideData['main_image'] = $imagePath;
                        } elseif (isset($section->dynamic_data[$i]['main_image'])) {
                            $slideData['main_image'] = $section->dynamic_data[$i]['main_image'];
                        }

                        $slides[] = $slideData;
                    }
                }
            }

            $section->update(['dynamic_data' => $slides]);
        } elseif ($section->section_type === 'batch') {
            $batches = [];
            if ($request->has('batch_id')) {
                $batchIds = $request->batch_id;  // অ্যারে অফ আইডি
                $images = $request->file('batch_image') ?? [];  // ফাইল অ্যারে

                foreach ($batchIds as $key => $batchId) {
                    if (!empty($batchId) && isset($images[$key])) {
                        $batchModel = Membership::find($batchId);
                        if ($batchModel) {
                            $batchItem = [
                                'batch_id' => $batchId,
                                'batch_data' => $batchModel->toArray(),  // পুরো ব্যাচ ডেটা সেভ (name, session ইত্যাদি)
                            ];

                            // ইমেজ সেভ
                            $image = $images[$key];
                            if ($image && $image->isValid()) {
                                $imagePath = $image->store('post-graduate-images', 'public');
                                $batchItem['image'] = $imagePath;
                            } else {
                                // যদি নতুন ইমেজ না থাকে, পুরানো রাখো (যদি থাকে)
                                if (isset($section->dynamic_data['batches'][$key]['image'])) {
                                    $batchItem['image'] = $section->dynamic_data['batches'][$key]['image'];
                                }
                            }

                            $batches[] = $batchItem;
                        }
                    }
                }
            }

            $section->update(['dynamic_data' => $batches]);
        } elseif ($section->section_type === 'batch_category') {
            $batches = [];
            if ($request->has('batch_category_id')) {
                $batchIds = $request->batch_category_id;
                $images = $request->file('batch_image') ?? [];

                foreach ($batchIds as $key => $batchId) {
                    if (!empty($batchId)) {
                        $batchModel = BatchCategory::find($batchId);
                        if ($batchModel) {
                            $batchItem = [
                                'batch_category_id' => $batchId,
                                'batch_category_data' => $batchModel->toArray(),
                                'category' => $categories[$key] ?? 'General',
                            ];

                            if (isset($images[$key]) && $images[$key]->isValid()) {
                                $imagePath = $images[$key]->store('batch-category-images', 'public');
                                $batchItem['image'] = $imagePath;
                            } elseif (isset($section->dynamic_data['batches'][$key]['image'])) {
                                $batchItem['image'] = $section->dynamic_data['batches'][$key]['image'];
                            }

                            $batches[] = $batchItem;
                        }
                    }
                }
            }

            $section->update(['dynamic_data' => $batches]);
        }elseif ($section->section_type === 'books') {
            $books = [];
            if ($request->has('book_id')) {
                $bookIds = $request->book_id;  // অ্যারে
                $bookNames = $request->book_name ?? [];  // অ্যারে
                $images = $request->file('book_image') ?? [];  // ফাইল অ্যারে

                foreach ($bookIds as $key => $bookId) {
                    if (!empty($bookId)) {
                        $bookModel = Book::find($bookId);
                        if ($bookModel) {
                            $bookItem = [
                                'book_id' => $bookId,
                                'book_name' => isset($bookNames[$key])?$bookNames[$key]:"",
                                'book_data' => $bookModel->toArray(),  // টাইটেল, অথর ইত্যাদি
                            ];

                            // ইমেজ হ্যান্ডল
                            if (isset($images[$key]) && $images[$key]->isValid()) {
                                $imagePath = $images[$key]->store('book-images', 'public');
                                $bookItem['image'] = $imagePath;
                            } elseif (isset($section->dynamic_data['books'][$key]['image'])) {
                                $bookItem['image'] = $section->dynamic_data['books'][$key]['image'];
                            }

                            $books[] = $bookItem;
                        }
                    }
                }
            }
            $section->update(['dynamic_data' => $books]);

            }elseif ($section->section_type === 'hero_slider') {

                $request->validate([
                    'hero_title' => 'required|array|min:1',
                    'hero_title.*' => 'required|string|max:255',
                    'hero_promotion_title' => 'nullable|array',
                    'hero_promotion_title.*' => 'nullable|string|max:255',
                    'hero_type' => 'required|array|min:1',
                    'hero_type.*' => 'required|in:batch,class,book,custom',
                    'hero_batch_id' => 'nullable|array',
                    'hero_batch_id.*' => 'nullable|exists:memberships,id',
                    'hero_class_id' => 'nullable|array',
                    'hero_class_id.*' => 'nullable|exists:batch_categories,id',
                    'hero_book_id' => 'nullable|array',
                    'hero_book_id.*' => 'nullable|exists:books,id',
                    'hero_custom_link' => 'nullable|array',
                    'hero_custom_link.*' => 'nullable|url|required_if:hero_type.*,custom',  // Per item
                    'hero_image.*' => 'nullable|image|max:2048',
                ]);

                $slides = [];
                if ($request->has('hero_title')) {
                    $count = count($request->hero_title);
                    for ($i = 0; $i < $count; $i++) {
                        if (!empty($request->hero_title[$i])) {
                            $slideData = [
                                'title' => $request->hero_title[$i],
                                'promotion_title' => $request->hero_promotion_title[$i] ?? '',
                                'type' => $request->hero_type[$i],
                                'batch_id' => null,
                                'class_id' => null,
                                'book_id' => null,
                                'custom_link' => null,
                                'related_data' => null,
                                'image' => isset($section->dynamic_data[$i]['image']) ? $section->dynamic_data[$i]['image'] : null,  // Preserve old
                            ];

                            // Handle selection per slide
                            if ($slideData['type'] === 'batch' && !empty($request->hero_batch_id[$i])) {
                                $model = Membership::find($request->hero_batch_id[$i]);
                                $slideData['batch_id'] = $request->hero_batch_id[$i];
                                $slideData['related_data'] = $model ? $model->toArray() : null;
                            } elseif ($slideData['type'] === 'class' && !empty($request->hero_class_id[$i])) {
                                $model = BatchCategory::find($request->hero_class_id[$i]);
                                $slideData['class_id'] = $request->hero_class_id[$i];
                                $slideData['related_data'] = $model ? $model->toArray() : null;
                            } elseif ($slideData['type'] === 'book' && !empty($request->hero_book_id[$i])) {
                                $model = Book::find($request->hero_book_id[$i]);
                                $slideData['book_id'] = $request->hero_book_id[$i];
                                $slideData['related_data'] = $model ? $model->toArray() : null;
                            } elseif ($slideData['type'] === 'custom') {
                                $slideData['custom_link'] = $request->hero_custom_link[$i] ?? '';
                            }

                            // Image per slide
                            if ($request->hasFile("hero_image.$i")) {
                                if (isset($section->dynamic_data[$i]['image'])) {
                                    Storage::disk('public')->delete($section->dynamic_data[$i]['image']);
                                }
                                $imagePath = $request->file("hero_image.$i")->store('hero-images', 'public');
                                $slideData['image'] = $imagePath;
                            }

                            $slides[] = $slideData;
                        }
                    }
                }
                $section->update(['dynamic_data' => $slides]);

            } elseif ($section->section_type === 'locations') {
                $request->validate([
                    'location_name' => 'required|array|min:1',
                    'location_name.*' => 'required|string|max:255',
                    'location_map' => 'required|array|min:1',
                    'location_map.*' => 'required|string|max:1000',  // For embed code/URL
                ]);

                $locations = [];
                if ($request->has('location_name')) {
                    $nameCount = count($request->location_name);
                    for ($i = 0; $i < $nameCount; $i++) {
                        if (!empty($request->location_name[$i])) {
                            $locationData = [
                                'name' => $request->location_name[$i],
                                'map_location' => $request->location_map[$i],
                            ];

                            // Preserve old data if editing (though no files here)
                            if (isset($section->dynamic_data[$i])) {
                                $locationData = array_merge($section->dynamic_data[$i], $locationData);
                            }

                            $locations[] = $locationData;
                        }
                    }
                }
                $section->update(['dynamic_data' => $locations]);
            }elseif ($section->section_type === 'testimonial') {
                $request->validate([
                    'problem_id' => 'required|array|min:1',
                    'problem_id.*' => 'required|exists:problems,id',
                    'testimonial_image' => 'nullable|array',
                    'testimonial_image.*' => 'nullable|image|max:2048',
                ]);
            
                $testimonials = [];
                if ($request->has('problem_id')) {
                    $problemIds = $request->problem_id;
                    $images = $request->file('testimonial_image') ?? [];
            
                    foreach ($problemIds as $key => $problemId) {
                        if (!empty($problemId)) {
                            $problemModel = Problem::find($problemId);
                            if ($problemModel) {
                                $testimonialData = [
                                    'problem_id' => $problemId,
                                    'review_data' => $problemModel->toArray(),  // Save full review (e.g., text, name, rating)
                                ];
            
                                // Image handling
                                if (isset($images[$key]) && $images[$key]->isValid()) {
                                    $imagePath = $images[$key]->store('testimonial-images', 'public');
                                    $testimonialData['image'] = $imagePath;
                                } elseif (isset($section->dynamic_data[$key]['image'])) {
                                    $testimonialData['image'] = $section->dynamic_data[$key]['image'];  // Preserve old
                                }
            
                                $testimonials[] = $testimonialData;
                            }
                        }
                    }
                }
                $section->update(['dynamic_data' => $testimonials]);
            }elseif ($section->section_type === 'notice') {
            $request->validate([
                'notice_id' => 'required|array|min:1',
                'notice_id.*' => 'required|exists:notices,id',
                'notice_image' => 'nullable|array',
                'notice_image.*' => 'nullable|image|max:2048',
            ]);
        
            $noticesData = [];
            if ($request->has('notice_id')) {
                $noticeIds = $request->notice_id;
                $images = $request->file('notice_image') ?? [];
        
                foreach ($noticeIds as $key => $noticeId) {
                    if (!empty($noticeId)) {
                        $noticeModel = \DB::table('notices')->where('id',$noticeId)->first();
                        if ($noticeModel) {
                            $noticeItem = [
                                'notice_id' => $noticeId,
                                'notice_data' => (array)$noticeModel,  // Save full notice (e.g., title, content, date)
                            ];
        
                            // Image handling
                            if (isset($images[$key]) && $images[$key]->isValid()) {
                                $imagePath = $images[$key]->store('notice-images', 'public');
                                $noticeItem['image'] = $imagePath;
                            } elseif (isset($section->dynamic_data[$key]['image'])) {
                                $noticeItem['image'] = $section->dynamic_data[$key]['image'];  // Preserve old
                            }
        
                            $noticesData[] = $noticeItem;
                        }
                    }
                }
            }
            $section->update(['dynamic_data' => $noticesData]);
            }

        return redirect()->route('admin.sections.index')->with('success', 'ডেটা সেভ হয়েছে! YouTube ভিডিও অ্যাড হয়েছে।');
    }
}