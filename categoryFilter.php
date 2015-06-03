<html>
	<head>
  <title>Flashtalking PHP coding exercise</title>
	</head>
	<body>

 	<?php 
 	// Loading in the XML File
 	$url = "waitrose.xml";

 	// Get file contents and encode into a json
	$xml = new SimpleXMLElement(file_get_contents($url));
	$json = json_encode($xml);

	// Convert json into an array to make it easier to tranverse
	$array = json_decode($json,TRUE);


	// Create a function that works on all subcategories
	function filterByCategory($arrayToFilter, $categoryName, $categoryLevel = 2){
		$categoryArray = [];
		$nonwhitespaceCategoryName = strtolower($categoryName);
		$nonwhitespaceCategoryName = str_replace(' ', '', $nonwhitespaceCategoryName);
		$fileName = $nonwhitespaceCategoryName . '.json';

		// Create json named after the input category
		$file = fopen($fileName, 'w');
		$filter = 'Groceries';
		if ($categoryLevel === 2){
			$addSubcategory = ' > ' . $categoryName;
			$filter .= $addSubcategory;
		}

		// Traverse products and look for common conditions between subcategory levels
		foreach ($arrayToFilter['product'] as $product) {
			if (strpos($product['category'], $filter) !== false && $categoryLevel == 2) {
				array_push($categoryArray, $product);
			} else if ($categoryLevel === 3){
				$split_categories = explode(' > ', $product['category']);
				if ($split_categories[2] === $categoryName){
					array_push($categoryArray, $product);
				}
			} else if ($categoryLevel === 4){
				$split_categories = explode(' > ', $product['category']);
				if ($split_categories[3] === $categoryName){
					array_push($categoryArray, $product);
				}
			} else if ($categoryLevel === 5){
				$split_categories = explode(' > ', $product['category']);
				if ($split_categories[4] === $categoryName){
					array_push($categoryArray, $product);
				}
			} 
		}

		// Write Data to json
		fwrite($file, json_encode($categoryArray));
		fclose($file);
	}

	// Run function on all Level 2 subcategories
	filterByCategory($array, 'Food Cupboard', 2);
	filterByCategory($array, 'Summer', 2);
	filterByCategory($array, 'Bakery', 2);
	filterByCategory($array, 'Frozen', 2);
	filterByCategory($array, 'Drinks', 2);
	filterByCategory($array, 'Pets', 2);
	filterByCategory($array, 'Fresh', 2);
	filterByCategory($array, 'Toiletries', 2);
	filterByCategory($array, 'Fruit & Veg', 2);
	filterByCategory($array, 'Household', 2);
	filterByCategory($array, 'Baby', 2);

	// *********************************************************************************************
	// Below I have included my initial, unfactored code to get a better understanding of php methods
	// *********************************************************************************************

	// $foodCupboard = fopen('foodcupboard.json', 'w');
	// $summer = fopen('summer.json', 'w');
	// $bakery = fopen('bakery.json', 'w');
	// $frozen = fopen('frozen.json', 'w');
	// $drinks = fopen('drinks.json', 'w');
	// $pets = fopen('pets.json', 'w');
	// $fresh = fopen('fresh.json', 'w');
	// $toiletries = fopen('toiletries.json', 'w');
	// $fruitVeg = fopen('fruitVeg.json', 'w');
	// $houseHold = fopen('houseHold.json', 'w');
	// $baby = fopen('baby.json', 'w');

	// $foodCupboardArray = [];
	// $summerArray = [];
	// $bakeryArray = [];
	// $frozenArray = [];
	// $drinksArray = [];
	// $petsArray = [];
	// $freshArray = [];
	// $toiletriesArray = [];
	// $fruitVegArray = [];
	// $houseHoldArray = [];
	// $babyArray = [];

	// foreach ($array['product'] as $val) {
	// 	if (strpos($val['category'], 'Groceries > Food Cupboard') !== false) {
	// 		array_push($foodCupboardArray, $val);
	// 	} else if (strpos($val['category'], 'Groceries > Summer') !== false) {
	// 		array_push($summerArray, $val);
	// 	} else if (strpos($val['category'], 'Groceries > Bakery') !== false) {
	// 		array_push($bakeryArray, $val);
	// 	} else if (strpos($val['category'], 'Groceries > Frozen') !== false) {
	// 		array_push($frozenArray, $val);
	// 	} else if (strpos($val['category'], 'Groceries > Drinks') !== false) {
	// 		array_push($drinksArray, $val);
	// 	} else if (strpos($val['category'], 'Groceries > Pets') !== false) {
	// 		array_push($petsArray, $val);
	// 	} else if (strpos($val['category'], 'Groceries > Fresh') !== false) {
	// 		array_push($freshArray, $val);
	// 	} else if (strpos($val['category'], 'Groceries > Toiletries') !== false) {
	// 		array_push($toiletriesArray, $val);
	// 	} else if (strpos($val['category'], 'Groceries > Fruit & Veg') !== false) {
	// 		array_push($fruitVegArray, $val);
	// 	} else if (strpos($val['category'], 'Groceries > Household') !== false) {
	// 		array_push($houseHoldArray, $val);
	// 	} else if (strpos($val['category'], 'Groceries > Baby') !== false) {
	// 		array_push($babyArray, $val);
	// 	} else {
	// 		echo 'missing category';
	// 		echo $val['category'];
	// 	}	
	// };

	// fwrite($foodCupboard, json_encode($foodCupboardArray));
	// fwrite($summer, json_encode($summerArray));
	// fwrite($bakery, json_encode($bakeryArray));
	// fwrite($frozen, json_encode($frozenArray));
	// fwrite($drinks, json_encode($drinksArray));
	// fwrite($pets, json_encode($petsArray));
	// fwrite($fresh, json_encode($freshArray));
	// fwrite($toiletries, json_encode($toiletriesArray));
	// fwrite($fruitVeg, json_encode($fruitVegArray));
	// fwrite($houseHold, json_encode($houseHoldArray));
	// fwrite($baby, json_encode($babyArray));

	
	// fclose($foodCupboard);
	// fclose($summer);
	// fclose($bakery);
	// fclose($frozen);
	// fclose($drinks);
	// fclose($pets);
	// fclose($fresh);
	// fclose($toiletries);
	// fclose($fruitVeg);
	// fclose($houseHold);
	// fclose($baby);

 	?> 
	</body>
</html>