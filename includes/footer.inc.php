<footer class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col s12 m4">
                <div class="card footer_card z-depth-0">
                    <div class="card-content white-text">
                        <span class="card-title">about</span>
                        <!-- <p style="margin-bottom: 5px;">Established in 2014, ClassiCloset is a lifestyle destination focused on providing everyday women, men, and kids clothing across India and abroad. With an exquisite range of modern and ethnic wear for women, men, and kids, ClassiCloset's goal is to provide the best quality products at the most valuable prices to our customers.
                        </p>
                        <p>Our website classicloset.com is your one-stop-shop for daily casual wear that has been creatively-designed and strenuously-woven for today's stylish, global citizen.</p>
                        <p>Our collection reflects the sentiment of Make in India and a sense of individuality.</p> -->


                        <ul class="quick-links">
                            <li>24x7 Customer Support</li>
                            <li>Easy Returns</li>
                            <li>Convenient Shopping</li>
                            <li>One Stop Shop</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card footer_card z-depth-0">
                    <div class="card-content white-text">
                        <span class="card-title">Contact details</span>
                        <!-- <ul class="quick-links">
                            <li>K 1024, Jagpal Kheda, <br>
                                Gomti Nagar Vistar,<br>
                                Lucknow, Uttar Pradesh 226028
                            </li>
                            <li>Ph: +91-809-091-2433</li>
                            <li>support@classicloset.com</li>
                        </ul> -->
                        <ul class="quick-links">
                            <li>C-25, Aliganj, <br>
                                Lucknow - 226024, <br>
                                Uttar Pradesh, India.
                            </li>
                            <li>Contact Number:<br> +91-522-431-6496, <br>
                                +91-800-400-8123 </li>
                            <li>info@onebigbit.com</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card footer_card z-depth-0">
                    <div class="card-content white-text">
                        <span class="card-title">Quick Links</span>
                        <ul class="quick-links">
                            <li><a class="white-text" href="index.php">HOME</a></li>
                            <li><a class="white-text" href="super_categories.php">CATEGORIES</a></li>
                            <li><a class="white-text" href="contact.php">CONTACT</a></li>
                            <!-- <li><a class="white-text" href="privacypolicy.php">PRIVACY POLICY</a></li>
                            <li><a class="white-text" href="terms_conditions.php">TERMS & CONDITIONS</a></li>
                            <li><a class="white-text" href="refundpolicy.php">REFUND POLICY</a></li> -->
                            <!-- <li><a class="white-text" href="login.php">LOGIN</a></li> -->
                            <li><a class="white-text" href="admin/login.php">ADMIN LOGIN</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <div class="row valign-wrapper" style="margin-bottom: 0px;">
            <div class="col s12 m4 center">
                <a id="logo-container" class="brand-logo-footer white-text" href="index.php">
                    <!-- <img class="" height="95" src="media/logo/logo-low-min.png" alt=""> -->
                    <img class="" src="media/logo.png" alt="">
                </a>
            </div>
            <div class="col s12 m8">
                <div class="card footer_card z-depth-0">
                    <div class="card-content center socials">
                        <a href=""> <i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                        <a href=""><i class="fa fa-youtube-square" aria-hidden="true"></i></a>
                        <a href=""><i class="fa fa-pinterest-square" aria-hidden="true"></i></a>
                        <a href=""><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                        <a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="footer-copyright">
        <div class="container">
            Made by <a class="brown-text text-lighten-3" href="https://onebigbit.com/">One Big Bit</a>
        </div>
    </div> -->
</footer>

<!--  Scripts-->

<style>
    #loading {
        text-align: center;
        background: url('loader.gif') no-repeat center;
        height: 150px;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/zoomsl.js"></script>
<script>
    $(document).ready(function() {

        filter_data();
        filter_data_subcategory();

        function filter_data() {
            $('.filter_data').html('<div id="loading" style="" ></div>');
            var action = 'fetch_data';
            var minimum_price = $('#hidden_minimum_price').val();
            var maximum_price = $('#hidden_maximum_price').val();
            var brand = get_filter('brand');
            var fabric = get_filter('fabric');
            var size = get_filter('size');
            var color = get_filter('color');
            var super_cat_id = "<?php echo $_GET['id'] ?>";
            $.ajax({
                url: "fetch_data.php",
                method: "POST",
                data: {
                    action: action,
                    minimum_price: minimum_price,
                    maximum_price: maximum_price,
                    brand: brand,
                    fabric: fabric,
                    size: size,
                    color: color,
                    super_cat_id: super_cat_id
                },
                success: function(data) {
                    $('.filter_data').html(data);
                }
            });
        }

        function filter_data_subcategory() {
            $('.filter_data_subcategory').html('<div id="loading" style="" ></div>');
            var action = 'fetch_data';
            var minimum_price = $('#hidden_minimum_price').val();
            var maximum_price = $('#hidden_maximum_price').val();
            var brand = get_filter('brand');
            var fabric = get_filter('fabric');
            var size = get_filter('size');
            var color = get_filter('color');
            var super_cat_id = "<?php echo $_GET['id'] ?>";
            $.ajax({
                url: "fetch_data_subcategory.php",
                method: "POST",
                data: {
                    action: action,
                    minimum_price: minimum_price,
                    maximum_price: maximum_price,
                    brand: brand,
                    fabric: fabric,
                    size: size,
                    color: color,
                    super_cat_id: super_cat_id
                },
                success: function(data) {
                    $('.filter_data_subcategory').html(data);
                }
            });
        }

        function get_filter(class_name) {
            var filter = [];
            $('.' + class_name + ':checked').each(function() {
                filter.push($(this).val());
            });
            return filter;
        }

        $('.common_selector').click(function() {
            filter_data();
            filter_data_subcategory();
        });

        $('#price_range').slider({
            range: true,
            min: 100,
            max: 20000,
            values: [100, 20000],
            step: 200,
            stop: function(event, ui) {
                $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                $('#hidden_minimum_price').val(ui.values[0]);
                $('#hidden_maximum_price').val(ui.values[1]);
                filter_data();
                filter_data_subcategory();
            }
        });

    });
</script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="js/init.js"></script>



</body>

</html>