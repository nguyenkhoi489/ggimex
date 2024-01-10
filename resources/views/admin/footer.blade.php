<!-- jQuery -->
<script src="{{ asset('/component/plugins/jquery/jquery.min.js') }}"></script>

<script>

    jQuery.ajaxSetup({
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Authentication' : '{{ request()->cookie('access_token')  }}'
        }
    });
    var base = '{{ route('home') }}';
    var apiSlug = '{{ route('slug.create') }}';
    var upload = '{{ route('media.store') }}';
    var api_post = '{{route('get.post.category')}}';
    var api_product = '{{ route('get.product.category') }}';
    var apiGetFolder = '{{route('get.folder')}}';
    var apiGetMedia = '{{ route('get.media') }}';
    var apiMedia = '{{ route('remove.media') }}';
    var apiSearch = '{{ route('media.search') }}';
    var apiUpdateMenus = '{{route('api.menu.update')}}';
    var apiUpdateProduct = '{{ route('api.product.update') }}';
</script>

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('/component/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/component/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/component/dist/js/adminlte.js') }}"></script>

<script src="{{ asset('/component/plugins/ckeditor/ckeditor.js') }}"></script>

<script src="{{ asset('/component/plugins/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('/component/plugins/select2/js/select2.full.min.js') }}"></script>

<script src="{{ asset('/component/js/main.js') }}"></script>
<script type="text/javascript">
    //Initialize Select2 Elements
    jQuery('.select2').select2({
        maximumSelectionLength: 4
    })

</script>

<div class="modal fade" id="modal-xl" data-last="">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Danh Sách Media</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                                   href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                                   aria-selected="true">Hình Ảnh</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                                   href="#custom-tabs-three-profile" role="tab"
                                   aria-controls="custom-tabs-three-profile" aria-selected="false">Tải Lên</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
                                 aria-labelledby="custom-tabs-three-home-tab">
                                <div class="row filer-show__media">

                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-success btn-loadMore">Load More</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                                 aria-labelledby="custom-tabs-three-profile-tab">
                                <div class="form-group row">
                                    <input type="file" id="input-file" class="file-upload"
                                           data-height="500"/>
                                </div>
                                <div class="form-group row">
                                    <button type="button" class="btn disabled btn-upload__file btn-primary">Tải Lên
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success btn-confirm__choice" disabled>Xác nhận</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script type="text/javascript">
    var sweet_loader = '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';
    CKEDITOR.config.filebrowserImageUploadUrl = '{!! route('media.ckeditor',['_token' => csrf_token()]) !!}';

    $(document).ready(function () {
        $('#input-file').change(function () {
            $('.btn-upload__file').removeClass('disabled')
        })
        $('.btn-upload__file').click(function (e) {
            e.preventDefault();
            var form = new FormData();
            form.append('file', $('#input-file')[0].files[0])
            $.ajax({
                url: upload,
                data: form,
                type: "POST",
                enctype: 'multipart/form-data',
                processData: false,  // tell jQuery not to process the data
                contentType: false,   // tell jQuery not to set contentType
                beforeSend: function () {
                    swal.fire(
                        {
                            html: sweet_loader + "<h4>Đang tải lên dữ liệu</h4>",
                            showConfirmButton: false
                        }
                    )
                },
                success: function (response) {
                    swal.close();
                    console.log(response.error)
                    if (response.error == false) {
                        Swal.fire({
                            title: "Thành công",
                            text: response.message,
                            icon: "success",
                            confirmButtonColor: "#27f700",
                            confirmButtonText: "Xác nhận"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#modal-xl').modal('hide');
                                let attr = $('#modal-xl').attr('data-last');
                                $(`input[name="${attr}"]`).val(response.url);
                            }
                        });
                    }
                }
            })
        })
        $('body').on('click','.btn-choice__thumb-func',function (e) {
            e.preventDefault();
            $('.thumbnail.active').removeClass('active');
            $(this).parent().addClass('active');
            $('.btn-confirm__choice').removeAttr('disabled')
        })
        $('.btn-confirm__choice').click(function () {
            let modal = $('#modal-xl');
            modal.modal('hide');
            $(`input[name="${modal.attr('data-last')}"]`).val(modal.find('.thumbnail.active a').attr('data-url'));
        })
    })
</script>
