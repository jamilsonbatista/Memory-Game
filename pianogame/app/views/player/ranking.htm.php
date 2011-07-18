<?
$i=0;
  echo '<table width="100%" cellspacing="0" cellpadding="4" border="1">';
      echo '<tr>';
      echo '<th align="left">Ranking</th>';      
      echo '<th align="left">Name</th>';
	  echo '<th align="left">Points</th>';
      echo '<th align="left">Time</th>';
      echo '<th align="left">Attempts</th>';
      echo '</tr>';
	foreach($ranking as $rank){
		echo '<tr>';
		echo '<td>' . ++$i . '</td>';
		echo '<td>' . $rank["name_player"] . '</td>';
		echo '<td>' . $rank["score"] . '</td>';
		echo '<td>' . $rank["time"] . '</td>';
		echo '<td>' . $rank["attempts"] . '</td>';
		echo '</tr>';
	} 
	echo '</table>';
?>