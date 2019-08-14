<?php
	ini_set("allow_url_fopen", 1);
	$json = file_get_contents('https://www.sknt.ru/job/frontend/data.json');
	$array = json_decode($json);
	$counter=0;
	$Tresult ="";
	foreach($array->tarifs as $mydata){
		$Tresult .= 
		'<div name="tariff" class="banner">
			<div style="width:100%">
				<div class="title">Тариф "'.$mydata->title.'"</div>
				<div class="infocont" action="php/2.php?Pos='.$counter.'" onclick="AjaxGetData(event)" nexttitle="Тариф &#34'.$mydata->title.'&#34">
					<div class="infotext">
						<div class="speedbox" style="background-color: '.ColorOfTitle($mydata->title).'">'.$mydata->speed.' МБит/c</div>
						<div class="pricebox">';
						$length = count($mydata->tarifs);
						$max = 0;
						if($length>1){
							for($i=0; $i<$length; $i++){
								if($max<$mydata->tarifs[$i]->price)
									$max=$mydata->tarifs[$i]->price;
							}
						}
						$min=$max;
						for($i=0; $i<$length; $i++){
							if($min>$mydata->tarifs[$i]->price)
								$min=$mydata->tarifs[$i]->price;
						}
						$Tresult .= $min.'-'.$max;
						$Tresult .=' &#8381/мес</div>
						<div class="pricebox" style="font-size: 10pt">';
						if(isset($mydata->free_options)){
							foreach ($mydata->free_options as $value) {
								$Tresult .= $value . "<br>";
							}
						}
						$Tresult .='</div>
					</div>
					<div class="imgwrapper">
						<img src="img/next.png">
					</div>
				</div>
			</div>
			<a href="'.$mydata->link.'" class="moreinfo">узнать подробнее на сайте www.sknt.ru</a>
		</div>';
		$counter++;
	}
	function ColorOfTitle($name){
		if(strpos($name, 'Земля') !== false)
			return '#70603e';
		if(strpos($name, 'Вода') !== false)
			return '#0075d9';
		if(strpos($name, 'Огонь') !== false)
			return '#e74807';
	}
	if(isset($result))
		$result.=$Tresult;
	else
		echo $Tresult;
?>