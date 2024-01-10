<section class="comments_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-8 m-auto">
                <div id="comments" class="comments-area">
                    @if($comments->count())
                        <h2 class="woocommerce-Reviews-title mt-5">
                            {{ $comments->count() }} comment for <span>{{ $post->title }}</span></h2>
                        <ol class="commentlist list-unstyled mb-5">
                            @foreach($comments as $item)
                                <li class="review even thread-even depth-1" id="li-comment-21604">
                                    <div id="comment-21604" class="comment_container d-flex align-items-center">
                                        <img alt=""
                                             src="{{ asset('storage/2023/12/25/1703489666avata.png') }}"
                                             class="avatar avatar-60 photo" height="60" width="60"
                                             loading="lazy" decoding="async">
                                        <div class="comment-text">
                                            <p class="meta">
                                                <strong class="woocommerce-review__author">
                                                    {{ $item->name }}
                                                </strong>
                                                <span class="woocommerce-review__dash">–</span>
                                                <time class="woocommerce-review__published-date"
                                                      datetime="{{ $item->created_at }}">
                                                    {{ date('d/m/Y',strtotime($item->created_at)) }}
                                                </time>
                                            </p>

                                            <div class="description">
                                                <p>
                                                    {{ $item->message }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-separator"></div>
                                </li><!-- #comment-## -->
                            @endforeach
                        </ol>
                    @endif
                    <div class="row">
                        <div class="col-sm-12 p-0">
                            <div id="respond" class="comment-respond">
                                <h3 id="reply-title" class="comment-reply-title">
                                    Leave a Reply
                                    <small>
                                        <a rel="nofollow"
                                           id="cancel-comment-reply-link"
                                           href="/agar-powder/#respond"
                                           style="display:none;" wfd-invisible="true">Cancel reply</a>
                                    </small>
                                </h3>
                                <div  id="commentform"
                                      class="comment-form">
                                    <p class="comment-notes">
                                        <span id="email-notes">Your email address will not be published.</span>
                                        <span class="required-field-message">Required fields are marked
                                        <span class="required">*</span>
                                    </span>
                                    </p>
                                    <div class="row">
                                        <div class="col-sm-12 p-0">
                                            <p>
                                                <label for="comment">Message <span class="required">*</span>
                                                </label>
                                                <textarea id="comment" name="your-comment" cols="45"
                                                          rows="8" aria-required="true"></textarea>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 p-0">
                                            <p class="comment-form-author">
                                                <label for="author">Name<span class="required">*</span></label>
                                                <input id="author" name="your-author"
                                                       type="text" value="" style="width:100%" aria-required="true">
                                            </p>
                                        </div>
                                        <div class="col-sm-6 pr-0">
                                            <p class="comment-form-email">
                                                <label for="email">Email Address <span class="required">*</span></label>
                                                <input id="email" name="your-email" type="email" value="" style="width:100%" aria-required="true">
                                            </p>
                                        </div>
                                    </div>

                                    <p class="form-submit mt-3">
                                        <input name="submit" type="submit" id="submit" class="btn btn-comment__form btn-danger"
                                               value="Post Comment">
                                        <input type="hidden" name="comment_post_ID"
                                               value="{{ $post->id }}" id="comment_post_ID"
                                               wfd-invisible="true">
                                        <input type="hidden" name="slug" value="{{ Request::url() }}">
                                    </p>
                                </div>
                            </div><!-- #respond -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

