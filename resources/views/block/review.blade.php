<div>
    <div class="row">
        <div class="col-sm-12">
            <div id="respond" class="comment-respond">
                <h3 id="reply-title" class="comment-reply-title">
                    Add a review
                </h3>
                <div class="comment-form">
                    <p class="comment-notes">
                        <span id="email-notes">Your email address will not be published.</span>
                        <span class="required-field-message">Required fields are marked
                                        <span class="required">*</span>
                                    </span>
                    </p>
                    <div class="row">
                        <div class="col-sm-12 p-0">
                            <p class="comment-form-email">
                                <label for="email">your Rating<span class="required">*</span></label>
                            <p class="stars">
                                <span class="fa fa-star rating-choice"></span>
                                <span class="fa fa-star rating-choice"></span>
                                <span class="fa fa-star rating-choice"></span>
                                <span class="fa fa-star rating-choice"></span>
                                <span class="fa fa-star rating-choice"></span>
                            </p>
                            <input type="hidden" name="star">
                        </div>
                        <div class="col-sm-12 p-0">
                            <p>
                                <label for="comment">Your Review <span class="required">*</span>
                                </label>
                                <textarea id="comment" name="your-comment" cols="45"
                                          rows="8" aria-required="true"></textarea>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 p-0">
                            <p class="comment-form-author">
                                <label for="author">Name<span class="required">*</span></label>
                                <input id="author" name="your-author"
                                       type="text" value="" style="width:100%" aria-required="true">
                            </p>
                        </div>
                        <div class="col-sm-12 p-0">
                            <p class="comment-form-email">
                                <label for="email">Email<span class="required">*</span></label>
                                <input id="email" name="your-email" type="email" value="" style="width:100%"
                                       aria-required="true">
                            </p>
                        </div>
                    </div>

                    <p class="form-submit mt-3">
                        <input name="submit" type="submit" id="submit" class="btn btn-comment__form btn-danger"
                               value="Submit">
                        <input type="hidden" name="comment_post_ID"
                               value="{{ $product->id }}"
                               wfd-invisible="true">
                        <input type="hidden" name="slug" value="{{ Request::url() }}">
                    </p>
                </div>
            </div><!-- #respond -->
        </div>
    </div>
</div>
