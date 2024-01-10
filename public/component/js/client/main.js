var sweet_loader = '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';
const daysTag = document.querySelector(".days"),
    currentDate = document.querySelector(".current-date"),
    prevNextIcon = document.querySelectorAll(".icons span");

// getting new date, current year and month
let date = new Date(),
    currYear = date.getFullYear(),
    currMonth = date.getMonth();

// storing full name of all months in array
const months = ["January", "February", "March", "April", "May", "June", "July",
    "August", "September", "October", "November", "December"];

const renderCalendar = () => {
    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
        lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
        lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
        lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
    let liTag = "";

    for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
        liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
    }

    for (let i = 1; i <= lastDateofMonth; i++) { // creating li of all days of current month
        // adding active class to li if the current day, month, and year matched
        let isToday = i === date.getDate() && currMonth === new Date().getMonth()
        && currYear === new Date().getFullYear() ? "active" : "";
        liTag += `<li class="${isToday}">${i}</li>`;
    }

    for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
        liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
    daysTag.innerHTML = liTag;
}
renderCalendar();
const validateEmail = (email) => {
    return email.match(
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
};
prevNextIcon.forEach(icon => { // getting prev and next icons
    icon.addEventListener("click", () => { // adding click event on both icons
        // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
        currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

        if(currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
            // creating a new date of current year & month and pass it as date value
            date = new Date(currYear, currMonth, new Date().getDate());
            currYear = date.getFullYear(); // updating current year with new date year
            currMonth = date.getMonth(); // updating current month with new date month
        } else {
            date = new Date(); // pass the current date as date value
        }
        renderCalendar(); // calling renderCalendar function
    });
});
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.btn-send__form').click(function (){
        let name = $('input[name="author"]').val();
        let email = $('input[name="email"]').val();
        let phone = $('input[name="whatsapp"]').val();
        let message = $('textarea[name="message"]').val();
        let product_id = $('input[name="product-id"]').val();
        if (! name)
        {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please input your name!",
            });
            return;
        }
        if (! email)
        {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please input your email!",
            });
            return;
        }
        if (!validateEmail(email))
        {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Email invalidate!",
            });
            return;
        }
        if (! phone)
        {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please input your phone/whatapp!",
            });
            return;
        }
        $.ajax({
            url: api_submit,
            data: {
                name: name,
                email: email,
                phone:phone,
                message: message,
                product_id: product_id
            },
            type: "post",
            beforeSend: function (){
                Swal.fire({
                    html: sweet_loader + "<h4>Please wait a second ...</h4>",
                    showConfirmButton: false
                })
            },
            success: function (response)
            {
                Swal.close();
                if (response.success === true)
                {
                    Swal.fire({
                        title: "Good job!",
                        text: response.message,
                        icon: "success"
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
    $('.btn-comment__form').click(function (){
        let name = $('input[name="your-author"]').val();
        let email = $('input[name="your-email"]').val();
        let comment = $('textarea[name="your-comment"]').val();
        let product_id = $('input[name="comment_post_ID"]').val();
        let rating = $('input[name="star"]').val();
        let slug = $('input[name="slug"]').val();
        if (! name)
        {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please input your name!",
            });
            return;
        }
        if (! email)
        {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please input your email!",
            });
            return;
        }
        if (!validateEmail(email))
        {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Email invalidate!",
            });
            return;
        }
        if (! comment)
        {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please input your message!",
            });
            return;
        }
        $.ajax({
            url: api_comment,
            data: {
                name: name,
                email: email,
                rating:rating,
                message: comment,
                product_id: product_id,
                slug: slug
            },
            type: "post",
            beforeSend: function (){
                Swal.fire({
                    html: sweet_loader + "<h4>Please wait a second ...</h4>",
                    showConfirmButton: false
                })
            },
            success: function (response)
            {
                Swal.close();
                if (response.success === true)
                {
                    Swal.fire({
                        title: "Good job!",
                        text: response.message,
                        icon: "success"
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
    let btnstar = $('.rating-choice');
    for (var i = 0; i < btnstar.length; i++)
    {
        let pos = i
        btnstar[i].addEventListener('click',function (){
            let parent = $(this).parent();
            parent.hasClass('selected') ? "" : parent.addClass('selected');
            parent.find('.rating-choice').removeClass('checked');
            $(this).addClass('checked');
            $('input[name="star"]').empty().val(pos + 1);
        })
    }
    $('.box-bg__tran,.btn-close__nav').click(function (){
        $('.offcanvas-collapse,.menuCanvas-collapse').removeClass('open')
    })
    $('[data-toggle="menuCanvas"]').on('click', function (e) {
        $('.menuCanvas-collapse').toggleClass('open')
    })
    $('[data-toggle="offcanvas"]').on('click', function (e) {
        $('.offcanvas-collapse').toggleClass('open')
    })
    $('.down__check').on('click', function (e) {
        $('#menu-mobile .sub-menus.open').removeClass('open')
        $(this).parent().parent().find('.sub-menus').toggleClass('open')
        $(this).addClass('d-none');
        $(this).parent().find('.up__check').removeClass('d-none');
    })
    $('.up__check').on('click', function (e) {
        $('#menu-mobile .sub-menus.open').removeClass('open')
        $(this).addClass('d-none');
        $(this).parent().find('.down__check').removeClass('d-none');
    })

    let min = 1;
    let max = 150;

    const calcLeftPosition = value => 100 / (150 - 1) *  (value - 1);

    $('#rangeMin').on('input', function(e) {
        const newValue = parseInt(e.target.value);
        if (newValue > max) return;
        min = newValue;
        $('#thumbMin').css('left', calcLeftPosition(newValue) + '%');
        $('#min').html(newValue);
        $('#line').css({
            'left': calcLeftPosition(newValue) + '%',
            'right': (100 - calcLeftPosition(max)) + '%'
        });
    });

    $('#rangeMax').on('input', function(e) {
        const newValue = parseInt(e.target.value);
        if (newValue < min) return;
        max = newValue;
        $('#thumbMax').css('left', calcLeftPosition(newValue) + '%');
        $('#max').html(newValue);
        $('#line').css({
            'left': calcLeftPosition(min) + '%',
            'right': (100 - calcLeftPosition(newValue)) + '%'
        });
    });
    $('#rangeMax,#rangeMin').on('change',function (){
        getProduct();
    })
    $('.choose__radio').click(function (){
        $(this).parent().find('input').prop('checked',true);
        getProduct();
    })
    $('select[name="order_by"],select[name="product_tag"]').on('change',function (){
        getProduct();
    })
    $('.clear-btn').click(function (){
        $('input[name="category"]').prop('checked',false);
        $('select[name="order_by"]').find('option[value="0"]').attr('selected','selected');
        $('select[name="product_tag"]').find('option[value="0"]').attr('selected','selected');
        $('input#rangeMin').val(1);
        $('input#rangeMax').val(150);
        $('#min').text(1);
        $('#max').text(150);
        $('#line').css('left',"0%").css('right','0%');
        $('#thumbMin').css('left',"0%");
        $('#thumbMax').css('left',"100%");
        getProduct();
    })
})
function getProduct()
{
    let price_min = $('input#rangeMin').val();
    let price_max = $('input#rangeMax').val();
    let sort_by = $('select[name="order_by"] option:selected').val();
    let category = $('input[name="category"]:checked').val();
    let tags = $('select[name="product_tag"] option:selected').val();
    $.ajax({
        url: api_getProduct,
        data: {
            price_min:price_min,
            price_max:price_max,
            sort_by:sort_by,
            category:category,
            tags:tags
        },
        type:"post",
        beforeSend:function ()
        {
            $('.offcanvas-collapse').removeClass('open')
            Swal.fire({
                html: sweet_loader + "<h4>Please wait a second ...</h4>",
                showConfirmButton: false
            })
        },
        success: function (response)
        {
            var html = '';
            if (response.data)
            {
                response.data.forEach((element) => {
                    html += `<li class="product type-product has-post-thumbnail animate">
                        <div class="product_thumbnail_wrapper ">
                            <a href="${url( "product/" + element.slug)}"
                               class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                <div class="product_thumbnail with_second_image second_image_loaded"
                                     style="background-size: cover;">
                                                <span class="product_thumbnail_background"
                                                      style="background-image:url(${url( element.thumb)})"></span>
                                    <img loading="lazy"
                                         decoding="async" width="350" height="435"
                                         src="${url( element.thumb)}"
                                         class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                         alt="">
                                </div>
                            </a>
                            <div class="product_thumbnail_icons">
                                <a href="#" id="product_id_5209"
                                   class="product_quickview_button"
                                   data-product_id="${element.id}"></a>
                                <div class="icons-separator"></div>
                            </div>
                        </div>
                        <h2 class="woocommerce-loop-product__title">
                            <a href="${url( "product/" + element.slug)}">${element.title}</a>
                        </h2>
                        <div class="product_after_shop_loop">
                            <div class="product_after_shop_loop_switcher">
                                <span class="price">
                               `;
                    if (element.price)
                    {
                        html += `<span className="price-amount amount">
                                                    <bdi>${element.price}
                                                        <span className="woocommerce-Price-currencySymbol">
                                                            ${element.value}
                                                        </span>
                                                    </bdi>
                                                </span>`;
                    }
                    if (element.price_to)
                    {
                        html += ` - <span class="price-amount amount">
                                                    <bdi>${element.price_to}
                                                        <span class="woocommerce-Price-currencySymbol">
                                                           ${element.value}
                                                        </span>
                                                    </bdi>
                                                </span>`;
                    }
                           html +=`</span>
                                <a class="button" href="${url( "product/" + element.slug)}" rel="nofollow">
                                    Select options</a>
                            </div>
                        </div>
                    </li>`;
                })
            }

            setTimeout(function (){
                swal.close();
                $('.list-replace').empty().append(html);
            },2000)

        }
    })
}
