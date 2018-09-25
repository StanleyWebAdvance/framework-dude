<?php

namespace core\request;


class Response
{
    /** возврат данных json
     *
     * @param $data
     * @return string
     */
    public static function json($data)
    {
        return json_encode($data);
    }

}