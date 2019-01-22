<?php

	if (isset($action) && $action != '') {
		print'<div class="news1">';
		$query  = "SELECT * FROM galery ";
		$query .= "INNER JOIN pictures ON galery.Pictures_id = pictures.id";
		$query .= " WHERE galery.News_id=" . $_GET['action'];
		$result = @mysqli_query($MySQL, $query);
		while($row = @mysqli_fetch_array($result)) {
			print'<div >';
			print'<img src=news/'.$row['name'].' alt="'.$row['name'].'"  height="150">';








			print'</div>';





		}
		print'</div>';
		print'<hr>';
		$query  = "SELECT * FROM news";
		$query .= " WHERE id=" . $_GET['action'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
			print '
			<div class="news">
				<img src="news/' . $row['picture'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '">
				<h2>' . $row['title'] . '</h2>
				<p>'  . $row['description'] . '</p>
				<time datetime="' . $row['date'] . '">' . pickerDateToMysql($row['date']) . '</time>
				<hr>
			</div>';
	}
	else {
		print '<h1>NEWS</h1>';
		$query  = "SELECT * FROM news";
		$query .= " WHERE archive='N'";
		$query .= " ORDER BY date DESC";
		$result = @mysqli_query($MySQL, $query);
		while($row = @mysqli_fetch_array($result)) {
			print '
			<div class="news">
				<img src="news/' . $row['picture'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '">
				<h2>' . $row['title'] . '</h2>';

					echo substr(strip_tags($row['description']), 0, 300).'... <a href="index.php?menu=' . $menu . '&amp;action=' . $row['id'] . '">More</a>';

				print '
				<time datetime="' . $row['date'] . '">' . pickerDateToMysql($row['date']) . '</time>
				<hr>
			</div>';
			echo'<h3>RSS TOP 5</h3>';
	$feed = file_get_contents('https://www.24sata.hr/feeds/aktualno.xml');

	$rss = simplexml_load_string($feed);
print('<div class="news1" >');
	$coun=1;
	foreach ($rss->channel->item as $item) {
		$coun++;
		print('<div style="background-color: grey">');
   echo "<p>" . $item->title .' '.'<a href="' . $item->link . '">More</a>'.'</p>';

   echo "<p>" . $item->category . "</p>";
   print('</div>');
   IF($coun==6)
   {
   	break;
   }

}
print('</div>');
		}
	}
?>
