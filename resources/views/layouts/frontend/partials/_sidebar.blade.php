<!-- Blog Sidebar
            ===================================== -->
            <div id="sidebar" class="col-md-3 mt50 animated" data-animation="fadeInRight"
            data-animation-delay="250">


            <!-- Search
        ===================================== -->
            <div class="pr25 pl25 clearfix">
                <form action="#">
                    <div class="blog-sidebar-form-search">
                        <form action="{{route('blogs.home')}}" method = "GET">
                            <input type="text"
                                name="search"
                                value="{{request('search')}}"
                                class=""
                                placeholder="e.g. Javascript">
                            <button type="submit" name="submit" class="pull-right"><i
                                class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                </form>

            </div>


            <!-- Categories
        ===================================== -->
            <div class="mt25 pr25 pl25 clearfix">
                <h5 class="mt25">
                    Categories
                    <span class="heading-divider mt10"></span>
                </h5>
                <ul class="blog-sidebar pl25">
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{route('blogs.category', $category->id)}}">{{ $category->name }}
                                <span class="badge badge-pasific pull-right">
                                    {{ $category->posts()->published()->count() }}
                                </span></a>
                        </li>
                    @endforeach
                </ul>

            </div>


            <!-- Tags
        ===================================== -->
            <div class="pr25 pl25 clearfix">
                <h5 class="mt25">
                    Popular Tags
                    <span class="heading-divider mt10"></span>
                </h5>
                <ul class="tag">
                    @foreach ($tags as $tag)
                        <li>
                            <a href="{{route('blogs.tag', $tag->id)}}">{{ $tag->name }}</a>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
