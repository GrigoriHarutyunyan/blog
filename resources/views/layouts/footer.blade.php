<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <h2 class="widget-title">Recent Posts</h2>
                    <div class="blog-list-widget">
                        <div class="list-group">
                            @foreach($recent_posts as $recent_post)
                                <a href="{{route("posts.single",["slug"=>$recent_post->slug])}}" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="w-100 justify-content-between">
                                        <img src="{{$recent_post->getImage()}}" alt="" class="img-fluid float-left">
                                        <h5 class="mb-1">{{$recent_post->title}}</h5>
                                        <small>{{$recent_post->getPostDate()}}</small>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div><!-- end blog-list -->
                </div><!-- end widget -->
            </div><!-- end col -->

            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <h2 class="widget-title">Popular Posts</h2>
                    <div class="blog-list-widget">
                        <div class="list-group">
                            @foreach($popular_posts as $post)
                                <a href="{{route('posts.single',['slug'=>$post->slug])}}" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="w-100 justify-content-between">
                                        <img src="{{$post->getImage()}}" alt="" class="img-fluid float-left">
                                        <h5 class="mb-1">{{$post->title}}</h5>

                                        <small><i class="fa fa-eye"></i> {{$post->views}} </small>
                                        <span class="rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div><!-- end blog-list -->
                </div><!-- end widget -->
            </div><!-- end col -->

            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <h2 class="widget-title">Popular Categories</h2>
                    <div class="link-widget">
                        <ul>
                            @foreach($cats as $cat)
                                <li><a href="{{route('categories.single', ['slug'=>$cat->slug])}}">{{$cat->title}} <span>{{$cat->posts_count}}</span></a></li>
                            @endforeach()
                        </ul>
                    </div><!-- end link-widget -->
                </div><!-- end widget -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</footer><!-- end footer -->
