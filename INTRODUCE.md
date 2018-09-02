# 智能车项目——服务器接口搭建
在云端购买服务器之后，需要依次进行系统选择(在本项目中选用ubuntu系统)、环境搭建(AMP)、接口项目配置(ThinkphpRestApi)

前期准备
---
#### 服务器连接配置
- 在云服务器的控制台界面找到远程连接，在其中设置远程连接的账号密码(也是在服务器中的账号密码，即`sudo`时候提示输入的密码)  
(---------waiting-------------)     
之后便可以通过ssh进行远程的服务器连接
    - windows下ssh连接工具可以使用X-Shell    
    (------------waiting------------)
    - linux下ssh连接工具可以直接安装ssh命令工具，直接通过命令行终端进行连接  
    (以apt为例)    
    `sudo apt-get install ssh`  
    `ssh account@youripOrdomain` 之后输入密码即可

#### 软件源配置
在云服务器上的Ubuntu系统初次使用一般是没有配置软件源的，需要进行软件源的配置

1) 对source.list文件进行备份
    `sudo cp /etc/apt/sources.list /etc/apt/sources.list_backup`
    
2) 编辑source.list文件，`sudo vi /etc/apt/sources.list`  
(快捷键`i`进行文件编辑，`Esc` 退出编辑状态， 在非编辑状态下`:`进行命令输入，命令`wq` 保存当前修改并退出，`q!`放弃修改并退出)  
将软件源添加到文件中，如阿里云的源：
    ```list
            deb-src http://archive.ubuntu.com/ubuntu xenial main restricted #Added by software-properties
            deb http://mirrors.aliyun.com/ubuntu/ xenial main restricted
            deb-src http://mirrors.aliyun.com/ubuntu/ xenial main restricted multiverse universe #Added by software-properties
            deb http://mirrors.aliyun.com/ubuntu/ xenial-updates main restricted
            deb-src http://mirrors.aliyun.com/ubuntu/ xenial-updates main restricted multiverse universe #Added by software-properties
            deb http://mirrors.aliyun.com/ubuntu/ xenial universe
            deb http://mirrors.aliyun.com/ubuntu/ xenial-updates universe
            deb http://mirrors.aliyun.com/ubuntu/ xenial multiverse
            deb http://mirrors.aliyun.com/ubuntu/ xenial-updates multiverse
            deb http://mirrors.aliyun.com/ubuntu/ xenial-backports main restricted universe multiverse
            deb-src http://mirrors.aliyun.com/ubuntu/ xenial-backports main restricted universe multiverse #Added by software-properties
            deb http://archive.canonical.com/ubuntu xenial partner
            deb-src http://archive.canonical.com/ubuntu xenial partner
            deb http://mirrors.aliyun.com/ubuntu/ xenial-security main restricted
            deb-src http://mirrors.aliyun.com/ubuntu/ xenial-security main restricted multiverse universe #Added by software-properties
            deb http://mirrors.aliyun.com/ubuntu/ xenial-security universe
            deb http://mirrors.aliyun.com/ubuntu/ xenial-security multiverse
    ```
    以上文本可以复制后通过控制台粘贴至编辑状态的`sources.list`文件中，之后`wq`保存退出
    
3) 使修改生效    
    `sudo apt-get update`  更新软件列表   
    `sudo apt-get upgrade` 更新软件

#### ubuntu下环境搭建
在得到云服务器之后需要进行AMP环境搭建
1. Apache服务器搭建，通过`sudo apt-get install apache2` 从Ubuntu软件源下载安装apache服务器，按照提示一路`y`允许安装即可

2. php7.1运行环境安装，`sudo apt-get install -y php7.1 php7.1-mysql php7.1-mcrypt php7.1-curl php7.1-mbstring php7.1-zip php7.1-xml`

3. mysql数据库安装，`sudo apt-get install -y mysql-server`,安装中按照提示配置账号密码即可

4. 配置完成之后，检查apache2相关配置 
`source /etc/apache2/envvars` 导入apache的环境变量
`apache2 -t -D DUMP_MODULES` 查看apache启用的模块是否有php7的相关模块，保证apache的php运行环境，如果没有php模块，需要运行`sudo apt-get install libapache2-mod-php7.1 `安装对应php7.1版本的apache插件

