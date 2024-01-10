@extends('main')
@section('content')
    @include('post.header-title')
    <div class="container contact">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-5">
                <div class="box-content p-5" style="background-color: rgb(244, 244, 244)">
                    <h2 class="mb-4">Contact Info</h2>
                    <div class="textwidget">
                        <p>{{ $setting->title }}</p>
                        <p>Address: {{ $setting->address }}</p>
                        <p>Call:{{ $setting->phone }}</p>
                        <p>Tax Code: {{ $setting->tax }}</p>
                        <p>Email: {{ $setting->email }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-7">
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
                </p>
                <script type="text/javascript">
                    var api_submit = '{{ route('form.submit') }}';
                </script>
            </div>
        </div>
    </div>
    <div class="mt-5">
        {!! $setting->iframe !!}
    </div>
@endsection
