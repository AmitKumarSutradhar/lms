{{--Start Wishlist Add Option--}}
<script type="text/javascript">
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })

    function addToWishList(course_id) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/add-to-wishlist/"+course_id,

            success: function (data) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                });
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        icon: "success",
                        title: data.success
                    });
                } else {
                    Toast.fire({
                        icon: "error",
                        title: data.error
                    });
                }
            }
        })
    }
</script>
{{--End Wishlist Add Option--}}


{{--Start Load Wishlist Add Option--}}
<script type="text/javascript">
    function wishlist() {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/get-wishlist-course",

            success:function(response){

                $('#wishQty').text(response.wishQty)

                var rows = ""
                $.each(response.wishlist, function(key, value) {
                    rows += `
                         <div class="col-lg-4 responsive-column-half">
                            <div class="card card-item">
                                <div class="card-image">
                                    <a href="/course/details/${value.course.id}/${value.course.course_name_slug}" class="d-block">
                                        <img class="card-img-top" src="/${value.course.course_image}" alt="Card image cap">
                                    </a>
                                    <div class="course-badge-labels">
                                        <div class="course-badge">Bestseller</div>
                                        <div class="course-badge blue">-39%</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">${value.course.label}</h6>
                                    <h5 class="card-title"><a href="/course/details/${value.course.id}/${value.course.course_name_slug}">${value.course.course_name}</a></h5>
                                    <p class="card-text"><a href="teacher-detail.html">Jose Portilla</a></p>
                                    <div class="rating-wrap d-flex align-items-center py-2">
                                        <div class="review-stars">
                                        <span class="rating-number">4.4</span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star-o"></span>
                                    </div>
                                    <span class="rating-total pl-1">(20,230)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    ${value.course.discount_price == null ?
                                        ` <p class="card-price text-black font-weight-bold">$${value.course.selling_price}</span></p>`
                                        : `<p class="card-price text-black font-weight-bold">$${value.course.discount_price} <span class="before-price font-weight-medium">$${value.course.selling_price}</span></p>`}

                                    <div class="icon-element icon-element-sm shadow-sm cursor-pointer" data-toggle="tooltip" data-placement="top" title="Remove from Wishlist" id="${ value.id }" onclick="wishlistRemove(this.id)"><i class="la la-heart"></i></div>
                                </div>
                            </div>
                           </div>
                        </div>
                    `
                });
                $('#wishlist').html(rows);
            }

        })
    }
    wishlist();

    // Wishlist Remove
    function wishlistRemove(id) {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/wishlist-remove/"+id,

            success: function (data) {
                wishlist();
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                });
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        icon: "success",
                        title: data.success
                    });
                } else {
                    Toast.fire({
                        icon: "error",
                        title: data.error
                    });
                }
            }
        })
    }
    // End Wishlist Remove
</script>
{{--End Load Wishlist Add Option--}}


{{--Start Add to Cart Option--}}
<script type="text/javascript">
    function addToCart(courseId, courseName, instructorId, slug) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            data: {
                _token: '{{ csrf_token() }}',
                course_name: courseName,
                course_name_slug: slug,
                instructor: instructorId
            },

            url: "/cart/data/store/"+courseId,
            success: function (data) {
                miniCart();
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                });
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        icon: "success",
                        title: data.success
                    });
                } else {
                    Toast.fire({
                        icon: "error",
                        title: data.error
                    });
                }
            }
        })
    }
</script>
{{--End Add to Cart Option--}}


{{--Mini Add to Cart Option--}}
<script type="text/javascript">
    function miniCart() {
        $.ajax({
            type: 'GET',
            url: '/course/mini/cart',
            dataType: 'json',
            success: function (response) {
                $('span[id="cartSubTotal"]').text(response.cartTotal);
                $('#cartQty').text(response.cartQty);

                var miniCart = ""
                $.each(response.carts, function (key, value) {
                    miniCart += `
                        <li class="media media-card">
                            <a href="shopping-cart.html" class="media-img">
                                <img src="/${value.options.image}" alt="Cart image">
                            </a>
                            <div class="media-body">
                                <h5><a href="/course/details/${value.id}/${value.options.slug}">${ value.name }</a></h5>
                                <p class="text-black font-weight-semi-bold lh-18">$${ value.price } <span class="before-price fs-14"></span></p>
                                <a type="submit" id="${ value.rowId }" onclick="miniCartRemove(this.id)"><i class="la la-times"></i></a>
                            </div>
                        </li>
                    `
                });
                $('#miniCart').html(miniCart);

            }
        })
    }
    miniCart();

    // Mini Cart Remove
    function miniCartRemove(rowId) {
        $.ajax({
            type: 'GET',
            url: '/minicart/course/remove/'+rowId,
            dataType: 'json',
            success: function (data) {
                miniCart();
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                });
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        icon: "success",
                        title: data.success
                    });
                } else {
                    Toast.fire({
                        icon: "error",
                        title: data.error
                    });
                }
            }
        })
    }
    // End Mini Cart Remove
</script>
{{--End Mini Add to Cart Option--}}
