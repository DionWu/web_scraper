<html>
<head>
	<link type="text/css" href="domwebcrawler.css" rel="stylesheet" media="all" />  
	
</head>
<body>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
<input type="text" name="searchquery"> <input type="submit"> <br>
What do you want to search today?

<?php
	include 'simple_html_dom.php';
	$dom = new simple_html_dom();
	@$query = $_GET["searchquery"];
	
	function print_type($var){
	  	echo gettype($var);
	  	echo "</br>";
	  	if (is_array($var)){
	    	echo sizeof($var);
	  	}
	  	echo "</br>";
	}

	if (!empty($query)) {
		$dom->load_file('http://pinterest.com/search/boards/?q=' . urlencode($query));
		//$images= $dom->find('.PinHolder img');
		//print_type($images);
		$links = $dom->find('.board > a');
		$hrefs = array();
		foreach ($links as $raw_links) {
			$hrefs = $raw_links->href;
		};
		print_type($hrefs);

?>

<div class="js-masonry" data-masonry-options='{"itemSelector": ".pins", "columnWidth":10}'>

<?php 
		for ($i=0; $i<=20; $i++) {
			if (isset($images[$i])) {
				echo "<div class='pins'>" . $images[$i] . "</div>";
			};
		};
?>	

</div>

<?php
	};
?>

</body>
<script src="masonry.js"></script>
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery.lazyload.js" type="text/javascript"></script>
</html>

