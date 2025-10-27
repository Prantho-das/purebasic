@extends('layouts.admin')

@section('content')
<div class="container">
<h1>Edit Menu Item: {{ $menu->name }}</h1>

@if ($errors->any())
<div class="alert alert-danger">
  <ul class="mb-0">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<form method="POST" action="{{ route('admin.menus.update', $menu) }}">
  {{ csrf_field() }}
  {{ method_field('PUT') }}

  <div class="form-group">
    <label for="name">Name <span class="text-danger">*</span></label>
    <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" name="name"
      value="{{ old('name', $menu->name) }}" required>
    @if($errors->has('name'))
    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
    @endif
  </div>

  <div class="form-group">
    <label for="slug">Slug <span class="text-danger">*</span></label>
    <input type="text" class="form-control @if($errors->has('slug')) is-invalid @endif" id="slug" name="slug"
      value="{{ old('slug', $menu->slug) }}" required>
    @if($errors->has('slug'))
    <div class="invalid-feedback">{{ $errors->first('slug') }}</div>
    @endif
  </div>

  <div class="form-group">
    <label for="menu_type">Menu Type <span class="text-danger">*</span></label>
    <select class="form-control @if($errors->has('menu_type')) is-invalid @endif" id="menu_type" name="menu_type"
      required>
      <option value="">Choose...</option>
      @foreach($menuTypes as $type)
      <option value="{{ $type }}" {{ old('menu_type', $menu->menu_type) === $type ? 'selected' : '' }}>
        {{ ucfirst($type) }} Menu
      </option>
      @endforeach
    </select>
    @if($errors->has('menu_type'))
    <div class="invalid-feedback">{{ $errors->first('menu_type') }}</div>
    @endif
    <small class="form-text text-muted">Where this menu appears (e.g., Header for top nav).</small>
  </div>

  <div class="form-group">
    <label for="parent_id">Parent Menu</label>
    <select class="form-control @if($errors->has('parent_id')) is-invalid @endif" id="parent_id" name="parent_id">
      <option value="">None (Top-level)</option>
      @foreach($menus as $m)
      <option value="{{ $m->id }}" {{ old('parent_id', $menu->parent_id) == $m->id ? 'selected' : '' }}>{{ $m->name }}
      </option>
      @endforeach
    </select>
    @if($errors->has('parent_id'))
    <div class="invalid-feedback">{{ $errors->first('parent_id') }}</div>
    @endif
  </div>

  <div class="form-group">
    <label for="sort_order">Sort Order</label>
    <input type="number" class="form-control @if($errors->has('sort_order')) is-invalid @endif" id="sort_order"
      name="sort_order" value="{{ old('sort_order', $menu->sort_order) }}" min="0">
    @if($errors->has('sort_order'))
    <div class="invalid-feedback">{{ $errors->first('sort_order') }}</div>
    @endif
  </div>

  <div class="form-group">
    <label>Link Type <span class="text-danger">*</span></label>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" id="custom" name="link_type" value="custom" {{ old('link_type',
        $menu->link_type) === 'custom' ? 'checked' : '' }}>
      <label class="form-check-label" for="custom">Custom URL</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" id="model" name="link_type" value="model" {{ old('link_type',
        $menu->link_type) === 'model' ? 'checked' : '' }}>
      <label class="form-check-label" for="model">Model Link (Batch/Class/Book)</label>
    </div>
    @if($errors->has('link_type'))
    <div class="text-danger">{{ $errors->first('link_type') }}</div>
    @endif
  </div>

  <div class="form-group" id="custom-url-group"
    style="display: {{ old('link_type', $menu->link_type) === 'custom' ? 'block' : 'none' }};">
    <label for="custom_url">Custom URL</label>
    <input type="url" class="form-control @if($errors->has('custom_url')) is-invalid @endif" id="custom_url"
      name="custom_url" value="{{ old('custom_url', $menu->custom_url) }}"
      placeholder="https://example.com or /internal/path">
    @if($errors->has('custom_url'))
    <div class="invalid-feedback">{{ $errors->first('custom_url') }}</div>
    @endif
  </div>

  <div class="form-group" id="model-group"
    style="display: {{ old('link_type', $menu->link_type) === 'model' ? 'block' : 'none' }};">
    <label for="model_name">Select Model Type <span class="text-danger">*</span></label>
    <select class="form-control @if($errors->has('model_name')) is-invalid @endif" id="model_name" name="model_name">
      <option value="">Choose...</option>
      @foreach($models as $model)
      <option value="{{ $model }}" {{ old('model_name', $menu->model_name) === $model ? 'selected' : '' }}>{{ $model }}
      </option>
      @endforeach
    </select>
    @if($errors->has('model_name'))
    <div class="invalid-feedback">{{ $errors->first('model_name') }}</div>
    @endif

    <div id="specific-item-group" style="display:none; margin-top:10px;">
      <label for="specific_id" class="form-label">Select Specific Item <span class="text-danger">*</span></label>
      <select
        class="form-control @if($errors->has('batch_id') || $errors->has('class_id') || $errors->has('book_id')) is-invalid @endif"
        id="specific_id" name="">
        <option value="">Loading items...</option>
      </select>
      <small class="form-text text-muted">This links to the details page of the selected item.</small>
      @if($errors->has('batch_id') || $errors->has('class_id') || $errors->has('book_id') ||
    $errors->has('batch_category_id'))
    <div class="invalid-feedback d-block">{{ $errors->first('batch_id') ?? $errors->first('class_id') ??
        $errors->first('book_id') ?? $errors->first('batch_category_id') }}</div>
    @endif
    </div>
  </div>

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ old('is_active',
        $menu->is_active) ? 'checked' : '' }}>
      <label class="form-check-label" for="is_active">Active</label>
    </div>
  </div>

  <button type="submit" class="btn btn-primary">Update Menu Item</button>
  <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Cancel</a>
