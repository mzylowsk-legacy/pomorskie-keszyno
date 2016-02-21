<?php
$recoveredData = file_get_contents('../wyniki.dat');
$wyniki = unserialize($recoveredData);
$recoveredData = file_get_contents('../scores.dat');
$scores = unserialize($recoveredData);
$cachesCount=count($wyniki);
$geocachersInGame=count($scores)-1;
?>

<style>
* { 
	margin: 0; 
	padding: 0; 
}
body { 
	font: 14px/1.4 Georgia, Serif; 
}
#page-wrap {
	margin: 50px;
}
p {
	margin: 20px 0; 
}

	/* Zebra striping */
	tr:nth-of-type(odd) { 
		background: #eee; 
	}
	th { 
		background: #999; 
		color: white; 
		font-weight: bold; 
	}
	td, th { 
		padding: 6px; 
		border: 1px solid #ccc; 
		text-align: left; 
	}
	.srodek
	{
		text-align: center; 
	}
	a:link {
    text-decoration: none;
    color: #3E3F41;
}

a:visited {
    text-decoration: none;
    color: #3E3F41;
}

a:hover {
    text-decoration: underline;
    color: #3E3F41;
}

a:active {
    text-decoration: none;
    color: #3E3F41;
}

th.headerSortUp { 
    background-image: url(asc.gif); 
    background-color: #3399FF; 
}

th.headerSortDown { 
    background-image: url(desc.gif); 
    background-color: #3399FF; 
} 

th.header { 
    background-image: url(bg.gif); 
    cursor: pointer; 
    font-weight: bold; 
    background-repeat: no-repeat; 
    background-position: center left; 
    padding-left: 20px; 
    border-right: 1px solid #dad9c7; 
    margin-left: -1px; 
} 
</style>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<script type="text/javascript" src="jquery-latest.js"></script> 
	<script type="text/javascript" src="jquery.tablesorter.js"></script>
	<script>
	    $(document).ready(function() 
	    { 
		$("#myTable").tablesorter(); 
	    } 
);
	</script>
</head>
<body>
	<table id="myTable" class="tablesorter">
	<thead> 
	<tr>
		<th>Lp</th>
        	<th><span>Nick</span></th>
		<th class='srodek'><span><img title="Liczba skrzynek" src="http://opencaching.pl/tpl/stdstyle/images/cache/16x16-multi.png" /></span></th>
		<th class='srodek'><span><img title="Liczba znalezień" src="http://opencaching.pl/tpl/stdstyle/images/log/16x16-found.png" /></span></th>
		<th class='srodek'><span><img title="Liczba rekomendacji" src="http://opencaching.pl/images/rating-star.png" /></span></th>
		<th class='srodek'><span><img title="Liczba spóźnień" src="http://opencaching.pl/tpl/stdstyle/images/log/16x16-dnf.png" /></span></th>
		<th><span>Suma punktów</span></th>
	</tr>
	</thead>
	<tbody>
		<?php
			$sorted = false;
			while (false === $sorted) {
				$sorted = true;
				for ($i = 0; $i < $geocachersInGame-1; ++$i) {
					$current = $scores[$i];
					$next = $scores[$i+1];
					if ($next[5]+$next[6]*5+$next[3] > $current[5]+$current[6]*5+$current[3]) {
						$scores[$i] = $next;
						$scores[$i+1] = $current;
						$sorted = false;
					}
					else if($next[5]+$next[6]*5+$next[3] == $current[5]+$current[6]*5+$current[3] && $next[4] > $current[4]) {
						$scores[$i] = $next;
						$scores[$i+1] = $current;
						$sorted = false;
					}
				}
			}
			$realid=1;
			for($id=0;$id<$geocachersInGame;$id++)
			{
				$punkty=$scores[$id][5]+$scores[$id][6]*5+$scores[$id][3];
				$spoznienia = ($scores[$id][3] / 10) * -1;
				if($scores[$id][2]==1 && ($punkty >= 0 || $scores[$id][4] > 0))
				{
					echo "<tr>";
					echo "<td class='srodek'>".$realid."</td>";
					echo "<td>".$scores[$id][1]."</td>";
					echo "<td class='srodek'>".$scores[$id][4]."</td>";
					echo "<td class='srodek'>".$scores[$id][5]."</td>";
					echo "<td class='srodek'>".$scores[$id][6]."</td>";
					echo "<td class='srodek'>".$spoznienia."</td>";
					echo "<td class='srodek'>".$punkty."</td>";
					echo "</tr>";
					$realid++;
				}
				
			}
		?>
		</tbody>
	</table>
		Generated by <a target="_blank" href="http://opencaching.pl/viewprofile.php?userid=46365">Czarodziej</a>, with <a href="http://opencaching.pl/okapi/introduction.html" target="_blank">OKAPI</a>.
</body>
