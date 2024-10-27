@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h4>Create Form</h4>
                </div>
                <div class="card-body">
                    <form action="store" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="mb-3">
                            <label for="exampleInputTitle" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputTitle"  placeholder="Enter Title">
                            @error('title')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <textarea name="content" id="content" class="form-control"></textarea>
                            @error('content')
                            <div style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <label class="form-check-label" for="exampleCheck1">Image</label>
                            <input type="file" class="form-control" class="form-control" name="image_file">
                            @error('image_file')
                            <div style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
