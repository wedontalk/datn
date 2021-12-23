@extends('layouts.site')
@section('main')

      <!-- Breadcrumb Section Begin -->
      <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Tin tức</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1">
                    <div class="blog-sidebar">
                        <div class="search-form">
                            <h4>Tìm kiếm</h4>
                            <form action="" method="GET" role="form">
                                <input type="text" placeholder="Tìm kiếm . . .  " name="key">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <!-- <div class="blog-catagory">
                            <h4>Categories</h4>
                            <ul>
                                <li><a href="#">Fashion</a></li>
                                <li><a href="#">Travel</a></li>
                                <li><a href="#">Picnic</a></li>
                                <li><a href="#">Model</a></li>
                            </ul>
                        </div> -->
                        <div class="recent-post">
                            <h4>Bài Đăng gần đây</h4>
                            <div class="recent-blog">
                                @foreach($baidang as $bd)
                                <a href="{{URL::to('/news/'.$bd->slug)}}" class="rb-item">
                                    <div class="rb-pic">
                                        <img src="{{asset('uploads')}}/{{$bd->image}}" alt="">
                                    </div>
                                    <div class="rb-text">
                                        <h6>{{$bd->name_post}}</h6>
                                        <p>Tin tức <span>- {{$bd->created_at}}</span></p>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <!-- <div class="blog-tags">
                            <h4>Product Tags</h4>
                            <div class="tag-item">
                                <a href="#">Towel</a>
                                <a href="#">Shoes</a>
                                <a href="#">Coat</a>
                                <a href="#">Dresses</a>
                                <a href="#">Trousers</a>
                                <a href="#">Men's hats</a>
                                <a href="#">Backpack</a>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="row">
                        @foreach($blog as $key => $news)
                        <div class="col-lg-6 col-sm-6">
                            <div class="blog-item">
                                <div class="bi-pic">
                                    <img src="{{asset('uploads')}}/{{$news->image}}" alt="" height="350px">
                                </div>
                                <div class="bi-text">
                                    <a href="{{URL::to('/news/'.$news->slug)}}">
                                        <h4>{{$news->name_post}}</h4>
                                    </a>
                                    <p>Tin tức <span>{{$news->updated_at}}</span></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-lg-12">
                            <!-- <div class="loading-more">
                                <i class="icon_loading"></i>
                                <a href="#">
                                    Loading More
                                </a>
                            </div> -->
                            <div class="loading-more">
                                <!-- <i class="icon_loading"></i> -->
                                {{$blog->appends(request()->all())->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection