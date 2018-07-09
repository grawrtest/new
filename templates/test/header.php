<!DOCTYPE html>
<html lang="ru">
<head>
	<title>test</title>
	<?$APPLICATION->ShowHead()?> 
	<?
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/style.css", true);
	?> 
</head>
<body>
	<?
		if($_POST["I"] && $_POST["F"] && $_POST["TEL"] )
		{
			if(CModule::IncludeModule('iblock'))
			{
				$el = new CIBlockElement;
				$PROP = array();
				$PROP["I"] = $_POST["I"];  
				$PROP["F"] = $_POST["F"]; 
				$PROP["TEL"] = $_POST["TEL"]; 

				$arLoadProductArray = Array(
				  "IBLOCK_ID"      => 1,
				  "PROPERTY_VALUES"=> $PROP,
				  "NAME"           => $_POST["I"],
				  "ACTIVE"         => "Y"
				  );

				$el->Add($arLoadProductArray);
				
				$text="ID;Фамилия;Имя;Телефон;\r\n";
				$arSelect = Array("ID", "PROPERTY_I", "PROPERTY_F", "PROPERTY_TEL");
				$arFilter = Array("IBLOCK_ID" => 1);
				$res =  CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
				while($ob = $res->GetNextElement())
				{
					$arFields = $ob->GetFields();
					$text.=$arFields["ID"].";".$arFields["PROPERTY_I_VALUE"].";".$arFields["PROPERTY_F_VALUE"].";".$arFields["PROPERTY_TEL_VALUE"].";\r\n";
				}
				$file = fopen ("file.csv","a+");
				fputs ( $file, $text);
				fclose ($file);
						
			}
		}
		else
		{?>
			<div id="panel"><?$APPLICATION->ShowPanel();?></div>
				<div class="form">
					<form action="/" id="form">
						<input type="text" name="F" placeholder="Фамилия">
						<input type="text" name="I" placeholder="Имя">
						<input type="text" name="TEL" placeholder="Телефон">
						<button>
							отправить
						</button>
					</form>
				</div>
				<div class="table">
					<table>
						<tbody>
							<tr>
								<th>ID</th>
								<th>ИМЯ</th>
								<th>ФАМИЛИЯ</th>
								<th>ТЕЛЕФОН</th>
							</tr>
							<?
								if(CModule::IncludeModule('iblock'))
								{
									$arSelect = Array("ID", "PROPERTY_I", "PROPERTY_F", "PROPERTY_TEL");
								    $arFilter = Array("IBLOCK_ID" => 1);
								    $res =  CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
								    while($ob = $res->GetNextElement()){
								        $arFields = $ob->GetFields();
										?>
											<tr>
												<td><?=$arFields["ID"]?></td>
												<td><?=$arFields["PROPERTY_I_VALUE"]?></td>
												<td><?=$arFields["PROPERTY_F_VALUE"]?></td>
												<td><?=$arFields["PROPERTY_TEL_VALUE"]?></td>
											</tr>
										<?
								    		
								    }
								}
							?>
						</tbody>
					</table>
					<a download href="/file.csv">
						Скачать таблицу
					</a>
				</div>

		<?}
	?>
	