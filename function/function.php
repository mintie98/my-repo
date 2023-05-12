<?php
class Title
{
    // プロパティ
    public static $title ;
    //  メソッド
    function setTitle($title) {
        // $this->title = $title;
        Title::$title = $title;
    }
}