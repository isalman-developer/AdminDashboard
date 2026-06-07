<!--footer section start here-->
<footer>
    <div class="mg-footer-section">
        <div class="container">
            <div class='mg-footer-section-inner'>
                <div class="row">
                    <div class="col-md-5">
                        <div class="mg-footer-bio">
                            <a class="mg-footer-logo" href="{{ route('home') }}">
                                {{ config('siteSetting')[0]['name'] ?? 'E-commerce'}}
                            </a>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                        </div>
                        <div class="mg-newsletter-outer">
                            <h6>Subscribe Our Newsletter</h6>
                            <span>Lorem Ipsum is simply dummy text</span>
                            <div class="mg-newsletter-inner">
                                <form class="d-flex mt-3">
                                    <input class="form-control" type="search" placeholder="Email address" aria-label="search">
                                    <button class="btn"><i class="fa-solid fa-angle-right"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mg-footer-link">
                                    <div class="mg-footer-link-heading">
                                        <span>Safe Payment</span>
                                    </div>
                                    <ul class="list-group">
                                        <li><a href="javascript:void(0);">In-Store Shop</a></li>
                                        <li><a href="javascript:void(0);">Brands</a></li>
                                        <li><a href="javascript:void(0);">Gift Cards</a></li>
                                        <li><a href="javascript:void(0);">Careers</a></li>
                                        <li><a href="about-us.html">About Us</a></li>
                                        <li><a href="javascript:void(0);">Shipping</a></li>
                                        <li><a href="javascript:void(0);">Return</a></li>
                                        <li><a href="my-account.html">My Account</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mg-footer-link">
                                    <div class="mg-footer-link-heading">
                                        <span>Information</span>
                                    </div>
                                    <ul class="list-group">
                                        <li><a href="javascript:void(0);">Live Chat</a></li>
                                        <li><a href="javascript:void(0);">Product Guide</a></li>
                                        <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                        <li><a href="javascript:void(0);">Delivery Information</a></li>
                                        <li><a href="javascript:void(0);">Sales</a></li>
                                        <li><a href="javascript:void(0);">Term and Conditions</a></li>
                                        <li><a href="javascript:void(0);">Shopping policy</a></li>
                                        <li><a href="javascript:void(0);">EMI Payment</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mg-footer-link">
                                    <div class="mg-footer-link-heading">
                                        <span>Store</span>
                                    </div>
                                    <ul class="list-group">
                                        <li><a href="javascript:void(0);">Affiliate</a></li>
                                        <li><a href="javascript:void(0);">Bestseller</a></li>
                                        <li><a href="javascript:void(0);">Discount</a></li>
                                        <li><a href="javascript:void(0);">Latest Products</a></li>
                                        <li><a href="javascript:void(0);">Sales</a></li>
                                        <li><a href="shop.html">All Collection</a></li>
                                        <li><a href="wishlist.html">Wishlist</a></li>
                                        <li><a href="contact-us.html">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Copy right section start here-->
            <div class="mg-copy-right-section">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="mg-copy-right-text">
                            <span>MADE WITH <i class="fa-solid fa-heart"></i> BY <a href="javascript:void(0)';">MG Technologies.</a></span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class='mg-payment-option-img'>
                            <img src="{{ asset('client/images/gallery/download.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <!--Copy right section end here-->
        </div>
    </div>
</footer>
<!--footer section end here-->
<!--Back To Top Button Start Here-->
<div id="back-top" style="display: none;">
    <a class="text-decoration-none" title="Go to Top" href="#"><i class="fa-solid fa-angles-up"></i></a>
</div>
