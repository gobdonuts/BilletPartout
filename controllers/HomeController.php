<?php
require_once("./models/Show.php");
require_once("./models/UserAcess.php");

class HomeController extends Controller {
    public static function View($page)
    {
        $show = new Show();
        $enVedette = $show->getAllShow(["id" => "1"])[0];
        $plusVendus = [
            $show->getAllShow(["id" => "2"])[0],
            $show->getAllShow(["id" => "3"])[0],
            $show->getAllShow(["id" => "4"])[0],
        ];
        require_once("./views/home.php");
    }
}
?>