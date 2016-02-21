<?php
$recoveredData = file_get_contents('../wyniki.dat');
$wyniki = unserialize($recoveredData);
$recoveredData = file_get_contents('../scores.dat');
$scores = unserialize($recoveredData);
$cachesCount=count($wyniki);
$geocachersInGame=count($scores);
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
        <th class='srodek'><span><img src="http://opencaching.pl/tpl/stdstyle/images/log/16x16-go.png" /></span></th>
        <th class='srodek'><span><img src="http://opencaching.pl/tpl/stdstyle/images/free_icons/box.png" /></span></th>
        <th class='srodek'><span><img src="http://opencaching.pl/tpl/stdstyle/images/log/16x16-found.png" /></span></th>
        <th class='srodek'><span><img src="http://opencaching.pl/tpl/stdstyle/images/log/16x16-dnf.png" /></span></th>
        <th class='srodek'><span><img src="http://opencaching.pl/images/rating-star.png" /></span></th>
        <th><span>Nazwa</span></th>
        <th><span>Właściciel</span></th>
	</tr>
	</thead>
	<tbody>
		<?php
			if(empty($_GET["sortby"]))
				$sortby=0;
			else
				$sortby=$_GET["sortby"]; 
			$sorted = false;
			while (false === $sorted) {
				$sorted = true;
				for ($i = 0; $i < $cachesCount-1; ++$i) {
					$current = $wyniki[$i];
					$next = $wyniki[$i+1];
					if ($next[$sortby] < $current[$sortby]) {
						$wyniki[$i] = $next;
						$wyniki[$i+1] = $current;
						$sorted = false;
					}
				}
			}	
			for($id=0;$id<$cachesCount;$id++)
			{
				if($wyniki[$id][10]!=-1)
				{
					echo "<tr>";
					$lp=$id+1;
					echo "<td class='srodek'>".$lp."</td>";
					if($wyniki[$id][1]==0)
						echo "<td class='srodek'><img src='http://opencaching.pl/tpl/stdstyle/images/log/16x16-published.png' /></td>";
					else if($wyniki[$id][1]==1)
						echo "<td class='srodek'><img src='http://opencaching.pl/tpl/stdstyle/images/log/16x16-temporary.png' /></td>";
					else
						echo "<td class='srodek'><img src='http://opencaching.pl/tpl/stdstyle/images/log/16x16-trash.png' /></td>";
					//===
					if($wyniki[$id][2]==0)
						echo "<td class='srodek'><img src='http://opencaching.pl/tpl/stdstyle/images/cache/16x16-traditional.png' /></td>";
					else if($wyniki[$id][2]==1)
						echo "<td class='srodek'><img src='http://opencaching.pl/tpl/stdstyle/images/cache/16x16-quiz.png' /></td>";
					else if($wyniki[$id][2]==2)
						echo "<td class='srodek'><img src='http://opencaching.pl/tpl/stdstyle/images/cache/16x16-multi.png' /></td>";
					else
						echo "<td class='srodek'><img src='http://opencaching.pl/tpl/stdstyle/images/cache/16x16-unknown.png' /></td>";
					echo "<td class='srodek'>".$wyniki[$id][3]."</td>";
					echo "<td class='srodek'>".$wyniki[$id][4]."</td>";
					echo "<td class='srodek'>".$wyniki[$id][5]."</td>";
					echo "<td><a target='_blank' href='".$wyniki[$id][7]."'>".$wyniki[$id][6]."</a></td>";
					echo "<td><a target='_blank' href='".$wyniki[$id][8]."'>".$wyniki[$id][9]."</a></td>";
					echo "</tr>";
				}
				
			}
		?>
		</tbody>
	</table>
		Generated by <a target="_blank" href="http://opencaching.pl/viewprofile.php?userid=46365">Czarodziej</a>, with <a href="http://opencaching.pl/okapi/introduction.html" target="_blank">OKAPI</a>.
</body>