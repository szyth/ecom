<footer class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col s12 m4">
                <div class="card footer_card z-depth-0">
                    <div class="card-content white-text">
                        <span class="card-title">about</span>
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
                        <ul class="quick-links">
                            <li>C-25, Aliganj, Lucknow - 226024, Uttar Pradesh, India.</li>
                            <li>info@onebigbit.com</li>
                            <li> business@onebigbit.com</li>
                            <li>+91-522-431-6496</li>
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
                            <!-- <li><a class="white-text" href="login.php">LOGIN</a></li> -->
                            <li><a class="white-text" href="admin/login.php">ADMIN LOGIN</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <div class="row valign-wrapper">
            <div class="col s12 m4 center">
                <a id="logo-container" class="brand-logo-footer white-text" href="index.php">CLASSY CLOSET</a>
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
    <div class="footer-copyright">
        <div class="container">
            Made by <a class="brown-text text-lighten-3" href="https://onebigbit.com/">One Big Bit</a>
        </div>
    </div>
</footer>

<!--  Scripts-->

<style>
    #loading {
        text-align: center;
        background: url('loader.gif') no-repeat center;
        height: 150px;
    }
</style>


<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/jquery-ui.js"></script>
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
            max: 65000,
            values: [100, 65000],
            step: 500,
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
<script src="js/init.js"></script>


</body>

</html>