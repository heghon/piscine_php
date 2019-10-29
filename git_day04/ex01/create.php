<?php
if (isset($_POST["submit"]) && $_POST["submit"] === "OK" && isset($_POST["login"]) && isset($_POST["passwd"]))
{
    if (!file_exists("../private"))
        mkdir("../private");
    if (!file_exists("../private/passwd"))
        file_put_contents("../private/passwd", null);
    $data = unserialize(file_get_contents("../private/passwd"));
    if ($data != null)
    {
        foreach($data as $log)
        {
            if ($log["login"] === $_POST["login"])
                {
                    echo "ERROR\n";
                    exit();
                }
        }
    }
    $temp["login"] = $_POST["login"];
    $temp["passwd"] = hash("whirlpool", $_POST["passwd"]);
    $account[] = $temp;
    file_put_contents("../private/passwd", serialize($account));
    echo "OK\n";
}
else
    echo "ERROR\n";
?>