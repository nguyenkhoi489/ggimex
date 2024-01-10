$(document).ready(function () {
    var sweet_loader = '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    CKEDITOR.replaceClass = 'ckeditor';
    $('.btn-open-thumb').click(function () {
        let parent = $(this).parent().parent().parent();
        let attr = $(parent.find("[data-choise=\"upload-images\"]")).attr('name');
        load_image();
        $('#modal-xl').attr('data-last', attr)

    })
    //create slug
    $('input.form-control[name="title"],input.form-control[name="title_seo"]').keyup(function () {
        let title = $(this).val();
        let target = $(this).attr('data-target');
        create_slug(title, target)
    })

    // edit link
    $('.btn-edit__permalink').click(function () {
        let parent = $(this).parent().parent();
        parent.find('input').removeAttr('readonly')
    })

    $('select[name="type"]').change(function () {
        let val = $(this).find('option:selected').val();
        if (val == 0) {
            $('input[name="text"]').prop('readonly', true);
            $('input[name="subtext"]').prop('readonly', true);
            $('select[name="text_position"]').prop('disabled', true);
        } else {
            $('input[name="text"]').removeAttr('readonly');
            $('input[name="subtext"]').removeAttr('readonly');
            $('select[name="text_position"]').removeAttr('disabled');
        }
    })

    //thay doi loai gia tien
    $('select[name="price_type"]').change(function () {
        let val = $(this).find('option:selected').val();
        val == 0 ?
            $('.price-to').addClass('d-none') :
            $('.price-to').removeClass('d-none');
    })

    //btn add gallery
    $('.btn-add__gallery').click(function (e) {
        $('#files').trigger('click');
    })

    //up gallery
    $('#files').change(function () {
        if (this.files.length > 0) {
            let files = this.files;
            var gallery = $('input[name="gallery"]');
            Object.entries(files).forEach((file) => {
                var form_up = new FormData();
                form_up.append('file', file[1])
                $.ajax({
                    url: upload,
                    data: form_up,
                    type: "POST",
                    enctype: 'multipart/form-data',
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,   // tell jQuery not to set contentType
                    beforeSend: function () {
                        $('#gallery-display').append(loading_append());
                    },
                    success: function (response) {
                        swal.close();
                        console.log(response.error)
                        if (response.error == false) {
                            $('.append_loading').remove()
                            $('#gallery-display').append(append(file[1]['name'], response.url, file[1]['size']))
                            $(gallery).val(($(gallery).val()) + ',' + `${response.url}`);
                        } else {
                            swal.fire({
                                title: "Thất bại",
                                text: response.message,
                                icon: "error",
                                confirmButtonColor: "red",
                                confirmButtonText: "Xác nhận"
                            })
                        }
                    }
                })
            })
        }
    })

    //menu
    $('select[name="type"]').change(function () {
        let val = $(this).find('option:selected').val();
        if (val == 0) {
            $('select[name="table_id"]').attr('disabled', true);
            $('input[name="slug"]').removeAttr('readonly');
        } else {
            $('select[name="table_id"]').removeAttr('disabled');
            $('input[name="slug"]').attr('readonly', true);
        }
        switch (Number(val)) {
            case 1:
                ajax_get(api_product);
                break;

            case 2:
                ajax_get(api_post);
                break;
            case 0:
                break;
        }
    })

    //check all
    $('#check_all').click(function (){
        let check_input = $('input[name="check_all[]"]');
        if (check_input.prop('checked')) {
            check_input.prop('checked', false);
            return;
        }
        check_input.prop('checked', true);
    })

    //filter year
    $('select[name="year"]').on('change',function (){
        let year = $(this).find('option:selected').val();
        $.ajax({
            url: apiGetFolder,
            data: {
                year: year
            },
            type: "post",
            beforeSend:function (){
                Swal.fire({
                    html: sweet_loader + "<h4>Please wait a second ...</h4>",
                    showConfirmButton: false
                })
            },
            success: function (response)
            {
                Swal.close();
                let sl_month = $('select[name="month"]');
                let sl_day = $('select[name="day"]');
                sl_month.empty();
                sl_day.empty();
                if ((response.data).length > 0)
                {
                    let html = '<option value="0" selected="">-----</option>';
                    response.data.forEach(element => {
                        html += `<option value="${element}" >${element}</option>`;
                    })
                    sl_month.append(html)
                }
            }
        })
    })

    //filter month
    $('select[name="month"]').on('change',function (){
        let year = $('select[name="year"]').find('option:selected').val();
        let month = $(this).find('option:selected').val();
        $.ajax({
            url: apiGetFolder,
            data: {
                year: year,
                month: month
            },
            type: "post",
            beforeSend:function (){
                Swal.fire({
                    html: sweet_loader + "<h4>Please wait a second ...</h4>",
                    showConfirmButton: false
                })
            },
            success: function (response)
            {
                Swal.close();
                let sl_day = $('select[name="day"]');
                sl_day.empty();
                if ((response.data).length > 0)
                {

                    let html = '<option value="0" selected="">-----</option>';
                    response.data.forEach(element => {
                        html += `<option value="${element}" >${element}</option>`;
                    })
                    sl_day.append(html)
                }
            }
        })
    })

    //filer media
    $('.btn-filter__img').click(function (){
        let year = $('select[name="year"]').find('option:selected').val();
        let month = $('select[name="month"]').find('option:selected').val();
        let day = $('select[name="day"]').find('option:selected').val();
        $.ajax({
            url: apiGetMedia,
            data: {
                year: year,
                month: month,
                day: day
            },
            type: "post",
            beforeSend: function ()
            {
                Swal.fire({
                    html: sweet_loader + "<h4>Please wait a second ...</h4>",
                    showConfirmButton: false
                })
            },
            success: function (response)
            {
                Swal.close();
                let base_iframe = $('.filer-show__media');
                base_iframe.empty();
                if ((response.data).length)
                {
                    let html = '';
                    response.data.forEach((element)=>{
                        html += `<div class="col-sm-2 mb-2">
                                    <input type="checkbox" value="${element}" name="media_all[]" class="media-check">
                                    <div class="thumbnail">
                                        <a href="javascript:void(0)" class="btn-choice__thumb-func" data-url="${element}">
                                            <img src="${base + '/' + element}" class="img-fluid mb-2">
                                        </a>
                                    </div>
                                </div>`;
                    })
                    base_iframe.append(html)
                }
            }
        })
    })

    //chọn nhieu btn
    $('.btn-add__btn').click(function (){
        let media =  $('.media-check');
        if (media.hasClass('in'))
        {
            $('.media-check').removeClass('in');
            $('input[name="meida_all[]"]').prop("checked",false);
        } else  {
            $('.media-check').addClass('in');
        }
    })

    $('.fiter-control').change(function () {
        ($(this).find('option:selected').val() != 0) ? $('.btn-action__change.disabled').removeClass('disabled') : $('.btn-action__change').addClass('disabled');
    })

    //Xử lý menu
    $('.filter-change__menus').change(function () {
        let use_val = $(this).find('option:selected').val();
        use_val != 0 ? $('.btn-action__change.disabled').removeClass('disabled') : $('.btn-action__change').addClass('disabled');
        if (use_val == 1)
        {
            $('input[name="check_all[]"]:checked').parent().parent().find('.change__selected').removeAttr('readonly')
        } else  {
            $('.change__selected').attr('readonly',true)
        }
    })
    //action menu
    $('.btn-action__change').click(function (){
        let type = $('.filter-change__menus').find('option:selected').val()
        if (type == 0) return;
        var all_check = $('input[name="check_all[]"]:checked');
        var all_change = [];
        for (var i = 0 ; i < all_check.length; i ++)
        {
            if (type == 1)
            {
                let position = $(all_check[i]).parent().parent().find('.change__selected').val()
                let id = $(all_check[i]).val();
                all_change.push({ [id] : position})
            } else  {
                all_change.push($(all_check[i]).val())
            }
        }
        $.ajax({
            url:apiUpdateMenus,
            data: {
                id: all_change,
                type: type
            },
            type: "post",
            beforeSend: function ()
            {
                Swal.fire({
                    html: sweet_loader + "<h4>Please wait a second ...</h4>",
                    showConfirmButton: false
                })
            },
            success: function (response) {
                Swal.close()
                Swal.fire({
                    title: "Thành công",
                    text: "Thay đổi thông tin thành công!",
                    icon: "success",
                    showConfirmButton: true,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Xác nhận"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload()
                    }
                });
            }
        })
    })
    //Remove hinh anh
    $('.btn-action__view').click(function (){
        remove_media()
    })
    //Load more hinh anh
    $('.btn-loadMore').click(function (){
        let default_number = 20;
        let number_img = $('.filer-show__media > div').length;
        let page = Math.ceil(number_img/default_number) + 1;
        $.ajax({
            url: apiSearch,
            data: {
                pages: page
            },
            type: "post",
            beforeSend: function ()
            {
                Swal.fire({
                    html: sweet_loader + "<h4>Please wait a second ...</h4>",
                    showConfirmButton: false
                })
            },
            success: function(response)
            {
                Swal.close();
                let base_iframe = $('.filer-show__media');
                if ((response.data).length)
                {
                    let html = '';
                    response.data.forEach((element)=>{
                        html += `<div class="col-sm-2 mb-2">
                                    <input type="checkbox" value="${element}" name="media_all[]" class="media-check">
                                    <div class="thumbnail">
                                        <a href="javascript:void(0)" class="btn-choice__thumb-func" data-url="${element}">
                                            <img src="${base + '/' + element}" class="img-fluid mb-2">
                                        </a>
                                    </div>
                                </div>`;
                    })
                    base_iframe.append(html)
                }
            }
        })
    })

    //xử lý product
    $('.filter-change__product').change(function (){
        ($(this).find('option:selected').val() != 0) ? $('.btn-action__product.disabled').removeClass('disabled') : $('.btn-action__product').addClass('disabled');
    });
    //Action product
    $('.btn-action__product').click(function (){
        let select = $('.filter-change__product');
        let data_table = select.attr('data-table');
        let type = select.find('option:selected').val()
        if (type == 0) return;
        var all_check = $('input[name="check_all[]"]:checked');
        var all_change = [];
        for (var i = 0 ; i < all_check.length; i ++)
        {
            all_change.push($(all_check[i]).val())
        }
        $.ajax({
            url:apiUpdateProduct,
            data: {
                id: all_change,
                type: type,
                table: data_table
            },
            type: "post",
            beforeSend: function ()
            {
                Swal.fire({
                    html: sweet_loader + "<h4>Please wait a second ...</h4>",
                    showConfirmButton: false
                })
            },
            success: function (response) {
                Swal.close()
                if (response.success)
                {
                    Swal.fire({
                        title: "Thành công",
                        text: "Thay đổi thông tin thành công!",
                        icon: "success",
                        showConfirmButton: true,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Xác nhận"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload()
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: response.message,
                    });
                }
            }
        })
    })
})
function load_image()
{
    $.ajax({
        url: apiSearch,
        data: {
            pages: 1
        },
        type: "post",
        beforeSend: function ()
        {
            Swal.fire({
                html: sweet_loader + "<h4>Please wait a second ...</h4>",
                showConfirmButton: false
            })
        },
        success: function(response)
        {
            Swal.close();
            let base_iframe = $('.filer-show__media');
            base_iframe.empty()
            if ((response.data).length)
            {
                let html = '';
                response.data.forEach((element)=>{
                    html += `<div class="col-sm-2 mb-2">
                                    <div class="thumbnail">
                                        <a href="javascript:void(0)" class="btn-choice__thumb-func" data-url="${base + '/' + element}">
                                            <img src="${base + '/' + element}" class="img-fluid mb-2">
                                        </a>
                                    </div>
                                </div>`;
                })
                base_iframe.append(html)
            }
        }
    })
}
function remove_media()
{
    let all = jQuery('input[name="media_all[]"]:checked');
    var file = [];
    if (all.length)
    {
        for(var i = 0; i < all.length; i ++)
        {
            file.push($(all[i]).val());
        }
    }
    let file_one = $('.thumbnail.active');
    if (file_one.length)
    {
        file.push(file_one.find('.btn-choice__thumb-func').attr('data-url'));
    }
    if(file.length)
    {
        $.ajax({
            url: apiMedia,
            data: {
                files: file
            },
            type: "post",
            beforeSend: function ()
            {
                Swal.fire({
                    html: sweet_loader + "<h4>Please wait a second ...</h4>",
                    showConfirmButton: false
                })
            },
            success: function (response)
            {
                Swal.close()
                Swal.fire({
                    title: "Thành công",
                    text: "Xoá hình ảnh hành công!",
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Xác nhận"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload()
                    }
                });
            }
        })
    }
}

