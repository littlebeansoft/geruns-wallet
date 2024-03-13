<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		</head><body>
		<?php
			require_once 'Classes/PHPExcel.php';
			
			$excel = PHPExcel_IOFactory::load('../../uploads/pmj/1276010001.xlsx');
			
			//set active sheet to first sheet
			$excel->setActiveSheetIndex(0);
			
			echo "<table border=1><tr>";
			
			//first row of data series
			$i = 7;
			$c='A';
			$co=1;
			while($excel->getActiveSheet()->getCell($c.'1')->getValue()!=""){
				echo '<td>'.$excel->getActiveSheet()->getCell($c.'1')->getValue().'</td>';
				++$c;
				++$co;
			}
			//loop until the end of data series(cell contains empty string)
			$c2='A';
			while( $excel->getActiveSheet()->getCell('B'.$i)->getValue() != ""){
				//while( $i<5){
				$co2=1;
				while($co2<$co){
					if($c2=='A'){ echo '<tr>';}
					//get cells value
					echo '<td>'.$excel->getActiveSheet()->getCell($c2.$i)->getValue().'</td>';
					++$c2;
					++$co2;
					if($c2==$c){
						$c2='A';
					echo "</tr>";}
					//if($c2==$c){echo '</tr>';$c2='A';$co2=1;}
					//echo		
					//and DON'T FORGET to increment the row pointer ($i)
					
				}
				$i++;
			}
			
			
			echo "</table>";
		?>
	</body>
</html>