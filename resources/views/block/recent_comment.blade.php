<aside class="widget widget_block">
    <h2 class="widget-title">Recent Comments</h2>
    <ul class="latest-posts__list latest-posts list-unstyled">
        @foreach($comments as $item)
            <li>
                <div class="box-comment__list">
                                    <span class="latest-posts__post-author">
                                        {{ $item->name }}
                                    </span>
                    on
                    <a class="latest-posts__post-title"
                       href="{{ url($item->post_slug) }}">
                        {{ $item->post_title }}
                    </a>
                </div>

            </li>
        @endforeach
    </ul>
</aside>