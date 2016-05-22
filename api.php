<?php
require_once('./Config/Config.php');

try {
    $connect = Db::getInstance()->dbConnect();
} catch (Exception $e) {
    return Response::show('1', '数据库连接失败');
}

@$modFile = './api/' .$_REQUEST['mod'].'.php';
if (file_exists($modFile)) {
    require $modFile;
} else {
    return Response::show('3', '该模块不存在');
}