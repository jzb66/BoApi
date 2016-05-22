<?php

class Response
{
    const JSON = 'json';  //定义一个常量，默认返回json格式

    public static function show($code, $note = '', $data = '', $type = self::JSON)
    {
        if (!is_numeric($code)) {
            return '';
        }
        $type = isset($_REQUEST['format']) ? $_REQUEST['format'] : self::JSON;
        if ($type == 'json') {
            self::json($code, $note, $data);
            exit;
        } elseif ($type == 'xml') {
            self::xmlEncode($code, $note, $data);
            exit;
        } else {
            $result = array(
                'code' => 2,
                'note' => "暂时未提供该数据格式",
                'data' => ""
            );
            header('Content-type: application/json');
            echo json_encode($result);
        }
    }

    /**
     * 按json格式封装数据
     * $code 状态码
     * $note 提示信息
     * $data 数据
     */
    public static function json($code, $note = '', $data)
    {
        if (!is_numeric($code)) {
            return '';
        }
        $result = array(
            'code' => $code,
            'note' => $note,
            'data' => $data
        );
        header('Content-type: application/json');
        echo json_encode($result);
        exit;
    }

    /**
     * 按xml格式封装数据
     * $code 状态码
     * $note 提示信息
     * $data 数据
     */
    public static function xmlEncode($code, $note, $data)
    {
        if (!is_numeric($code)) {
            return '';
        }
        $result = array(
            'code' => $code,
            'note' => $note,
            'data' => $data
        );
        header("Content-Type:text/xml");
        $xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
        $xml .= "<root>\n";
        $xml .= self::xmlToEncode($result);
        $xml .= "</root>";
        echo $xml;
    }

    //解析xmlEncode()方法里的$result数组，拼装成xml格式
    public static function xmlToEncode($data)
    {
        $xml = $attr = "";
        foreach ($data as $key => $value) {
            //因为xml节点不能为数字，如果$key是数字的话，就重新定义一个节点名，把该数字作为新节点的id名称
            if (is_numeric($key)) {
                $attr = " id='{$key}'";
                $key = "item";
            } elseif ($attr) {
                $attr = "";
            }
            $xml .= "<{$key}{$attr}>\n";
            //递归方法处理$value数组，如果是数组继续解析，如果不是数组，就直接给值
            $xml .= is_array($value) ? self::xmlToEncode($value) : $value;
            $xml .= "</{$key}>";
        }
        return $xml;
    }
}