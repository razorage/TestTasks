<?php //класс для проверки владиности json файла
    class ValidateJson{
        private $result;

        public function isValidate($jsonFile, $jsonName){ //метод для перебора получченого файла
            $out = '';
            foreach ($jsonFile as $string) {
                json_decode($string); //декодируем строку
                switch (json_last_error()) { //формируем результат об ошибках
                    case JSON_ERROR_NONE:
                        $out .= ' валидный';
                    break;
                    case JSON_ERROR_DEPTH:
                        $out .= ' не валиден! - Достигнута максимальная глубина стека';
                    break;
                    case JSON_ERROR_STATE_MISMATCH:
                        $out .= ' не валиден! - Некорректные разряды или несоответствие режимов';
                    break;
                    case JSON_ERROR_CTRL_CHAR:
                        $out .= ' не валиден! - Некорректный управляющий символ';
                    break;
                    case JSON_ERROR_SYNTAX:
                        $out .= ' не валиден! - Синтаксическая ошибка';
                    break;
                    case JSON_ERROR_UTF8:
                        $out .= ' не валиден! - Некорректные символы UTF-8, возможно неверно закодирован';
                    break;
                    default:
                        $out .= ' не валиден! - Неизвестная ошибка(а может и известная, кто знает)';
                    break;
                }
            }
            $this->result = 'Файл '.$jsonName.' '.$out.'<br>';
        }

        public function __get($name){ //метод для возвращение полученного результата
            return $this->$name;
        }
    }
    $validate = new ValidateJson();
?>