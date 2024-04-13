@extends('layouts.app')

@section('title', 'Nuovo Progetto')

@section('content')
    <div class="container">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-primary mt-4 mb-3">Project List</a>

        <h1 class="mb-3">New Project</h1>

        <form action="{{ route('admin.projects.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-6">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-6">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control @error('author') is-invalid @enderror" id="author"
                        name="author" value="{{ old('author') }}">
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="project_link" class="form-label">Project link</label>
                    <input type="url" class="form-control @error('project_link') is-invalid @enderror" id="project_link"
                        name="project_link" value="{{ old('project_link') }}">
                    @error('project_link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="type_id" class="form-label">Type</label>
                    <select name="type_id" id="type_id" class='form-select @error('type_id') is-invalid @enderror'>
                        <option value="" class="d-none">Select a Type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->type }}
                            </option>
                        @endforeach
                    </select>
                    @error('type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <button class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