5. php库管理命令`composer`安装，直接将以下命令行copy到ubuntu控制台运行即可，视情况在命令行首添加`sudo`
```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```


#### 导入接口项目
1. `sudo apt-get install git`安装`git` 代码版本管理工具，这里仅用于下载项目代码
2. `cd /var/www/html`定位目录到服务器项目路径下
3. `sudo git clone https://github.com/XuXianTao/thinkphp5.1-restfulapi__custom.git` 将项目拷贝下来,会在该项目路径下生成文件夹`thinkphp5.1-restfulapi__custom`
4. 为了方便，将目录重命名为tp_rest`sudo mv thinkphp5.1-restfulapi__custom tp_rest`
5. 通过命令`ll`或者`ls -la`可以查看当前工作路径下的文件夹
6. `cd tp_rest`进入项目目录下
7. `composer install` 安装项目所需的核心库即可


#### 域名解析配置
1. 在域名交易系统上购买域名yourdomain(本项目域名为chenyt.work)，并在云服务器的控制台中配置域名解析(二级域名api.chenyt.work)，以及进行域名备案等相关工作   
(---------waiting-------------)
2. 定位apache服务器站点配置目录`cd /etc/apache2/sites-available`

3. `sudo cp 000-default.conf yourdomain.conf`拷贝一份新的站点配置文件yourdomain.conf(本项目为api.chenyt.work.conf)，进入编辑`sudo vi yourdomain.conf`

4. `i`进入编辑状态    
    - 去掉ServerName 的注释并修改为购买的域名`yourdomain`(本项目`ServerName api.chenyt.work`)
    - 修改DocumentRoot为 接口项目文件的路径`DocumentRoot /var/www/html/tp_rest/public`
    - 其他不变
    
   `Esc` 退出编辑    
   `:wq` 保存修改并退出    
   
5. `sudo a2ensite yourdomain.conf` 启用刚刚配置的站点

6. `sudo service apache2 reload` 重载apache服务器，使站点生效


#### SSL协议配置
- `sudo vi /etc/apache2/sites-available/yourdomain.conf` 在服务器的站点配置文件中添加监听端口443
    - 证书配置  
    (---------waiting-------------)
    - 将已有的80端口配置内容复制并粘贴，修改监听端口为443，同时添加SSL解析配置，具体文件内容如下
```
<VirtualHost *:80>

        ServerName api.chenyt.work

        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/html/tp_rest/public

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

</VirtualHost>

<VirtualHost *:443>
        ServerName api.chenyt.work

        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/html/tp_rest/public

        SSLEngine on
        SSLCertificateFile /etc/apache2/sites-enabled/api.chenyt.work.crt
        SSLCertificateKeyFile /etc/apache2/sites-enabled/api.chenyt.work.key
    SSLCertificateChainFile /etc/apache2/sites-enabled/root_bundle.crt


        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

</VirtualHost>
```
- 保存修改后退出重启apache2服务即可，`sudo service apache2 reload`

正式使用
---
#### wifi模块
- 数据请求的结构部分请参照README文档进行构建测试
- 以每15ms为周期，将数据打包上传到服务器对应接口，分别上传到以为数据接口与图片接口，且二者请求数据的`gid`请保持一致，每15ms的请求递增一次，而内部的打包数据序号(`list`下的数据键值与图片的键值)则每次都从序号1开始

#### python算法文件
- python相关算法请在项目路径下的`/python_script/compute.py`中完成
- 运算参数已通过json形式的字符串传入，请用`sys.argv[1]`获取并解构得到输入数据,输入数据样例如下
<pre>string(413) "{1:{ccd:132,electric:96,acceleration:90,speed:253},2:{ccd:75,electric:738,acceleration:114,speed:512},3:{ccd:865,electric:666,acceleration:398,speed:909},4:{ccd:485,electric:255,acceleration:44,speed:992},5:{ccd:493,electric:226,acceleration:443,speed:967},6:{ccd:164,electric:367,acceleration:889,speed:439},7:{ccd:632,electric:619,acceleration:366,speed:861},8:{ccd:594,electric:632,acceleration:708,speed:737}}"
</pre>
- 运算结果请保证用单独一个string输出(通过print输出的第一个字符串即是结果)