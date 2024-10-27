@extends('layouts.app')

@section('content')

<main class="main">



<div class="container">
  <div class="row">

    <div class="col-lg-9">

      <!-- Blog Posts Section -->
      <section id="blog-posts" class="blog-posts section">

        <div class="container">
          <div class="row gy-4">
            @foreach($posts as $blogPost)
            <div class="col-lg-4">
              <article class="position-relative h-100">

                <div class="post-img position-relative overflow-hidden">
                  <img src="{{ Storage::url($blogPost->image) }}" class="img-fluid" alt="">

                </div>

                <div class="post-content d-flex flex-column">

                  <h3 class="post-title">{{ $blogPost->title }}</h3>

                  <div class="meta d-flex align-items-center">
                    <div class="d-flex align-items-center">
                      <i class="bi bi-person"></i> <span class="ps-2">{{$blogPost->name}}</span>
                    </div>
                    <span class="px-3 text-black-50">/</span>
                    <div class="d-flex align-items-center">
                      <i class="bi bi-folder2"></i> <span class="ps-2">Politics</span>
                    </div>
                  </div>

                  <p>
                    @php
                        $content = $blogPost->content;
                        $words = explode(' ', $content);
                        $trimmedContent = count($words) > 25 ? implode(' ', array_slice($words, 0, 25)) : $content;
                    @endphp
                    {!! $trimmedContent !!}
                  </p>
                     <hr>
                  <div class="meta d-flex align-items-center">
                    <div class="d-flex align-items-center">
                    <a href="{{ route('edit-blog', ['slug' => $blogPost->id]) }}">
                        <i class="bi bi-pencil"></i> <span class="ps-2">Edit</span>
                    </a>
                    </div>
                    <span class="px-3 text-black-50">/</span>
                    <div class="d-flex align-items-center">
                      
                      <a href="#" class="delete-btn" data-id="{{ $blogPost->id }}"><i class="bi bi-trash"></i><span class="ps-2">Delete</span></a>
                    </div>
                  </div>
                  <hr>
                </div>
              </article>
            </div><!-- End post list item -->
            @endforeach
          
          </div>
        </div>

      </section><!-- /Blog Posts Section -->

      <!-- Blog Pagination Section -->
      <section id="blog-pagination" class="blog-pagination section">

        <div class="container">
          <div class="d-flex justify-content-center">
          {{ $posts->links('pagination::bootstrap-5') }}
          </div>
        </div>

      </section><!-- /Blog Pagination Section -->
    
    </div>



  </div>
</div>

</main>
  

@endsection

