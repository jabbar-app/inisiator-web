@extends('layouts.app')

@section('content')
  <main id="content">
    <div class="content-widget">
      <div class="container">
        <div class="row">
          <!-- Main Content -->
          <div class="col-md-8">
            <!-- Author Section -->
            <div class="box box-author m_b_2rem">
              <div class="post-author row-flex">
                <div class="author-img">
                  <img alt="author avatar"
                    src="{{ $author->avatar ? asset($author->avatar) : asset('front/img/profpic.png') }}"
                    class="avatar">
                </div>
                <div class="author-content">
                  <div class="top-author">
                    <h4 class="heading-font mb-1"><a href="#" title="{{ $author->name }}"
                        rel="author">{{ $author->name }}</a></h4>
                  </div>
                  <div class="profile-stats">
                    <p class="mb-2">
                      {{ $author->followers()->count() }} followers &nbsp;&nbsp;&nbsp;
                      {{ $author->followings()->count() }} following
                    </p>
                    @if ($author->id != Auth::id())
                    <div class="my-2">
                      @if (auth()->user()->isFollowing($author))
                        <form action="{{ route('users.unfollow', $author) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Unfollow</button>
                        </form>
                      @else
                        <form action="{{ route('users.follow', $author) }}" method="POST">
                          @csrf
                          <button type="submit" class="btn btn-primary">Follow</button>
                        </form>
                      @endif
                    </div>
                    @endif
                  </div>

                  <p class="d-none d-md-block">{{ $author->bio ?? 'Penulis belum menambahkan biografi.' }}</p>
                  <div class="content-social-author">
                    @if ($author->social_links)
                      @foreach (json_decode($author->social_links, true) as $platform => $link)
                        <a target="_blank" class="author-social" href="{{ $link }}">{{ ucfirst($platform) }}</a>
                      @endforeach
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <!-- Articles -->
            <h4 class="spanborder">
              <span>Latest Posts by {{ $author->name }}</span>
            </h4>
            @forelse ($author->articles as $article)
              <article class="row justify-content-between mb-5 mr-0">
                <div class="col-md-9">
                  <div class="align-self-center">
                    <div class="capsSubtle mb-2">{{ $article->category->title }}</div>
                    <h3 class="entry-title mb-3">
                      <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                    </h3>
                    <div class="entry-excerpt">
                      <p>{{ Str::limit(strip_tags($article->content), 150) }}</p>
                    </div>
                    <div class="entry-meta align-items-center">
                      <a href="{{ route('pages.author', $article->user_id) }}">{{ $article->user->name }}</a> in
                      <a
                        href="{{ route('categories.show', $article->category->slug) }}">{{ $article->category->title }}</a><br>
                      <span>{{ $article->created_at->format('M d, Y') }}</span>
                      <span class="middotDivider"></span>
                      <span class="readingTime"
                        title="{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min read">
                        {{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min read
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 bgcover"
                  style="background-image:url({{ $article->img_featured ? asset('storage/' . $article->img_featured) : asset('assets/images/default-thumbnail.jpg') }});">
                </div>
              </article>
            @empty
              <p>{{ $author->name }} belum memiliki artikel.</p>
            @endforelse
          </div>

          <!-- Sidebar -->
          <div class="col-md-4 pl-md-5 sticky-sidebar">
            <!-- Highlighted Posts -->
            <div class="sidebar-widget latest-tpl-4">
              <h5 class="spanborder widget-title">
                <span>Highlight Posts</span>
              </h5>
              <ol>
                @foreach ($highlightPosts as $index => $highlight)
                  <li class="d-flex">
                    <div class="post-count">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="post-content">
                      <h5 class="entry-title mb-3">
                        <a href="{{ route('articles.show', $highlight->slug) }}">{{ $highlight->title }}</a>
                      </h5>
                      <div class="entry-meta align-items-center">
                        <a href="{{ route('pages.author', $highlight->user_id) }}">{{ $highlight->user->name }}</a> in
                        <a
                          href="{{ route('categories.show', $highlight->category->slug) }}">{{ $highlight->category->title }}</a><br>
                        <span>{{ $highlight->created_at->format('M d, Y') }}</span>
                        <span class="middotDivider"></span>
                        <span class="readingTime"
                          title="{{ ceil(str_word_count(strip_tags($highlight->content)) / 200) }} min read">
                          {{ ceil(str_word_count(strip_tags($highlight->content)) / 200) }} min read
                        </span>
                      </div>
                    </div>
                  </li>
                @endforeach
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content-widget">
      <div class="container">
        <div class="sidebar-widget ads">
          @include('components.adsense-responsive')
        </div>
        <div class="hr"></div>
      </div>
    </div> <!--content-widget-->
  </main>
@endsection
