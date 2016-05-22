1. 概述
---

BoApi是一套使用php编写，用于手机端APP与服务器端进行数据交互的API程序。支持POST和GET方式请求，并返回JSON或者XML格式的数据。
  

2. 请求说明
---

支持POST和GET请求  
例：http://serverName/api.php?mod=模块&act=功能&format=格式&parameter=参数  

| 参数名 | 必填 | 说明 |
|:--------------:|:-----------:|:----------------:|
| mod | 是 | 模块名，即api文件夹中的文件名称 |
| act | 是 | 功能名称，即mod文件中定义的接口名称 |
| format | 否 | 返回数据的格式（json、xml）。非必填，默认为json |
| parameter | 否 | 根据需求，自定义输入参数 |
  

3. 返回数据
---

公共返回参数

| 名称 | 说明 |
|:--------------:|:-----------:|
| code | 状态码，0成功，其他值失败 |
| node | 状态说明 |
| data | 返回的数据 |
  
失败状态码

| code | node |
|:--------------:|:-----------:|
| 1 | 数据库连接失败 |
| 2 | 暂时未提供该数据格式 |
| 3 | 该模块不存在 |
| 4 | 该接口不存在 |
| 5 | 参数不合法 |
| …… | …… |
  

4. 安装使用
---

后台数据库使用MySQL，打开Config/Config.php文件配置数据库连接信息。
  

5. 示例
---

### 5.1 普通请求

http://serverName/api.php?mod=test&act=base

返回数据  
```json
{
    "code": "0",
    "note": "成功",
    "data": {
        "c1": "1",
        "c2": "2"
    }
}
```
  
### 5.2	返回数组

http://serverName/api.php?mod=test&act=array

返回数据
```json
{
    "code": "0",
    "note": "成功",
    "data": {
        "array": [
            {
                "c1": "1",
                "c2": "2"
            },
            {
                "c1": "11",
                "c2": "22"
            }
        ]
    }
}
```
  
### 5.3	分页请求

http://serverName/api.php?mod=test&act=page&page=1&pagesize=20

返回数据
```json
{
    "code": "0",
    "note": "成功",
    "data": {
        "page": [
            {
                "page": 1,
                "pagesize": 10
            },
            {
                "page": 1,
                "pagesize": 20
            }
        ]
    }
}
```