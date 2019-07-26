<?php
	date_default_timezone_set('UTC');
    date_default_timezone_set("America/El_Salvador");
    function like_match($pattern, $subject)
    {
        $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
        return (bool) preg_match("/^{$pattern}$/i", $subject);
    }
?>