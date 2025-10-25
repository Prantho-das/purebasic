<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Http\Controllers\Controller;
use App\LectureSheet;
use App\Membership;
use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::root()->active()->with('allChildren')->orderBy('sort_order')->get();

        return view('admin.menus.index', compact('menus'));
    }
    public function create()
    {
        $menus = Menu::active()->orderBy('name')->get();
        $models = ['Batch', 'Class', 'Book']; // Updated list
        $menuTypes = ['header', 'footer', 'sidebar', 'other'];
        $batches = Membership::pluck('plan as name', 'id')->toArray();
        $classes = LectureSheet::pluck('title as name', 'id')->toArray(); // Adjust model
        $books = Book::pluck('name', 'id')->toArray();

        return view('admin.menus.create', compact('menus', 'models', 'menuTypes', 'batches', 'classes', 'books'));
    }

    public function store(Request $request)
    {

        
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:menus,slug',
            'menu_type' => 'required|in:header,footer,sidebar,other',
            'parent_id' => 'nullable|exists:menus,id',
            'sort_order' => 'required|integer|min:0',
            'link_type' => 'required|in:custom,model',
            'custom_url' => 'required_if:link_type,custom|nullable|url',
            'model_name' => 'required_if:link_type,model|nullable|in:Batch,Class,Book',
            'batch_id' => 'required_if:model_name,Batch|nullable|exists:memberships,id',
            'class_id' => 'required_if:model_name,Class|nullable|exists:lecture_sheets,id',
            'book_id' => 'required_if:model_name,Book|nullable|exists:books,id',
        ]);

        // Ensure only relevant ID is set
        $data = $request->all();
        if($request->filled('is_active')){
            $data['is_active']=1;
        }else{
            $data['is_active']=0;
        }
        
        $data['batch_id'] = $request->model_name === 'Batch' ? $request->batch_id : null;
        $data['class_id'] = $request->model_name === 'Class' ? $request->class_id : null;
        $data['book_id'] = $request->model_name === 'Book' ? $request->book_id : null;
        unset($data['route_name']); // No longer needed

        Menu::create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu created!');
    }

    public function show(Menu $menu)
    {
        // Not needed for simple CRUD
    }

    public function edit(Menu $menu)
    {
        $menus = Menu::where('id', '!=', $menu->id)->active()->orderBy('name')->get();
        $models = ['Batch', 'Class', 'Book'];
        $menuTypes = ['header', 'footer', 'sidebar', 'other'];
        $batches = Membership::pluck('plan as name', 'id')->toArray();
        $classes = LectureSheet::pluck('title as name', 'id')->toArray(); // Adjust model
        $books = Book::pluck('name', 'id')->toArray();

        return view('admin.menus.edit', compact('menu', 'menus', 'models', 'menuTypes', 'batches', 'classes', 'books'));
    }

    public function update(Request $request, Menu $menu)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:menus,slug,' . $menu->id,
            'menu_type' => 'required|in:header,footer,sidebar,other',
            'parent_id' => 'nullable|exists:menus,id',
            'sort_order' => 'required|integer|min:0',
            'link_type' => 'required|in:custom,model',
            'custom_url' => 'required_if:link_type,custom|nullable|url',
            'model_name' => 'required_if:link_type,model|nullable|in:Batch,Class,Book',
            'batch_id' => 'required_if:model_name,Batch|nullable|exists:memberships,id',
            'class_id' => 'required_if:model_name,Class|nullable|exists:lecture_sheets,id',
            'book_id' => 'required_if:model_name,Book|nullable|exists:books,id',            
        ]);

        $data = $request->all();
        if($request->filled('is_active')){
            $data['is_active']=1;
        }else{
            $data['is_active']=0;
        }
        $data['batch_id'] = $request->model_name === 'Batch' ? $request->batch_id : null;
        $data['class_id'] = $request->model_name === 'Class' ? $request->class_id : null;
        $data['book_id'] = $request->model_name === 'Book' ? $request->book_id : null;
        unset($data['route_name']);

        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu updated!');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu deleted!');
    }
}