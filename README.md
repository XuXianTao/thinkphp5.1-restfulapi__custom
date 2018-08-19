# Thinkphp5.1 Rest API

#### 备注：本项目由[Leslin/thinkphp5-restfulapi](https://github.com/Leslin/thinkphp5-restfulapi) 修改定制化而成
##### 修改部分
- 验证部分的mobile手机号码修改为carid车牌号
- Trait 中的 Send辅助函数添加了header默认值为`['Content-Type' => 'application/json']`,便于返回结果格式化json
- 在Oauth控制器中生成签名前主动去掉了`'appid', 'carid', 'nonce', 'timestamp'` 以外的所有键值


### 使用流程
#### 1. 获取认证token
##### 请求地址`{SERVER}/api/v1/token`
##### 请求方式`POST`
##### 请求参数
- header头部信息

|字段|是否必须|数值|备注|
|:---:|:---:|:---:|---|
|Content-Type|是|application/json|请求参数的类型

- Post内容参数

|字段|是否必须|数值|备注|
|:---:|:---:|:---:|---|
|appid|是|tp5restfultest|请求的应用id
|carid|是|(例如A22232)|以不同车牌号标记不同智能车
|nonce|是|随机数|用于生成token
|timestamp|是|当前时间戳(取高10位)|用于生成token以及确认过期时间
|sign|是|签名|根据url参数进行MD5加密后的签名<br>例如:`appid=tp5restfultest&carid=A22232&nonce=2&timestamp=1534649748&key=123456`<br>进行加密后的MD5值:`2e90aad66c2248c1ca1b7a1d7906249b`<br>其中key的值为请求的应用id对应的appsecret，由用户定义存储在数据库中

##### 请求样例
header参数`Content-Type: application/json`
body请求参数(已知用户appsecret=123456)
```json
{
	"appid" : "tp5restfultest",
	"carid" : "A22232",
	"nonce": "2",
	"timestamp": 1534649748,
	"sign": "2e90aad66c2248c1ca1b7a1d7906249b",
	"sdasd": "Asdasd"
}
```
返回结果
- access_token为访问令牌
- expires_time为过期时间默认为当前时间往后两个小时
- refresh_token为刷新令牌
- refresh_expires_time为刷新令牌的过期时间默认为当前时间往后一个月
```json
{
    "code": 200,
    "message": "success",
    "data": {
        "access_token": "1p9tjKs3NMDSghmV88PB27IaQZ7U1w66",
        "expires_time": 1534663312,
        "refresh_token": "fmUh89LrwylMd2678ePEciDtYo5Cs7V9",
        "refresh_expires_time": 1537248112,
        "client": {
            "uid": 6,
            "carid": "A22232",
            "appid": "tp5restfultest",
            "nonce": "2",
            "timestamp": 1534649748,
            "sign": "2e90aad66c2248c1ca1b7a1d7906249b",
            "sdasd": "Asdasd",
            "version": "v1"
        }
    }
}
```