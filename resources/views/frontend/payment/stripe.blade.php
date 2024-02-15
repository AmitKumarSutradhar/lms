@extends('frontend.master')
@section('body')

    <style>

        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }
        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }
        .StripeElement--invalid {
            border-color: #fa755a;
        }
        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;}
    </style>

    <!-- ================================
    START BREADCRUMB AREA
================================= -->
    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <div class="section-heading">
                    <h2 class="section__title text-white">Checkout</h2>
                </div>
                <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                    <li><a href="index.html">Home</a></li>
                    <li>Pages</li>
                    <li>Checkout</li>
                </ul>
            </div><!-- end breadcrumb-content -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!-- ================================
           START CONTACT AREA
    ================================= -->
    <section class="cart-area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-22 pb-3">Billing Details</h3>
                            <div class="divider"><span></span></div>
                            <div class="input-box col-lg-6">
                                <label class="label-text">First Name</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="name" value="{{ Auth::user()->name }}" placeholder="e.g. Alex">
                                    <span class="la la-user input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box col-lg-6">
                                <label class="label-text">Email</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="email" name="email" value="{{ Auth::user()->email }}" placeholder="e.g. example@gmail.com">
                                    <span class="la la-user input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box col-lg-12">
                                <label class="label-text">Address</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="address" value="{{ Auth::user()->address }}" placeholder="e.g. alexsmith@gmail.com">
                                    <span class="la la-envelope input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box col-lg-12">
                                <label class="label-text">Phone Number</label>
                                <div class="form-group">
                                    <input id="phone" class="form-control form--control" type="tel" name="phone" value="{{ Auth::user()->phone }}">
                                </div>
                            </div><!-- end input-box -->
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-22 pb-3">Credit or Debit Card</h3>
                            <div class="divider"><span></span></div>
                            <div class="border cart-totals p-40">
                                <div class="divider-2 mb-30">
                                    <div class="table-responsive order_table checkout p-3">
                                        <form action="{{ route('stripe_order') }}"  method="POST" id="payment-form">
                                            @csrf
                                            <div class="form-row p-40">
                                                <input type="hidden" name="name" value="{{ $data['name'] }}">
                                                <input type="hidden" name="email" value="{{ $data['email'] }}">
                                                <input type="hidden" name="phone" value="{{ $data['phone'] }}">
                                                <input type="hidden" name="address" value="{{ $data['address'] }}">
                                                <label for="card-element"></label>
                                                <div id="card-element" style="width: 100%; padding: 50px"></div>
                                                <div id="card-errors" role="alert"></div>
                                            </div>
                                            <input type="submit" class="btn btn-primary mt-3 w-100" value="Pay Now">
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col-lg-7 -->
                <div class="col-lg-5">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-22 pb-3">Order Details</h3>
                            <div class="divider"><span></span></div>
                            <div class="order-details-lists">
                                @foreach($carts as $item)
                                    <input type="hidden" name="slug[]" value="{{ $item->options->slug }}">
                                    <input type="hidden" name="course_id[]" value="{{ $item->id }}">
                                    <input type="hidden" name="course_title[]" value="{{ $item->name }}">
                                    <input type="hidden" name="price[]" value="{{ $item->price }}">
                                    <input type="hidden" name="instructor_id[]" value="{{ $item->options->instructor }}">

                                    <div class="media media-card border-bottom border-bottom-gray pb-3 mb-3">
                                        <a href="{{ url('course/details/'.$item->id.'/'.$item->options->slug) }}" class="media-img">
                                            <img src="{{ asset($item->options->image) }}" alt="Cart image">
                                        </a>
                                        <div class="media-body">
                                            <h5 class="fs-15 pb-2"><a href="{{ url('course/details/'.$item->id.'/'.$item->options->slug) }}">{{ $item->name }}</a></h5>
                                            <p class="text-black font-weight-semi-bold lh-18">${{ $item->price }}</span></p>
                                        </div>
                                    </div><!-- end media -->
                                @endforeach
                            </div><!-- end order-details-lists -->
                            <a href="{{ route('mycart') }}" class="btn-text"><i class="la la-edit mr-1"></i>Edit</a>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-22 pb-3">Order Summary</h3>
                            <div class="divider"><span></span></div>
                            @if(Session::has('coupon'))
                                <ul class="generic-list-item generic-list-item-flash fs-15">
                                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                        <span class="text-black">Subtotal:</span>
                                        <span>${{ $cartTotal }}</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                        <span class="text-black">Coupon Name:</span>
                                        <span>{{ Session::get('coupon')['coupon_name'] }} ({{ Session::get('coupon')['coupon_discount'] }}%)</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                        <span class="text-black">Coupon Discount:</span>
                                        <span>${{ Session::get('coupon')['discount_amount'] }}</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between font-weight-bold">
                                        <span class="text-black">Total:</span>
                                        <span>${{ Session::get('coupon')['total_amount'] }}</span>
                                    </li>
                                </ul>
                                <input type="hidden" name="total" value="{{ $cartTotal }}">
                            @else
                                <ul class="generic-list-item generic-list-item-flash fs-15">
                                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                        <span class="text-black">Total:</span>
                                        <span>${{ $cartTotal }}</span>
                                    </li>
                                </ul>
                                <input type="hidden" name="total" value="{{ $cartTotal }}">
                            @endif

                            <div class="btn-box border-top border-top-gray pt-3">
                                <p class="fs-14 lh-22 mb-2">Aduca is required by law to collect applicable transaction taxes for purchases made in certain tax jurisdictions.</p>
                                <p class="fs-14 lh-22 mb-3">By completing your purchase you agree to these <a href="#" class="text-color hover-underline">Terms of Service.</a></p>
{{--                                <button type="submit" class="btn theme-btn w-100">Proceed <i class="la la-arrow-right icon ml-1"></i></button>--}}
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col-lg-5 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <!-- ================================
           END CONTACT AREA
    ================================= -->

    <script type="text/javascript">
        // Create a Stripe client.
        var stripe = Stripe('pk_test_51OSwefJ26NhBL2PCvxJkGY8kMlRK79VJW5JIaBMQqpwtW1pvCHHjrOHJDZW5LAAXldWPqdc9fWQOHbhRFQkap6BS00ao5MC7z2');
        // Create an instance of Elements.
        var elements = stripe.elements();
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});
        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an errors.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });
        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            // Submit the form
            form.submit();
        }
    </script>

@endsection
