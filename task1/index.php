<?php
    include './Validate.php'; //подключаем класс для проверки валидности json
    $pathJson1 = './first.json'; //json из API 1
    $pathJson2 = './second.json'; //json из API 2

    $jsonFile[0] = file_get_contents($pathJson1); //получаем строку из json Файла
    echo $validate->isValidate($jsonFile, basename($pathJson1)); //проверяем проверяем первый файл
    echo $validate->result;
    echo ($jsonFile[0]);
    echo '<br><br>';

    $jsonFile[0] = file_get_contents($pathJson2); //получаем строку из json Файла
    echo $validate->isValidate($jsonFile, basename($pathJson2)); //проверяем проверяем второй файл
    echo $validate->result;
    echo ($jsonFile[0]);
?>