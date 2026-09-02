@extends('frontend.main_master')

@section('title')
    {{ $blogPost->post_title_en }}
@endsection


@section('content')

    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="/">Home</a></li>
                    <li class='active'>{{ $blogPost->post_title_en }}</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="blog-page">
                    <div class="col-md-9">
                        <div class="blog-post wow fadeInUp">
                            <img class="img-responsive" src="{{ asset($blogPost->post_image) }}" alt="">
                            <h1>{{ session()->get('language') == 'en' ? $blogPost->post_title_en : $blogPost->post_title_ar }}</h1>
                            <span class="date-time">{{ \Carbon\Carbon::parse($blogPost->created_at)->diffForHumans() }}</span>
                            <!-- start share product -->


                            @include('frontend.common.share-horizontal')

                            <!-- end share product -->
                            <p>{!! (Session()->get('language') == 'en') ?  $blogPost->post_details_en : $blogPost->post_details_ar  !!}</p>

                            <div >
                                <span>share post:</span>
                                <!-- start share product -->


                                @include('frontend.common.share-horizontal')

                                <!-- end share product -->
                            </div>
                        </div>

                        <div class="blog-write-comment outer-bottom-xs outer-top-xs">

                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-11">

                                    <div style="margin-bottom: 30px">
                                        <h4 class="title">Customer Reviews</h4>


                                        <div class="reviews">

                                            @php
                                                $comments = \App\Models\Blog\PostComment::where('post_id', $blogPost->id)->latest()->limit(5)->get();
                                            @endphp



                                            <div class="reviews">

                                                @forelse($comments as $item)
                                                    @if($item->status == 1)
                                                        <div class="review">

                                                            <div class="row">
                                                                <div class="col-md-6">

                                                                    <img style="border-radius: 50%" src="{{ !empty($item->user->profile_photo_path) ? url('upload/user_images/'.$item->user->profile_photo_path) : url('upload/no_image.jpg') }}"  width="40px;" height="40px;" alt="">
                                                                    <b>{{ $item->user->name }}</b>




                                                                </div>
                                                                <div class="col-md-6">

                                                                </div>
                                                            </div>

                                                            <div class="review-title"><span class="summary">{{ $item->title }} </span><span class="date" style="color: #888888;" ><i class="fa fa-calendar"></i><span> {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </span></span></div>
                                                            <div class="text">"{{ $item->comment }}"</div>
                                                        </div>
                                                    @else

                                                    @endif
                                                @empty
                                                    <p class="text-danger">No Comments Yet</p>
                                                @endforelse

                                            </div><!-- /.reviews -->

                                        </div><!-- /.reviews -->
                                    </div>

                                </div>
                            </div>


                            <form  action="{{ route('blog.post.comment', $blogPost->id) }}"  method="POST">
                                @csrf
                                <div class="row">

                                    <div class="col-md-12">
                                        <h4>Leave A Comment</h4>
                                    </div>

                                    @if(Auth::user())

                                        <div class="col-md-4">
                                            <div class="register-form" role="form">
                                                <div class="form-group">
                                                    <label class="info-title" for="title">Title <span>*</span></label>
                                                    <input type="text" name="title" class="form-control unicase-form-control text-input" id="title"
                                                           placeholder="Enter Title" value="{{ old('title') }}">
                                                </div>
                                                @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="register-form" role="form">
                                                <div class="form-group">
                                                    <label class="info-title" for="comment">Your Comments <span>*</span></label>
                                                    <textarea class="form-control unicase-form-control" name="comment" id="comment">
                                                    {{ old('comment') }}
                                                </textarea>
                                                </div>
                                                @error('comment')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12 outer-bottom-small m-t-20">
                                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Submit Comment</button>
                                        </div>
                                    @else

                                        <div class="col-md-12">
                                            <p>
                                                <b>For Add Comment . You need To Login First <a href="http://localhost:8000/login">Login Here</a></b>
                                            </p>
                                        </div>

                                    @endif



                                </div>
                            </form>
                        </div>


                    </div>
                    <div class="col-md-3 sidebar">



                        <div class="sidebar-module-container">
                            <div class="search-area outer-bottom-small">
                                <form>
                                    <div class="control-group">
                                        <input placeholder="Type to search" class="search-field">
                                        <a href="#" class="search-button"></a>
                                    </div>
                                </form>
                            </div>

                            <div class="home-banner outer-top-n outer-bottom-xs">
                                <img src="{{ asset('frontend/assets/images/banners/LHS-banner.jpg') }}" alt="Image">
                            </div>
                            <!-- ==============================================CATEGORY============================================== -->
                            <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                                <h3 class="section-title">Category</h3>
                                <div class="sidebar-widget-body m-t-10">
                                    <div class="accordion">

                                        @foreach($blogCategory as $category )
                                            <div class="accordion-group">
                                                <ul class="list-group">
                                                    <a href="{{ url('blog/category/post/'. $category->id) }}">
                                                        <li class="list-group-item">
                                                            {{ (Session()->get('language') == 'en') ?  $category->blog_category_name_en : $category->blog_category_name_ar  }}
                                                        </li>
                                                    </a>
                                                </ul>

                                            </div><!-- /.accordion-group -->
                                        @endforeach


                                    </div><!-- /.accordion -->
                                </div><!-- /.sidebar-widget-body -->
                            </div><!-- /.sidebar-widget -->
                            <!-- ============================================== CATEGORY : END ============================================== -->


                            <!-- ============================================== PRODUCT TAGS ============================================== -->
                                <div class="sidebar-widget product-tag wow fadeInUp">
                                    <h3 class="section-title">Product tags</h3>
                                    <div class="sidebar-widget-body outer-top-xs">
                                        <div class="tag-list">
                                            <a class="item" title="Phone" href="category.html">Phone</a>
                                            <a class="item active" title="Vest" href="category.html">Vest</a>
                                            <a class="item" title="Smartphone" href="category.html">Smartphone</a>
                                            <a class="item" title="Furniture" href="category.html">Furniture</a>
                                            <a class="item" title="T-shirt" href="category.html">T-shirt</a>
                                            <a class="item" title="Sweatpants" href="category.html">Sweatpants</a>
                                            <a class="item" title="Sneaker" href="category.html">Sneaker</a>
                                            <a class="item" title="Toys" href="category.html">Toys</a>
                                            <a class="item" title="Rose" href="category.html">Rose</a>
                                        </div><!-- /.tag-list -->
                                    </div><!-- /.sidebar-widget-body -->
                                </div><!-- /.sidebar-widget -->
                            <hr>
                            <!-- ============================================== PRODUCT TAGS : END ============================================== -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
