<?php
// app/Http/Controllers/BatchCategoryController.php
namespace App\Http\Controllers\Admin;

use App\BatchCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests; // 5.7-এ FormRequest
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BatchCategoryController extends Controller {
    public function index(Request $request) {
        $categories = BatchCategory::active()
            ->with('children')
            ->when($request->filled('search'),function($query)use($request){
                return $query->where('name','like',"%$request->search%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.batch-categories.index', compact('categories'));
    }

    public function create() {
        $parents = BatchCategory::active()->whereNull('parent_id')->get();
        return view('admin.batch-categories.create', compact('parents'));
    }

    public function store(Request $request) {
        // 5.7-এ validation (Rule::in নেই, manual)
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:batch_categories',
            'slug' => 'required|string|max:100|unique:batch_categories',
            'description' => 'nullable|string',
            'type' => 'required|in:online,offline,hybrid', // in: array
            'parent_id' => 'nullable|exists:batch_categories,id',
            'fee_range' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:2048',
            'status' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect('batch-categories/create')
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // ইমেজ আপলোড (5.7-এ Storage একই)
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        BatchCategory::create($data);

        return redirect()->route('admin.batch-categories.index')
            ->with('success', 'ক্যাটাগরি তৈরি হয়েছে!');
    }

    public function show(BatchCategory $batchCategory) {
        $batchCategory->load(['admissions', 'children']);
        return view('admin.batch-categories.show', compact('batchCategory'));
    }

    public function edit(BatchCategory $batchCategory) {
        $parents = BatchCategory::active()->where('id', '!=', $batchCategory->id)->whereNull('parent_id')->get();
        return view('admin.batch-categories.edit', compact('batchCategory', 'parents'));
    }

    public function update(Request $request, BatchCategory $batchCategory) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:batch_categories,name,' . $batchCategory->id,
            'slug' => 'required|string|max:100|unique:batch_categories,slug,' . $batchCategory->id,
            'description' => 'nullable|string',
            'type' => 'required|in:online,offline,hybrid',
            'parent_id' => 'nullable|exists:batch_categories,id',
            'fee_range' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:2048',
            'status' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.batch-categories.edit', $batchCategory->id)
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($batchCategory->image) {
                Storage::disk('public')->delete($batchCategory->image);
            }
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $batchCategory->update($data);

        return redirect()->route('admin.batch-categories.index')
            ->with('success', 'আপডেট হয়েছে!');
    }

    public function destroy(BatchCategory $batchCategory) {
        if ($batchCategory->children()->count() > 0) {
            return redirect()->route('admin.batch-categories.index')
                ->with('error', 'চাইল্ড থাকায় ডিলিট যাবে না!');
        }

        if ($batchCategory->image) {
            Storage::disk('public')->delete($batchCategory->image);
        }

        $batchCategory->delete();

        return redirect()->route('admin.batch-categories.index')
            ->with('success', 'ডিলিট হয়েছে!');
    }
}