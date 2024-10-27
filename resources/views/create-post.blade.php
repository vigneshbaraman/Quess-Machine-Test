@extends('layouts.app')

<style>
#imagePreview {
    margin-top: 10px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    text-align: center;
}

#preview {
    max-width: 100%;
    height: auto;
    max-height: 200px;
}

/* Optional: Add animation */
#imagePreview {
    transition: all 0.3s ease;
}

/* Optional: Add hover effect */
#imagePreview:hover {
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

/* Style the file input */
input[type="file"] {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}
</style>
@section('content')

    <section id="contact" class="contact section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <div class="col-lg-8">
            <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data" >
                @csrf
              <div class="row gy-4">

                <div class="col-md-12">
                  <label for="">Title</label>
                  <input type="text" name="title"  class="form-control" placeholder="Title">
                  @error('title')
                                <div style="color: red;">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-12">
                  <textarea type="text" class="form-control" name="content" placeholder="Content"></textarea>
                  @error('content')
                            <div style="color: red;">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-12">
                  <input type="file" class="form-control" name="image_file" placeholder="Image">
                  @error('image_file')
                            <div style="color: red;">{{ $message }}</div>
                   @enderror
                </div>
                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->
          
        </div>

      </div>

    </section><!-- /Contact Section -->

@endsection

