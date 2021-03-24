<?php
    class StreetBase{ //класс для соритровки и формирования файла
        private $arr = [];
        public function sortFile($address, $path){ //метод для сортировки строки

            $address = str_replace('Активный', 'Активный,', $address); //добавляем в колонку активный символ , для сепарации
            $address = str_replace('да', 'да,', $address); //добавляем в колонку активный символ , для сепарации
            $address = str_replace('нет', 'нет,', $address);//добавляем в колонку активный символ , для сепарации
            $address = explode(',',trim($address)); //разбиваем строку на массивы
            $address = array_chunk($address,3,false); //разбиваем массив на подмассивы

            if(($file = fopen($path, 'w')) !== false){ //открываем файл на запись
                foreach($address as $line){ //заполняем файл массивом
                    fputcsv($file,$line,";");
                }
                fclose($file);
            } else {
                return 'Ошибка при сортировки файла';
            }
            
        }

        public function createFile($path, $pathIn){
            $arr = [];
            if(($file = fopen($path, 'r')) !== false){
                while(($data = fgetcsv($file, filesize($path), ';'))!==false){
                    for($i = 0; $i < count($data); $i++){
                        $arr[] = $data[$i];
                    }
                }
            } else {
                return 'Ошибка при создании файла';
            }
            fclose($file);

            
            $arr = array_chunk($arr,3,false); //разбиваем массив на подмассив
            $postion = 0;
            $inFile[] = $arr[0]; //массив для вывода значений в файл
            for ($i = 0; $i < count($arr); $i++){
                for ($k = 0; $k < count($arr[$i]); $k++){
                    if (trim($arr[$i][$k]) == 'Активный'){ //вылавливаем необходимую колонку
                        $postion = $k;
                    }
                }
                if (trim($arr[$i][$postion]) =='да'){
                    $inFile[] = $arr[$i];
                }
            }
            if(($file = fopen($pathIn, 'w')) !== false){ //открываем файл на запись
                foreach($inFile as $line){ //заполняем файл массивом
                    fputcsv($file,$line,";");
                }
                fclose($file);
            } else {
                return 'Ошибка при сортировки файла';
            }
        }

        public function readFile($path){ //функция для чтения файла
            $outTable = '';
            if (($file = fopen($path, 'r'))!==false){
                $outTable .= '<table>';
                while(($data = fgetcsv($file,filesize($path),';'))!==false){
                    $outTable .= '<tr>';
                    for ($i = 0; $i < count($data); $i++){
                        $outTable .= '<td>'.$data[$i].'</td>';
                    }
                    $outTable .= '</tr>';
                }
                $outTable .= '</table>';
            }
            fclose($file);
            return $outTable;
        }
    }

    $streetBase = new StreetBase();

    # P.S. Кодировка у windows при использовании csv файла может стоять другая (не utf-8)
    # в таком случае придется вручную менять кодировку csv файла на utf-8
    # на линуксе вроде автоматически стоит utf-8
    # на странице index.php навсякий случай поставил кодировку utf-8, 
    # на тот случай если вы используете сервер какого-нибудь хостинга
?>