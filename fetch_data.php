<?php

require('includes/connection.inc.php');
require('includes/function.inc.php');

$super_cat = $_POST["super_cat_id"];
if (isset($_POST["action"])) {
	$query = "
	SELECT product_new.* 
	FROM product_new
	INNER JOIN categories ON product_new.subcat_id = categories.id
	WHERE categories.super_categories_id =  '$super_cat'
	
	";
	if (isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"])) {
		$query .= "
		 AND mrp BETWEEN '" . $_POST["minimum_price"] . "' AND '" . $_POST["maximum_price"] . "'
		";
	}
	// if (isset($_POST["brand"])) {
	// 	$brand_filter = implode("','", $_POST["brand"]);
	// 	$query .= "
	// 	 AND brand IN('" . $brand_filter . "')
	// 	";
	// }
	// if (isset($_POST["fabric"])) {
	// 	$fabric_filter = implode("','", $_POST["fabric"]);
	// 	$query .= "
	// 	 AND fabric IN('" . $fabric_filter . "')
	// 	";
	// }
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
		$i = 0;
		$image_super_id = $data['image_super_id'];
		$image = "SELECT `name` AS `image` FROM product_images WHERE product_images.super_id=$image_super_id";
		$res_image = mysqli_query($con, $image);
		while ($row_image = mysqli_fetch_assoc($res_image)) {
			$data['image'][$i++] =  $row_image['image'];
		}
		$result[] = $data;
	}

	// prx($result);
	$output = '';
	if (!empty($result)) {
		foreach ($result as $row) {
			$price = 0;
			if ($row['discount_type'] == 'rate') {
				$price = ($row['mrp'] - $row['discount']);
			} elseif ($row['discount_type'] == 'percent') {
				$price = ($row['mrp'] - (($row['discount'] * $row['mrp']) / 100));
			} else {
				$price = $row['mrp'];
			}
			$output .= '
			 <div class="col s6 m4 l3 product_container_inner">
                <div class="dress-card box_shadow center">
                    <a href="product.php?id=' . $row['id'] . '" class="black-text">
                        <div class="dress-card-head">
                            <img class="dress-card-img-top" src="media/product/' . $row['image'][0] . '" alt="">
                        </div>
                        <div class="dress-card-body">
                            <h4 class="dress-card-title">' . $row['name'] . '</h4>
                            <p class="dress-card-para">

							
                                    <span class="dress-card">Rs. ' . $price . '</span> 

                              

                                <a href="javascript:void(0)" onclick="wishlist_manage(' . $row['id'] . ',"add")" class="wishlist"><i class="fa fa-heart" aria-hidden="true"></i>
                                </a>
                                <!-- <span class="dress-card-off">&ensp;(60% OFF)</span> -->
                            </p>
                        </div>
                    </a>

                </div>
            </div>
                             
                       
			';
		}
	}
} else {
	$output = '<h1 class="black-text right">No Data Found</h1>';
}
echo $output;
