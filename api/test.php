<?php
$action = $_REQUEST['act'];
switch ($action) {
    // 普通请求
    case 'base':
        $sql = "select '1' as 'c1','2' as 'c2' from dual";
        $query = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($query);
        if (empty($data)) {
            return Response::show('100', '失败');
        }
        return Response::show('0', '成功', $data);
        break;

    // 返回数组
    case 'array':
        $array1 = array(
            "c1" => "1",
            "c2" => "2"
        );
        $array2 = array(
            "c1" => "11",
            "c2" => "22"
        );
        $data = array(
            "array" => array($array1, $array2)
        );
        if (empty($data)) {
            return Response::show('100', '失败');
        }
        return Response::show('0', '成功', $data);
        break;

    // 分页
    case 'page':
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;  //当前页码
        $pagesize = isset($_REQUEST['pagesize']) ? $_REQUEST['pagesize'] : 10; //每页显示的数量
        if (!is_numeric($page) || !is_numeric($pagesize)) {
            return Response::show('5', '参数不合法');
        }
        $array1 = array(
            "page" => 1,
            "pagesize" => 10
        );
        $array2 = array(
            "page" => (int)$page,
            "pagesize" => (int)$pagesize
        );
        $data = array(
            "page" => array($array1, $array2)
        );
        if (empty($data)) {
            return Response::show('100', '失败');
        }
        return Response::show('0', '成功', $data);
        break;

    default:
        return Response::show('4', '该接口不存在');
}