<?php
	ini_set("allow_url_fopen", 1);
	$json = file_get_contents('https://www.sknt.ru/job/frontend/data.json');
	$array = json_decode($json);
	$result='';
	foreach($array->tarifs as $mydata){
		foreach($mydata->tarifs as $Smydata){
			if($Smydata->ID==$_GET["Pos"]){
				$Summ = $Smydata->pay_period*$Smydata->price;
				$result.= '
				<div class="banner">
					<div style="width:100%">
						<div class="title">Тариф "'.$Smydata->title.'"</div>
						<div class="infocont">
							<div class="infotext">						
								<div class="pricebox" style="font-weight: bold;">Период оплаты - ';
									if($Smydata->pay_period>1)
										$result.= $Smydata->pay_period.' месяцев<br>';
									else if($Smydata->pay_period<5)
										$result.= $Smydata->pay_period.' месяца<br>';
									else
										$result.= $Smydata->pay_period.' месяц<br>';
									$result.= $Smydata->price.' &#8381/мес
									</div>
								<div class="pricebox">разовый платёж - '.$Summ.' &#8381<br>со счёта спишется - '.$Summ.' &#8381</div><div class="pricebox" style="font-size: 10pt">вступит в силу - сегодня<br>ативно до - '.date('d.m.Y',strtotime(''.date('d.m.Y').' +'.$Smydata->pay_period.' month')).'</div>
							</div>
						</div>				
						<div class="chosebtncont">
							<div class="chosebtn">Выбрать</div>
						</div>	
					</div>	
				</div>
				';
				break;
			}
		}
	}
	echo $result;
?>