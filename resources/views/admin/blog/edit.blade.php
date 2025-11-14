@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>{{ $title ?? '' }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('blog.update', $edit->id) }}" method="post" enctype="multipart/form-data" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="" class="form-label">
                        Category Blog
                    </label>
                    <select name="category_id" id="" class="form-control">
                        <option value="">Choose One</option>
                        @foreach ($categories as $category)
                            <option {{ $edit->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">
                        Title
                    </label>
                    <input type="text" name="title" class="form-control" placeholder="Title Blog" value="{{ $edit->title }}" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">
                        Content
                    </label>
                    <textarea name="content" id="summernote" cols="30" rows="10" class="form-control">{{ $edit->content }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">
                        Photo
                    </label>
                    <input type="file" name="photo" id="">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">
                        Status
                    </label>
                    <select name="status" id="" class="form-control">
                        <option value="1" {{ $edit->status == 1 ? 'selected' : '' }}>Publish</option>
                        <option value="0" {{ $edit->status == 0 ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
