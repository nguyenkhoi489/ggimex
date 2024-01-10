<div class="row mt-3">
    <div class="col-sm-12">
        <div class="box-product__item mt-5">
            <ul class="list-unstyled blog-posts flex-wrap d-flex">
                @foreach($posts as $key => $item)
                    <li class="blog-post {{ $key == 0 ? "first-post" : "" }}">
                        <article id="{{ $item->id }}"
                                 class="post type-post status-publish">
                            <ul class="post-categories">
                                <li>
                                    <a href="{{ url('category/' . $item->category_link) }}" rel="category tag">
                                        {{ $item->category_name }}
                                    </a>
                                </li>
                            </ul>
                            <div class="bg-image-wrapper text-left">
                                <a class="post-link" href="{{ url($item->slug) }}">
										<span class="post-image">
                                            <img
                                                 src="{{ asset($item->thumb) }}"
                                                 class="attachment-post-thumbnail size-post-thumbnail"
                                                 alt="ginger" decoding="async">
                                        </span>
                                </a>
                            </div>
                            <div class="post_content_wrapper">
                                <div class="post_content">
                                    <h3 class="entry-title">
                                        <a href="{{ url($item->slug) }}" rel="bookmark">
                                            {{ $item->title }}
                                        </a>
                                    </h3>
                                    <p>{{ App\Helper\Helper::create_short($item->content,100) }}</p>
                                    <a class="read_more" href="{{ url($item->slug) }}">Continue Reading</a>
                                </div>
                            </div>
                        </article>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-sm-12 nav-paginate">
        {{ $posts->withquerystring()->links()  }}
    </div>
</div>
