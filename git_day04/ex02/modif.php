<?php
if (isset($_POST["submit"]) && $_POST["submit"] === "OK" && isset($_POST["login"]) && isset($_POST["oldpw"]) && isset($_POST["newpw"]))
{
    if (!file_exists("../private") || !file_exists("../private/passwd"))
    {
        echo "ERROR\n";
        exit();
    }
    $data = unserialize(file_get_contents("../private/passwd"));
    foreach($data as $log)
    {
        if ($log["login"] === $_POST["login"])
        {
            if (!($log["passwd"] === hash("whirlpool", $_POST["oldpw"])))
            {
                echo "ERROR\n";
                exit();
            }
            else
            {
                if ($_POST["newpw"] === $_POST["oldpw"])
                {
                    echo "ERROR\n";
                    exit();
                }
                $temp["login"] = $_POST["login"];
                $temp["passwd"] = hash("whirlpool", $_POST["newpw"]);
                $account[] = $temp;
                file_put_contents("../private/passwd", serialize($account));
                echo "OK\n";
                exit();
            }
        }
    }
    echo "ERROR\n";
}
else
    echo "ERROR\n";
?>