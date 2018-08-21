<?php

namespace helpers;

class Helpers
{
    public static function dump()
    {
        ob_start();
        call_user_func_array("var_dump", func_get_args());
        $varDump = "<?php\n" . ob_get_contents() . "?>";
        ob_end_clean();

        ini_set("highlight.comment", "#008000");
        ini_set("highlight.default", "#fa2772");  //fa2772
        ini_set("highlight.html", "#808080");
        ini_set("highlight.keyword", "#cfd0c2");
        ini_set("highlight.string", "#36af90");   //36af90

        $varDump = highlight_string($varDump, true);
        $varDump = str_replace('$lt;?php', '', $varDump);
        $varDump = str_replace('?&gt;', '', $varDump);

        echo "<meta charset='UTF-8'>";
        echo "<pre>";
        echo "<div style='color:#fff; 
                font-family: Monospaced, monospace; 
                background: #282826; 
                font-size: 14px; 
                border: 1px dotted #c0c0c0; 
                padding: 10px'>";
        echo trim($varDump);
        echo "</pre>";
        echo "</div>";
    }
}