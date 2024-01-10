<div class="row">
    @csrf
    <div class="col-sm-12 p-0">
        <p class="comment-form-author">
            <label for="author">Your Name<span class="required">*</span></label>
            <input id="author" name="author"
                   type="text" value="" style="width:100%" aria-required="true">
        </p>
    </div>
    <div class="col-sm-12 p-0">
        <p class="comment-form-email">
            <label for="email">Your Email<span class="required">*</span></label>
            <input id="email" name="email" type="email" value="" style="width:100%" aria-required="true">
        </p>
    </div>
    <div class="col-sm-12 p-0">
        <p class="comment-form-email">
            <label for="email">Whatsapp/Phone<span class="required">*</span></label>
            <input id="whatsapp" name="whatsapp" type="text" value="" style="width:100%" aria-required="true">
        </p>
    </div>
    <div class="col-sm-12 p-0">
        <p class="comment-form-email">
            <label for="email">YOUR MESSAGE (OPTIONAL)</label>
            <textarea name="message" style="height: 7rem;width: 100% " ></textarea>
        </p>
    </div>
</div>
<p class="form-submit mt-3">
    <input name="submit" type="submit" id="submit" class="btn btn-send__form btn-danger"
           value="Submit">
    <input type="hidden" name="product-id"
           value="{{ $product->id }}" id="product-id"
           wfd-invisible="true">
</p>
