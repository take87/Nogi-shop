<?php
define('DB_PASS', 'hxp9zWzqzpwXTIvK');

function connect() {
    return new PDO("mysql:host=localhost;dbname=e-shop;charset=utf8","root",DB_PASS);
}

function img_tag($code) {
    if(file_exists("../images/$code.jpg")) {
        $name = $code;
    } else {
        $name = 'noimage';
        return '<img src="../image/' . $name . '.jpg" alt="">';
    }

}
?>