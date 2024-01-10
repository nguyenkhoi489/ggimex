<aside class="widget widget_block">
    <h2 class="widget-title">Recent Posts</h2>
    <ul class="latest-posts__list latest-posts list-unstyled">
        @foreach($recent_post as $item)
            <li>
                <a class="latest-posts__post-title"
                   href="{{ url($item->slug) }}">
                    {{ $item->title }}
                </a>
            </li>
        @endforeach
    </ul>
</aside>