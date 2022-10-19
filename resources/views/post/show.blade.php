@extends('layouts.main')

@section('content')
    <main class="blog-post">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">{{  $post->title }}</h1>
            <p class="edica-blog-post-meta" data-aos="fade-up" data-aos-delay="200">Written by Richard Searls
                • {{ $date->format('M d Y H:i') }} • {{ $post->comments->count() }} Comments • </p>
            <form action="{{  route('post.like.store', $post->id) }}" method="post">
                @csrf
                <span>{{ $post->liked_users_count }}</span>
                <button type="submit" class="border-0 bg-transparent">
                    @auth()
                        @if(auth()->user()->likedPosts->contains($post->id))
                            <i class="fas fa-heart"></i>
                        @else
                            <i class="far fa-heart"></i>
                        @endif
                    @endauth
                </button>
            </form>
            <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset($post->preview_image) }}" alt="featured image" class="w-100">
            </section>
            <section class="post-content">
                <div class="row">
                    <div class="col-lg-9 mx-auto" data-aos="fade-up">
                        {!! $post->content !!}
                    </div>
                </div>
            </section>
        </div>
        <div class="container mt-5 mb-5">
            <div class="d-flex justify-content-center row">
                <div class="d-flex flex-column col-md-8">
                    <div class="coment-bottom bg-white p-2 px-4">
                        @foreach($post->comments as $comment)
                            <div
                                class="commented-section mt-2">
                                <div class="d-flex flex-row align-items-center commented-user">
                                    <h5 class="mr-2">{{$comment->user->name}}</h5><span class="dot mb-1"></span><span
                                        class="mb-1 ml-2">{{ $comment->dateAsCarbon->diffForHumans() }}</span></div>
                                <div class="comment-text-sm"><span>{{ $comment->message}}</span></div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 mx-auto">
                <section class="related-posts">
                    <h2 class="section-title mb-4" data-aos="fade-up">Related Posts</h2>
                    <div class="row">
                        @foreach($relatedPosts as $relatedPost)
                            <div class="col-md-4" data-aos="fade-right" data-aos-delay="100">
                                <img src="{{ asset($relatedPost->preview_image) }}" alt="related post"
                                     class="post-thumbnail">
                                <p class="post-category">{{$relatedPost->category->title}}</p>
                                <a href="{{  route('post.show', $relatedPost->id) }}" class="blog-post-permalink">
                                    <h5 class="post-title">{{  $relatedPost->title }}</h5></a>
                            </div>
                        @endforeach
                    </div>
                </section>
                @auth()
                    <section class="comment-section">
                        <h2 class="section-title mb-5" data-aos="fade-up">Leave a Reply</h2>
                        <form action=" {{ route('post.comment.store', $post->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12" data-aos="fade-up">
                                    <label for="comment" class="sr-only">Comment</label>
                                    <textarea name="message" id="comment" class="form-control" placeholder="Comment"
                                              rows="10"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12" data-aos="fade-up">
                                    <input type="submit" value="Send Message" class="btn btn-warning">
                                </div>
                            </div>
                        </form>
                    </section>
                @endauth
            </div>
        </div>
    </main>
@endsection
