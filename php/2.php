<?php
	ini_set("allow_url_fopen", 1);
	$json = file_get_contents('https://www.sknt.ru/job/frontend/data.json');
	$array = json_decode($json);
	$array = $array->tarifs[$_GET["Pos"]]->tarifs;
	$arrayCount = count($array);
	for($i = 0; $i < $arrayCount; $i++)
    {
        $rightValue = $array[$i];
        $leftValue = $i - 1;
        
        while($leftValue >= 0 && $array[$leftValue]->pay_period > $rightValue->pay_period)
        {
            $array[$leftValue+1] = $array[$leftValue];
            $leftValue--;
        }
        
        $array[++$leftValue] = $rightValue;
    }
	foreach($array as $mydata){
		$Summ = $mydata->price/$mydata->pay_period;
		$discount = ($mydata->pay_period*$array[0]->price)-$mydata->price;
		if($discount>0)
			$discount='<br>скидка - '.$discount.' &#8381';
		else
			$discount='';		
		echo '
			<div class="banner">
				<div style="width:100%">
					<div class="title">'.$mydata->pay_period.' месяц</div>
					<div class="infocont" action="php/3.php?Pos='.$mydata->ID.'" onclick="AjaxGetData(event)" nexttitle="Выбор тарифа">
						<div class="infotext">						
							<div class="pricebox">'.$Summ.' &#8381/мес</div>
							<div class="pricebox" style="font-size: 10pt">разовый платёж '.$mydata->price.' &#8381'.$discount.'</div>
							</div>
						<div class="imgwrapper">
							<img src="img/next.png">
						</div>
					</div>
				</div>			
			</div>
		';
	}
?>