@extends('lgu.lgu-template.navigation-bar')

@section('title', 'Create Global Announcement')

@section('content')
<div class="container">
    <h2 class="text-center">Create Global Announcement</h2>
    <form action="{{ route('superadmin.announcements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
            @error('title')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="announcement_date">Announcement Date:</label>
            <input type="date" name="announcement_date" id="announcement_date" class="form-control" value="{{ old('announcement_date') }}">
            @error('announcement_date')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="expiration_date">Expiration Date:</label>
            <input type="datetime-local" name="expiration_date" id="expiration_date" class="form-control" value="{{ old('expiration_date') }}">
            @error('expiration_date')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">Content:</label>
            <textarea name="content" id="content" class="form-control" rows="5">{{ old('content') }}</textarea>
            @error('content')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="imgUrl">Upload Image:</label>
            <input type="file" name="imgUrl" id="imgUrl" class="form-control">
            @error('imgUrl')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Announcement</button>
    </form>
</div>
@endsection
