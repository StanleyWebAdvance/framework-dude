<?php

namespace helpers;


class StringDude
{
    //  алфавиты
    private static $alphabet = array(

        'rus' => array(
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й',
            'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф',
            'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я',
            'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й',
            'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф',
            'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'
        ),

        'translit' => array(
            'A', 'B', 'V', 'G', 'D', 'E', 'IO', 'ZH', 'Z', 'I', 'I',
            'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F',
            'H', 'C', 'CH', 'SH', 'SH', '`', 'Y', '`', 'E', 'IU', 'IA',
            'a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'i',
            'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f',
            'h', 'c', 'ch', 'sh', 'sh', '`', 'y', '`', 'e', 'iu', 'ia'
        )
    );

    /**
     *  Функция транслитерации с кирилицы на латиницу
     *
     * @param $text
     * @return mixed
     */
    public static function translit($text)
    {
        return str_replace(self::$alphabet['rus'], self::$alphabet['translit'], $text);
    }

    /** генерируем рандомную строку
     *
     * @param $len
     * @return string
     */
    public static function genRandomString($len)
    {
        $string = "";
        $symbol = array(
            'select' => '',
            1 => '0123456789',
            2 => 'qwertyuiopasdfghjklzxcvbnm',
            3 => 'QWERTYUIOPASDFGHJKLZXCVBNM',
            4 => "qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM"
        );

        $counter = 1;
        $counterSymbol = 1;
        while ($counter <= $len) {

            $symbol['select'] = $symbol[$counterSymbol];
            $string .= substr($symbol['select'], mt_rand(0, strlen($symbol['select'])) - 1, 1);
            $counterSymbol = ($counterSymbol == 4) ? $counterSymbol = 1 : $counterSymbol + 1;
            $counter++;
        }

        return $string;
    }
}