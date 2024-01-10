<div class="navbar-collapse offcanvas-collapse">
    <div class="box-offcanvas p-4">
        <div class="btn-close__nav"><i class="far fa-window-close"></i></div>
        <div class="row mb-20">
            <div class="col-sm-12 p-0">
                <div class="box-filter__header d-flex justify-content-between align-items-center">
                    <h3> Filter</h3>
                    <span class="clear-btn"><u>Clear Filter</u></span>
                </div>
                <div class="box-range mt-3">
                    <p>Price</p>
                    <div class="range-slide">
                        <div class="slide">
                            <div class="line" id="line" style="left: 0%; right: 0%;"></div>
                            <span class="range-thumb" id="thumbMin" style="left: 0%;"></span>
                            <span class="range-thumb" id="thumbMax" style="left: 100%;"></span>
                        </div>
                        <input id="rangeMin" type="range" max="150" min="1" step="1" value="0">
                        <input id="rangeMax" type="range" max="150" min="1" step="1" value="150">
                    </div>
                    <div class="display mt-3">
                       <span id="min">1</span>
                        <span id="max">150</span>
                    </div>

                </div>
                <div class="box-select__sort mt-3">
                    <p>Sort by</p>
                    <select class="form-control" name="order_by">
                        <option value="0">Default</option>
                        <option value="1">Price: low to high</option>
                        <option value="2">Price: high to low</option>
                        <option value="3">Name A to Z</option>
                        <option value="4">Name Z to A</option>
                        <option value="5">SKU ascending</option>
                        <option value="6">SKU descending</option>
                    </select>
                </div>
                @if($category->count())
                    <div class="box-radio__category mt-5">
                        <p>Product Category</p>
                        <ul class="list-unstyled list-category__filter">
                            @foreach($category as $item)
                                <li data-term-id="{{ $item->id }}" class="d-flex align-items-center" data-parent="0" data-term-slug="{{ $item->slug }}">
                                    <input type="radio" name="category" value="{{ $item->id }}">
                                    <label class="ml-2 choose__radio" for="category">{{ $item->title }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if($tags->count())
                    <div class="box-select__sort mt-5">
                        <p>Product tag</p>
                        <select class="form-control" name="product_tag">
                            <option value="0">Default</option>
                           @foreach($tags as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                           @endforeach
                        </select>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="box-bg__tran"></div>
</div>