@extends('layouts.app')

@section('content')
  <main id="content">
    <div class="content-widget">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <h4 class="spanborder">
              Hasil pencarian untuk <span>"{{ $query }}"</span>
            </h4>

            @if ($results->isEmpty())
              <p>No results found for "{{ $query }}". Please try again with a different keyword.</p>
            @else
              @foreach ($results as $result)
                <article class="row justify-content-between mb-5 mr-0">
                  <div class="col-md-9">
                    <div class="align-self-center">
                      <div class="capsSubtle mb-2">{{ $result->category->name ?? 'Uncategorized' }}</div>
                      <h3 class="entry-title mb-3">
                        <a href="{{ route('articles.show', $result->slug) }}">{{ $result->title }}</a>
                      </h3>
                      <div class="entry-excerpt">
                        <p>{{ Str::limit(strip_tags($result->content), 150) }}</p>
                      </div>
                      <div class="entry-meta align-items-center">
                        <a href="{{ route('author', $result->user->username) }}">{{ $result->user->name }}</a>
                        in <a
                          href="{{ route('categories.show', $result->category->slug) }}">{{ $result->category->name }}</a><br>
                        <span>{{ $result->created_at->format('M d, Y') }}</span>
                        <span class="middotDivider"></span>
                        <span class="readingTime"
                          title="{{ $result->reading_time }} min read">{{ $result->reading_time }} min read</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 bgcover"
                    style="background-image:url({{ $result->featured_image ? asset('storage/' . $result->featured_image) : asset('assets/images/default-image.jpg') }});">
                  </div>
                </article>
              @endforeach

              <div class="mt-4">
                {{ $results->links() }}
              </div>
            @endif
          </div>

          <div class="col-md-4 pl-md-5 sticky-sidebar">
            <div class="sidebar-widget latest-tpl-4">
              <h5 class="spanborder widget-title">
                <span>Trending di Medan</span>
              </h5>
              <ol>
                @foreach ($highlightPosts as $index => $highlight)
                  <li class="d-flex">
                    <div class="post-count">{{ sprintf('%02d', $index + 1) }}</div>
                    <div class="post-content">
                      <h5 class="entry-title mb-3">
                        <a href="{{ route('articles.show', $highlight->slug) }}">{{ $highlight->title }}</a>
                      </h5>
                      <div class="entry-meta align-items-center">
                        <a href="{{ route('author', $highlight->user->username) }}">{{ $highlight->user->name }}</a>
                        in <a
                          href="{{ route('categories.show', $highlight->category->slug) }}">{{ $highlight->category->name }}</a><br>
                        <span>{{ $highlight->created_at->format('M d, Y') }}</span>
                        <span class="middotDivider"></span>
                        <span class="readingTime"
                          title="{{ $highlight->reading_time }} min read">{{ $highlight->reading_time }} min read</span>
                      </div>
                    </div>
                  </li>
                @endforeach
              </ol>
            </div>
          </div> <!--col-md-4-->
        </div>
      </div> <!--content-widget-->
    </div>

    <div class="content-widget">
      <div class="container">
        <div class="sidebar-widget ads">
          @include('components.adsense-responsive')
        </div>
        <div class="hr"></div>
      </div>
    </div>
  </main>
@endsection
