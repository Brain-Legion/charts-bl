<?php

//предопределенные данные (имитация выбора чекбоксов и загрузки файла)
$tool1 = 'Lego Mindstorm';
$tool2 = 'Работа в команде';
$tool3 = 'Проектная деятельность';
$isUpload = true;
//---------------------------------------------------
echo "Начинаю создавать массив\n";
$jsonData = array( 
    array(
        "model"=> "9861c0dd-9f24-407c-b039-b78d67c4e7eb",
        "competence"=> "e6ffdfd9-18ba-43f9-9a97-c4fe2d237037",
        "level"=> "1",
        "sublevel"=> "2",
        "tools"=>array(
            $tool1
        )
        ),
    array(
        "model"=> "9861c0dd-9f24-407c-b039-b78d67c4e7eb",
        "competence"=> "1771045a-bbfd-448e-ae98-f9476c68c837",
        "level"=> "1",
        "sublevel"=> "2",
        "tools"=>array(
            $tool1
        )
    ),
    array(
        "model"=> "9861c0dd-9f24-407c-b039-b78d67c4e7eb",
        "competence"=> "4f470e9a-6154-48dd-9f6a-16fad7ed5545",
        "level"=> "1",
        "sublevel"=> "1",
        "tools"=>array(
            $tool2,
            $tool3
        )
    )
);

echo "Начинаю создавать директорию\n";
$path='../jsonData/';
if (!file_exists($path)) { //создать папку, если ее нет
    mkdir($path, 0700);
}


echo "Начинаю создавать файл\n";
$jsonDataConverted = json_encode($jsonData, JSON_UNESCAPED_UNICODE);

$openedFile = fopen($path.'dataUser.json', 'w+b');
$jsonFile = fwrite($openedFile, $jsonDataConverted);
if($jsonFile) echo "Данные успешно записаны!\n";
else echo "Не удалось записать данные!\n";
fclose($openedFile);


?>