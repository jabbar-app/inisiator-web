@extends('layouts.app')

@section('content')
  <main id="content">
    <div class="container">
      <!-- Entry Header -->
      <div class="entry-header mb-5">
        <h1 class="entry-title mb-4 fw-normal">{{ $article->title }}</h1>
        <div class="entry-meta align-items-center">
          <a href="{{ route('pages.author', $article->user->username) }}" class="author-avatar">
            <img src="{{ $article->user->avatar ?? asset('assets/img/profpic.svg') }}" alt="{{ $article->user->name }}">
          </a>
          <a href="{{ route('pages.author', $article->user->username) }}">{{ $article->user->name }}</a>
          in <a href="{{ route('categories.show', $article->category->slug) }}">{{ $article->category->title }}</a><br>
          <span>{{ $article->created_at->format('d M Y') }}</span>
          <span class="middotDivider"></span>
          <span class="readingTime" title="{{ $article->reading_time }} min read">{{ $article->reading_time }} min
            read</span>
        </div>
      </div>

      <!-- Featured Image -->
      @if ($article->img_featured)
        <figure class="image zoom mb-5">
          <img src="{{ asset('storage/' . $article->img_featured) }}" alt="Featured Image" class="img-fluid">
        </figure>
      @endif

      <!-- Main Content -->
      <article class="entry-wraper mb-5">
        <div class="entry-left-col">
          <div class="social-sticky">
            <a href="#"><i class="icon-facebook"></i></a>
            <a href="#"><i class="icon-twitter"></i></a>
            <a href="#"><i class="icon-heart"></i></a>
            <a href="#"><i class="icon-paper-plane"></i></a>
          </div>
        </div>
        @include('components.adsense-responsive')

        <div class="entry-main-content">
          {!! $article->content !!}

          <!-- Subscribe Section -->
          <div class="border p-5 bg-lightblue mb-5">
            <div class="row justify-content-between">
              <div class="col-md-5 mb-2 mb-md-0">
                <h5 class="font-weight-bold secondfont mb-3 mt-0">Become a member</h5>
                <p class="small-text">Get the latest news right in your inbox. We never spam!</p>
              </div>
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="Enter your e-mail address">
                  </div>
                  <div class="col-md-12 mt-2">
                    <button type="submit" class="btn btn-success btn-block">Subscribe</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          @include('components.adsense-responsive')
        </div>

        <!-- Tags Section -->
        <div class="entry-bottom">
          <div class="tags-wrap heading">
            <span class="tags">
              @foreach ($tags as $tag)
                <a href="{{ route('pages.tags', ['tag' => $tag]) }}" rel="tag">{{ $tag }}</a>
              @endforeach
            </span>
          </div>
        </div>

        <!-- Author Box -->
        <div class="box box-author mb-4">
          <div class="post-author d-flex">
            <div class="author-img">
              <img src="{{ $article->user->avatar ?? asset('assets/img/profpic.svg') }}" alt="{{ $article->user->name }}"
                class="avatar">
            </div>
            <div class="author-content">
              <h5><a href="{{ route('pages.author', $article->user->username) }}"
                  class="text-decoration-none">{{ $article->user->name }}</a></h5>
              <p class="d-none d-md-block">{{ $article->user->bio }}</p>
              <div class="content-social-author">
                <a href="#" target="_blank" class="author-social">X/Twitter</a>
                <a href="#" target="_blank" class="author-social">LinkedIn</a>
                <a href="#" target="_blank" class="author-social">Instagram</a>
              </div>
            </div>
          </div>
        </div>
      </article>

      <!-- Related Posts Section -->
      <div class="related-posts mb-5">
        <h4 class="spanborder text-center"><span>Related Posts</span></h4>
        <div class="row">
          @foreach ($relatedPosts as $related)
            <div class="col-md-4">
              <div class="d-flex mb-3">
                <figure class="col-md-5">
                  <a href="{{ route('articles.show', $related->slug) }}">
                    <img src="{{ asset('storage/' . $related->img_featured) }}" alt="{{ $related->title }}">
                  </a>
                </figure>
                <div class="entry-content col-md-7 pl-md-0">
                  <h5 class="entry-title mb-3">
                    <a href="{{ route('articles.show', $related->slug) }}">{{ $related->title }}</a>
                  </h5>
                  <div class="entry-meta">
                    <a href="{{ route('pages.author', $related->user->username) }}">{{ $related->user->name }}</a><br>
                    <span>{{ $related->created_at->format('d M Y') }}</span>
                    <span class="middotDivider"></span>
                    <span class="readingTime">{{ $related->reading_time }} min read</span>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <!-- Comments Section -->
      <div class="single-comment comments_wrap">
        <section id="comments">
          <div class="comments-inner">
            <div id="respond" class="comment-respond">
              <h3 class="comment-reply-title">Leave a Reply</h3>
              <form action="#" method="post" id="commentform" class="comment-form">
                <p class="comment-notes">
                  <span id="email-notes">Your email address will not be published.</span>
                  Required fields are marked <span class="required">*</span>
                </p>
                <p class="comment-form-comment">
                  <label for="comment">Comment</label>
                  <textarea id="comment" name="comment" cols="45" rows="8" required></textarea>
                </p>
                <div class="row">
                  <div class="col-md-6">
                    <p>
                      <label for="author">Name*</label>
                      <input id="author" name="author" type="text" required>
                    </p>
                  </div>
                  <div class="col-md-6">
                    <p>
                      <label for="email">Email*</label>
                      <input id="email" name="email" type="email" required>
                    </p>
                  </div>
                </div>
                <p class="form-submit">
                  <button type="submit" class="btn btn-success">Post Comment</button>
                </p>
              </form>
            </div>
          </div>
        </section>
      </div>
    </div>
  </main>
@endsection