function create_slug(title, name) {
    $.ajax({
        url: apiSlug,
        data: {
            title: title
        },
        type: 'post',
        success: function (response) {
            $(`input.form-control[name="${name}"]`).val(response.trim())
        }
    })
}

function loading_append() {
    return `<li class="append_loading"><div class="percent">
          <div class="progress"></div>
        </div></li>`;
}

function append(name, url, size) {
    return `<li data-url="${url}">
                <span class="mailbox-attachment-icon">
                    <i class="fas fa-photo-video nav-icon"></i>
                </span>

                <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name">
                        <i class="fas fa-paperclip"></i>${name}</a>
                    <span class="mailbox-attachment-size clearfix mt-1">
                            <span>${formatBytes(size, 3)}</span>
                            <a onclick="remove(this)" class="btn btn-default btn-sm float-right">
                                <i class="fa-solid fas fa-trash"></i>
                            </a>
                        </span>
                </div>
            </li>`;
}

function formatBytes(bytes, decimals = 2) {
    if (!+bytes) return '0 Bytes'

    const k = 1024
    const dm = decimals < 0 ? 0 : decimals
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']

    const i = Math.floor(Math.log(bytes) / Math.log(k))

    return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
}

function remove(element) {
    let parent = $(element).parent().parent().parent();
    let url = parent.attr('data-url');
    parent.remove()
    let value = $('input[name="gallery"]').val();
    $('input[name="gallery"]').val(value.replace(`${url},`, ''));
}

function ajax_get(url) {
    var response;
    $.get(url).done(function (data) {
        if (data.success == true) {
            append_menus('table_id', data.categories);
        }
    });
}
function append_menus(id = '',obj)
{
    var html = '';
    obj.forEach(element => {
        html += `<option value="${element.id}">${element.title}</option>`;
    })
    $(`select[name="${id}"]`).empty().append(html)
}