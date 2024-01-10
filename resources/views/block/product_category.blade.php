<section class="min-100 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 m-auto">
                <h3 class="text-center mt-50">{{ $data->title_category }}</h3>
                <p style="text-align: center;">{{ $data->sub_title_category }}</p>
                <div class="row">
                    @if(\App\Models\ProductCategories::whereIn('id',$data->category)->get())
                        @php($categories = \App\Models\ProductCategories::whereIn('id',$data->category)->get())

                        <div class="col-sm-12 col-md-12 col-lg-6 category_box_1">
                            <div class="category_grid_box">
                                        <span class="category_item_bkg"
                                              style="background-image:url({{ asset($categories[0]->thumb) }})"></span>
                                <a href="{{ url('product-category/'. $categories[0]->slug) }}" class="category_item">
                                    <span class="category_name">{{ $categories[0]->title }}												</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 category_box_2 pl-0">
                            <div class="category_grid_box mb-20">
                                <span class="category_item_bkg"
                                      style="background-image:url({{ asset($categories[1]->thumb) }})"></span>
                                <a href="{{ url('product-category/'. $categories[1]->slug) }}" class="category_item">
                                    <span class="category_name">{{ $categories[1]->title }}														</span>
                                </a>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6 pl-0">
                                    <div class="category_grid_box">
                                        <span class="category_item_bkg"
                                              style="background-image:url({{ asset($categories[2]->thumb) }})"></span>
                                        <a href="{{ url('product-category/'. $categories[2]->slug) }}" class="category_item">
                                            <span class="category_name">{{ $categories[2]->title }}														</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 pr-0">
                                    <div class="category_grid_box">
                                        <span class="category_item_bkg"
                                              style="background-image:url({{ asset($categories[3]->thumb) }})"></span>
                                        <a href="{{ url('product-category/'. $categories[3]->slug) }}" class="category_item">
                                            <span class="category_name">{{ $categories[3]->title }}														</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
