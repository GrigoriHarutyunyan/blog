@extends('layouts.category_layout')
@section('title', $post->title . '::Markedia - Marketing Blog Template')
@section('content')

    <div class="content-wrapper">
        <div class="containner mt-2">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                    @endif

                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
{{--        {{dd($post->id)}}--}}

    <div class="page-wrapper">
        <div class="blog-title-area">
            <ol class="breadcrumb hidden-xs-down">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('categories.single', ['slug'=> $post->category->slug])}}">{{$post->category->title}}</a></li>
                <li class="breadcrumb-item active">{{$post->title}}</li>
            </ol>

            <span class="color-yellow"><a href="{{route('categories.single', ['slug'=> $post->category->slug])}}" title="">{{$post->category->title}}</a></span>

            <h3>{{$post->title}}</h3>

            <div class="blog-meta big-meta">
                <small>{{$post->getPostDate()}}</small>
                <small><i class="fa fa-eye"> {{$post->views}} </i></small>
            </div><!-- end meta -->
        </div><!-- end title -->

        <div class="single-post-media">
            <img src="{{$post->getImage()}}" alt="" class="img-fluid">
        </div><!-- end media -->

        <div class="blog-content">
           {!! $post->content !!}
        </div><!-- end content -->

        <div class="blog-title-area">
            @if($post->tags->count())
                <div class="tag-cloud-single">
                    <span>Tags</span>
                    @foreach($post->tags as $tag )
                        <small><a href="{{route('tags.single', ['slug'=>$tag->slug])}}" title="">{{$tag->title}}</a></small>
                    @endforeach
                </div><!-- end meta -->
            @endif

            <div class="post-sharing">
                <ul class="list-inline">
                    <div class="addthis_inline_share_toolbox"></div>
                </ul>
            </div><!-- end post-sharing -->
        </div><!-- end title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="banner-spot clearfix">
                    <div class="banner-img">
                        <img src="{{$post->getImage()}}" alt="" class="img-fluid">
                    </div><!-- end banner-img -->
                </div><!-- end banner -->
            </div><!-- end col -->
        </div><!-- end row -->
        <hr class="invis1">


        <div class="custombox clearfix">
            <h4 class="small-title">You may also like</h4>
            <div class="row">
                @foreach($like_posts as $like_post)
                    <div class="col-lg-6">
                        <div class="blog-box">
                            <div class="post-media">
                                <a href="{{route('posts.single', ['slug'=>$like_post->slug])}}" title="">
                                    <img src="{{$like_post->getImage()}}" alt="" class="img-fluid">
                                    <div class="hovereffect">
                                        <span class=""></span>
                                    </div><!-- end hover -->
                                </a>
                            </div><!-- end media -->
                            <div class="blog-meta">
                                <h4><a href="{{route('posts.single', ['slug'=>$like_post->slug])}}" title="">{{$like_post->title}}</a></h4>
                                <small><a href="{{route('categories.single',['slug'=>$like_post->category->slug])}}" title="">{{$post->category->title}}</a></small>
                                <small>{{$like_post->getPostDate()}}</small>
                            </div><!-- end meta -->
                        </div><!-- end blog-box -->
                    </div><!-- end col -->
                @endforeach
            </div><!-- end row -->
        </div><!-- end custom-box -->

<hr class="invis1">
<div class="custombox clearfix">
<h4 class="small-title">{{$commented_posts->count()}} Comments</h4>
<div class="row">
    <div class="col-lg-12">
        <div class="comments-list">
            @foreach($commented_posts as $comment)
            <div class="media">
                <a class="media-left" href="{{route('posts.single',['slug'=>$comment->post->slug])}}">
                    <img src="{{$comment->post->getImage()}}" alt="" class="rounded-circle">
                </a>
                <div class="media-body">
                    <h4 class="media-heading user_name"> {{$comment->name}} <small>{{$comment->getCommentDate()}}</small></h4>
                    <p>{{$comment->comment}}</p>
                    <a href="#" class="btn btn-primary btn-sm">Reply</a>
                </div>
            </div>
            @endforeach
        </div>
    </div><!-- end col -->
</div><!-- end row -->
</div><!-- end custom-box -->

<hr class="invis1">

<div class="custombox clearfix">
<h4 class="small-title">Leave a Reply</h4>
<div class="row">
    <div class="col-lg-12">
        <form class="form-wrapper" method="post" action="{{route('posts.single', ['slug'=>$post->slug])}}">
            @csrf
            @auth()
                <input type="hidden" name="name" class="form-control"  value="{{auth()->user()->name}}">
                <input type="hidden" name="email" class="form-control" value="{{auth()->user()->email}}">
                <input type="hidden" name="user_id" class="form-control"  value="{{auth()->user()->id}}">
            @endauth
                @guest()
                    <input type="text" name="name" class="form-control"  placeholder="Your name">
                    <input type="email" name="email" class="form-control"  placeholder="Email address"  >
                @endguest()
            <input type="hidden" name="post_id" class="form-control"  value="{{$post->id}}">
            <textarea class="form-control" name="comment" placeholder="Your comment"></textarea>
            <button type="submit" class="btn btn-primary">Submit Comment</button>
        </form>
    </div>
</div>
</div>
</div><!-- end page-wrapper -->
</div><!-- end col -->

{{--    @foreach($commented_posts as $comment)--}}
{{--        {{dd($comment->)}}--}}
{{--    @endforeach--}}

    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-613217ce48741564"></script>


@endsection


