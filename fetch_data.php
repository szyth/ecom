<?php

require('includes/connection.inc.php');
require('includes/function.inc.php');

$super_cat = $_POST["super_cat_id"];
if (isset($_POST["action"])) {
	$query = "
	SELECT product.* 
	FROM product
	INNER JOIN categories ON product.categories_id = categories.id
	WHERE categories.super_categories_id =  '$super_cat'
	
	";
	if (isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"])) {
		$query .= "
		 AND price BETWEEN '" . $_POST["minimum_price"] . "' AND '" . $_POST["maximum_price"] . "'
		";
	}
	if (isset($_POST["brand"])) {
		$brand_filter = implode("','", $_POST["brand"]);
		$query .= "
		 AND brand IN('" . $brand_filter . "')
		";
	}
	if (isset($_POST["fabric"])) {
		$fabric_filter = implode("','", $_POST["fabric"]);
		$query .= "
		 AND fabric IN('" . $fabric_filter . "')
		";
	}
	if (isset($_POST["size"])) {
		$size_filter = implode("','", $_POST["size"]);
		$query .= "
		 AND size IN('" . $size_filter . "')
		";
	}
	if (isset($_POST["color"])) {
		$color_filter = implode("','", $_POST["color"]);
		$query .= "
		 AND color IN('" . $color_filter . "')
		";
	}

	$res = mysqli_query($con, $query);
	while ($data = mysqli_fetch_assoc($res)) {
		$result[] = $data;
	}

	// prx($result);
	$output = '';
	if (!empty($result)) {
		foreach ($result as $row)
			$output .= '
			<div class="col s6 m4 l3 product_container_inner">
                            <a href="product.php?id=' . $row['id'] . '" class="black-text">
                                <div class="dress-card box_shadow">
                                    <div class="dress-card-head">
                                        <img class="dress-card-img-top" src="media/product/' . $row['image'] . '" alt="">
                                    </div>
                                    <div class="dress-card-body">
                                        <h4 class="dress-card-title"> ' . $row['name'] . '</h4>
                                        <p class="dress-card-para">
                                            <span class="dress-card-price">Rs.' . $row['price'] . ' &ensp;</span>
                                            <span class="dress-card-crossed">Rs.' . $row['mrp'] . '</span>
                                            <!-- <span class="dress-card-off">&ensp;(60% OFF)</span> -->
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
			';
	}
} else {
	$output = '<h1 class="black-text right">No Data Found</h1>';
}
echo $output;
