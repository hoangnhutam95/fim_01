<footer id="footer" class="dark">
    <div class="container">
        <div class="footer-widgets-wrap clearfix">
            <div class="col_two_third">
                <p>{{ trans('home.copyright') }}</p>
                <div>
                    <address class="col-sm-4">
                        <strong>{{ trans('home.address') }}</strong><br>
                        {{ trans('home.real-address') }}<br>
                    </address>
                    <address class="">
                        <abbr title="Phone Number"><strong>{{ trans('home.phone') }}</strong></abbr>
                        {{ trans('home.my-phone') }}
                        <br>
                        <abbr title="Email Address"><strong>{{ trans('home.email') }}</strong></abbr>
                        {{ trans('home.my-email') }}
                    </address>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="widget clearfix">
                    <div class="row">
                        <div class="col-md-6 clearfix bottommargin-sm likefb">
                            <a href="" class="social-icon si-dark si-colored si-facebook nobottommargin">
                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                            </a>
                            <a href="#">
                                <small>
                                    <strong>{{ trans('home.like-us') }}</strong><br>
                                    {{ trans('home.on-facebook') }}
                                </small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
