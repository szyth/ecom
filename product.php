<?php require('includes/header.inc.php'); ?>




<section>
    <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="row center">
                    <h5 class="header col s12">
                        <div class="breadcrumb_wrapper">
                            <a href="index.html" class="breadcrumb">Home</a>
                            <a href="categories.html" class="breadcrumb">Category</a>
                            <a href="login.html" class="breadcrumb">Product</a>
                        </div>
                    </h5>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="media/parallax/4.jpg" alt="Unsplashed background img 2"></div>
    </div>
</section>


<!-- PRODUCT -->
<div class="row">
    <div class="col m4 push-m1 l4 push-l1 s12 product_image">
        <img src="https://assets.myntassets.com/h_1440,q_100,w_1080/v1/assets/images/7578929/2018/10/23/86988cdc-cbe3-4b13-93f9-b37ad571b4761540274855321-Harpa-Women-Dresses-9171540274855158-1.jpg" alt="">
    </div>


    <div class="col m6 push-m1 l6 push-l1 s10 push-s1">
        <div class="product_details">
            <h2 class="product_title">New Product</h2>
            <ul class="">
                <li class="mrp">Rs. 499</li>
                <li class="price">Rs. 299</li>
            </ul>
            <p class="">This is a short description about this product.Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. Nullam scelerisque id
                nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut
                ultricies
                eros. Maecenas eros justo, ullamcorper a sapien id, viverra ultrices eros.</p>
            <div class="">
                <div class="product_availability">
                    <p><span class="black-text">Availability:</span> In Stock</p>
                </div>
                <div class="">
                    <p><span>Quantity:</span>
                        <select class="browser-default">
                            <option value="1" selected>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                        </select>
                    </p>
                </div>
                <div class="product_category">
                    <span class="black-text">Category:</span> <a href="categories.html"> CAT1</a>
                </div>

                <a id="add_to_cart" class="waves-effect waves-light btn-large btn-flat" href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id'] ?>','add')">Add to cart</a>

            </div>
        </div>
    </div>
</div>
<!-- PRODUCT - END -->


<section>
    <svg class="curve" data-name="layer" viewBox="0 0 1416.9 174.01">
        <path d="M0,220.8S283.66,120,608.94,163.56s437.93,100.57,818,10.34V309.54H0V280.8Z" transform="translate(0 -120.53)" />

    </svg>
</section>



<?php require('includes/footer.inc.php'); ?>