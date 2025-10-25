@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Manage Menus</h1>
    <a href="{{ route('admin.menus.create') }}" class="btn btn-primary mb-3">Add New Menu Item</a>

    @if($menus->isEmpty())
    <div class="alert alert-info">
        <p>No menus found. <a href="{{ route('admin.menus.create') }}">Create one to get started!</a></p>
    </div>
    @else
    <div class="card mb-4">
        <div class="card-header">
            <h5>All Active Menus ({{ $menus->count() }} Top-Level Items)</h5>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @foreach($menus as $menu)
                <li class="list-group-item d-flex justify-content-between align-items-center px-0 border-top-0">
                    <span class="flex-grow-1">
                        <strong>{{ str_repeat('— ', $menu->depth) }}{{ $menu->name }}</strong>
                        @if($menu->children->count() > 0)
                        <small class="text-muted ml-2">(has {{ $menu->children->count() }} children)</small>
                        @endif
                        <small class="text-muted ml-2 badge badge-light">{{ ucfirst($menu->menu_type) }}</small>
                        @if($menu->link_type === 'model' && ($menu->batch_id || $menu->class_id || $menu->book_id))
                        <small class="text-info ml-2">({{ $menu->model_name }} Item)</small>
                        @elseif($menu->link_type === 'custom')
                        <small class="text-secondary ml-2">Custom Link</small>
                        @endif
                    </span>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form method="POST" action="{{ route('admin.menus.destroy', $menu) }}" style="display:inline;"
                            onsubmit="return confirm('Are you sure you want to delete this menu and all its children?');">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </div>
                </li>

                {{-- Optional: Expand children here for a tree view (uncomment if desired) --}}
                {{-- @if($menu->children->count() > 0)
                @foreach($menu->children as $child)
                <li class="list-group-item d-flex justify-content-between align-items-center px-3 border-left">
                    <span class="flex-grow-1">
                        <strong>{{ str_repeat('— ', $child->depth) }}{{ $child->name }}</strong>
                        {{-- Repeat child details as above --}}
                    </span>
                </li>
                @endforeach

            </ul>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6>Preview: Header Menus</h6>
                </div>
                <div class="card-body">
                    <ul class="nav flex-column">
                        @foreach(\App\Menu::ofType('header')->root()->active()->orderBy('sort_order')->with('children')->get()
                        as $headerMenu)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $headerMenu->url }}">{{ $headerMenu->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6>Preview: Footer Menus</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        @foreach(\App\Menu::ofType('footer')->root()->active()->orderBy('sort_order')->with('children')->get()
                        as $footerMenu)
                        <li><a href="{{ $footerMenu->url }}">{{ $footerMenu->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection