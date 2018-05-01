<?php /* Template Name: HomeTemplate */ 



$brand_settings = wp_parse_args(
    get_option( 'brand_settings', array() ),
    brand_get_defaults()
);

get_header('slider');

do_action( 'brand_before_singular_content' ); ?>
<div id="primary" class="container content-area">
    <main id="main" class="row site-main" role="main">
        <h1> OUR MOVEMENTS!</h1>
        <div id="primary-content">
            <!--- -->
            <div class="wholeShit flex1">
                <div class="content ">
                    <div class="picture" style="background-image: url('http://projectempathy.rf.gd/wp-content/uploads/2018/04/Gold-Nib-Fountain-Pen-Wallpaper.jpg');">
                        <div class="buttonCard centered">
                            <a href='javascript:void(0)' onclick='window.location = "http://projectempathy.rf.gd/home/a-letter-for-you-alfu/"'>
                                <span class='default-link'></span>
                                <span class="centered">JOIN NOW!</span>
                            </a>
                        </div>
                    </div>
                    <div class="info">
                        <div class="title">
                            <h1>A letter for you</h1>
                        </div>
                        <hr>
                        <div class="descriptions">
                            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                                voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wholeShit flex1">
                <div class="content ">
                    <div class="picture" style="background-image: url('http://projectempathy.rf.gd/wp-content/uploads/2018/05/5446288b832687f719e901f2e242a768-amazon-box-danbo.jpg');">
                       
                    </div>
                    <div class="info">
                        <div class="title">
                            <h1>Our next movement!</h1>
                        </div>
                        <hr>
                        <div class="descriptions">
                            <p>We are going to launch our next movement 
                                once <span class="hashtag">project: #AluF</span> is running smoothly.
                                So, PLEASE WAIT <span class="hashtag">#EMPATHICALLY!</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- -->

        </div>
        <!-- #primary-content -->

        <div id="secondary-content">
            <?php brand_get_sidebar(); ?>
        </div>
        <!-- #secondary-content -->
    </main>
    <!-- #main -->
</div>
<!-- #primary -->

<?php
get_footer();?>