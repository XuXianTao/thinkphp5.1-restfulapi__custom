# 学习路线
## git
- 目前仅需通过`git clone https://github.com/XuXianTao/thinkphp5.1-restfulapi__custom.git`来下载项目即可
- 后续可以通过`git pull` `git push`等命令行操作(或者通过相关的git ui程序)实现代码上传更新(需要项目负责人拉进成员组才能完成相应操作)

## Thinkphp
项目基于thinkphp5.1
1. 了解项目目录结构

   目录结构参考[手册](https://www.kancloud.cn/manual/thinkphp5_1/353950)，与手册结构一致，在此基础上多了
    + /_mysql文件夹存放数据库结构的sql文件，使用mysql数据库，可以自行查找相关教程，这里涉及的仅是简单的创建工作，使用的是简单的create语句，也可通过`phpmyadmin`第三方实现数据库管理
    + /python_script文件存放算法运算的python文件
    
   此外/runtime文件夹存放了缓存文件，可以按需删除
  
2. 看`README.md`知道项目有哪些接口，参照[文档](https://www.kancloud.cn/manual/thinkphp5_1/353962)知道具体的路由定义

3. 知道控制器定义与路由的关系,控制器定义参考[文档](https://www.kancloud.cn/manual/thinkphp5_1/353979)

   本项目的应用目录为默认的`/application`，模块为`api`，控制器有分级的`/v1`与未分级的其他认证控制器

4. 在理解了thinkphp基础后，可以尝试理解本项目的基础[认证](https://github.com/Leslin/thinkphp5-restfulapi)，理解对应的目录结构的