</form>

{{-- Hidden fields for IDs --}}
<input type="hidden" id="batch_id" name="batch_id" value="{{ old('batch_id', $menu->batch_id) }}">
<input type="hidden" id="class_id" name="class_id" value="{{ old('class_id', $menu->class_id) }}">
<input type="hidden" id="book_id" name="book_id" value="{{ old('book_id', $menu->book_id) }}">
<input type="hidden" id="batch_category_id" name="batch_category_id" value="{{ old('batch_category_id', $menu->batch_category_id) }}">
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
  // Toggle link type sections
        $('input[name="link_type"]').change(function() {
            $('#custom-url-group').toggle(this.value === 'custom');
            $('#model-group').toggle(this.value === 'model');
        });

        // Dynamic model item dropdown (same function as create)
        function populateSpecificItems(model, selectedId = null) {
            var $specificGroup = $('#specific-item-group');
            var $select = $('#specific_id');
            $specificGroup.hide();
            $select.html('<option value="">Choose...</option>');

            if (!model) return;

            // Clear hidden fields
            $('#batch_id, #class_id, #book_id, #batch_category_id').val('');

            var items = {};
            if (model === 'Batch') {
                @foreach($batches as $id => $name)
                    items[{{ $id }}] = '{{ $name }}';
                @endforeach
                $select.attr('name', 'batch_id');
            } else if (model === 'Class') {
                @foreach($classes as $id => $name)
                    items[{{ $id }}] = '{{ $name }}';
                @endforeach
                $select.attr('name', 'class_id');
            } else if (model === 'Book') {
                @foreach($books as $id => $name)
                    items[{{ $id }}] = '{{ $name }}';
                @endforeach
                $select.attr('name', 'book_id');
            }else if (model === 'BatchCategory') {
                @foreach($batchCategories as $id => $name)
                   items[{{ $id }}] = '{{ $name }}';
                @endforeach
                $select.attr('name', 'batch_category_id');
            } else {
                return;
            }

            // Populate options
            $.each(items, function(id, name) {
                $select.append('<option value="' + id + '">' + name + '</option>');
            });

            if (selectedId) {
                $select.val(selectedId);
            }

            $specificGroup.show();
        }

        $('#model_name').change(function() {
            var model = $(this).val();
            var selectedId = null;
            if (model === 'Batch' && {{ $menu->batch_id ? $menu->batch_id : 'null' }}) {
                selectedId = {{ $menu->batch_id }};
            } else if (model === 'Class' && {{ $menu->class_id ? $menu->class_id : 'null' }}) {
                selectedId = {{ $menu->class_id }};
            } else if (model === 'Book' && {{ $menu->book_id ? $menu->book_id : 'null' }}) {
                selectedId = {{ $menu->book_id }};
            }else if (model === 'BatchCategory' && {{ $menu->batch_category_id ? $menu->batch_category_id : 'null' }}) {
                selectedId = {{ $menu->batch_category_id }};
            }
            populateSpecificItems(model, selectedId);
        });

        // Trigger on load
        $(document).ready(function() {
            @if($menu->link_type === 'model' && $menu->model_name)
                $('#model_name').val('{{ $menu->model_name }}').trigger('change');
            @endif
            $('input[name="link_type"]').trigger('change');
        });
</script>
@endsection