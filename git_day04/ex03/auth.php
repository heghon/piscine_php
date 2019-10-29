<?php
function auth($login, $passwd)
{
    if ($login != null && $passwd != null)
    {
        if (!file_exists("../private") || !file_exists("../private/passwd"))
            return (FALSE);
        $data = unserialize(file_get_contents("../private/passwd"));
        foreach($data as $log)
            if ($log["login"] === $login)
                return (($log["passwd"] === hash("whirlpool", $passwd)) ? TRUE : FALSE);
        return(FALSE);
    }
    else
        return(FALSE);
}
?>