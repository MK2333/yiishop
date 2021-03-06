# 1.	项目介绍
##1.1.	项目描述简介
类似京东商城的B2C商城 (C2C B2B O2O P2P ERP进销存 CRM客户关系管理)  
电商或电商类型的服务在目前来看依旧是非常常用，虽然纯电商的创业已经不太容易，但是各个公司都有变现的需要，所以在自身应用中嵌入电商功能是非常普遍的做法。
为了让大家掌握企业开发特点，以及解决问题的能力，我们开发一个电商项目，项目会涉及非常有代表性的功能。  
为了让大家掌握公司协同开发要点，我们使用git管理代码。  
在项目中会使用很多前面的知识，比如架构、维护等等。  
## 1.2.	主要功能模块
系统包括：  
后台：品牌管理、商品分类管理、商品管理、订单管理、系统管理和会员管理六个功能模块。  
前台：首页、商品展示、商品购买、订单管理、在线支付等。  
##1.3.	开发环境和技术
开发环境	Window  
开发工具	Phpstorm+PHP5.6+GIT+Apache  
相关技术	Yii2.0+CDN+jQuery+sphinx  
##1.4.	项目人员组成周期成本  
##1.4.1.	人员组成  
职位	人数	备注  
项目经理和组长	1	一般小公司由项目经理负责管理，中大型公司项目由项目经理或组长负责管理  
开发人员	3	  
UI设计人员	0	
前端开发人员	1	专业前端不是必须的，所以前端开发和UI设计人员可以同一个人  
测试人员	1	有些公司并未有专门的测试人员，测试人员可能由开发人员完成测试。  

公司有测试部，测试部负责所有项目的测试。  

项目测试由产品经理进行业务测试。  

项目中如果有测试，一般都具有Bug管理工具。（介绍某一个款，每个公司Bug管理工具不一样）  
## 1.4.2.	项目周期成本
人数	周期	备注  
1	两周需求及设计	项目经理  


## 1	两周
UI设计	UI/UE  
4（1测试  2后端  1前端）	3个月  
第1周需求设计  
9周时间完成编码  
2周时间进行测试和修复	  

开发人员、测试人员  


#	系统功能模块
## 		需求
品牌管理：  
商品分类管理：  
商品管理:  
账号管理：  
权限管理：  
菜单管理：  
订单管理：  
## 	流程
自动登录流程  
购物车流程  
订单流程  

## 	设计要点（数据库和页面交互）  
系统前后台设计：前台www.yiishop.com 后台admin.yiishop.com 对url地址美化  
商品无限级分类设计：  
购物车设计：  
## 	要点难点及解决方案  
难点在于需要掌握实际工作中，如何分析思考业务功能，如何在已有知识积累的前提下搜索并解决实际问题，抓大放小，融会贯通，尤其要排除畏难情绪。  
# 3.	品牌功能模块  
## 3.1.	需求
品牌管理功能涉及品牌的列表展示、品牌添加、修改、删除功能。  
品牌需要保存缩略图和简介。  
品牌删除使用逻辑删除。  
## 3.2.	流程
### 3.3.	设计要点（数据库和页面交互）
### 3.4.	要点难点及解决方案

1.	删除使用逻辑删除,只改变status属性,不删除记录  
2.	使用uploadify插件,提升用户体验  
3.	使用composer下载和安装uploadify  
4.	composer安装插件报错,解决办法:  
composer global require "fxp/composer-asset-plugin:^1.2.0"  
5.	注册七牛云账号  
  
#2.文章功能模块
 
 ### 需求
 
 文章管理功能涉及品牌的列表展示、文章分类、文章内容分表、文章添加、修改、删除功能
 
 ###流程
 
 ###设计要点（数据库和页面交互）
 
 ###要点难点及解决方案
 
 多模型一起存储
 使用插件，提示用户体验
 使用composer下载安装gethup文件上传插件
   
   #3.商品管理
   ## 需求分析 
   商品管理模块涉及商品的列表展示、商品分类、商品添加、修改、删除功能， 数据连表查询，增加，删除与修改  
~~~
   $this->createTable('goods_day_count', [
               'id' => $this->primaryKey(),
               'day'=>$this->date()->notNull()->comment('日期'),
               'count'=>$this->integer()->comment('条数'),
           ]);
            
            $this->createTable('goods', [
                        'id' => $this->primaryKey(),
                        'name'=>$this->string()->notNull()->comment('商品名'),
                        'sn'=>$this->string()->notNull()->comment('货号'),
                        'logo'=>$this->string()->notNull()->comment('商品logo'),
                        'goods_category_id'=>$this->integer()->notNull()->comment('商品分类'),
                        'brand_id'=>$this->integer()->notNull()->comment('品牌'),
                        'markt_price'=>$this->decimal()->notNull()->comment('市场价格'),
                        'shop_price'=>$this->decimal()->notNull()->comment('本店价格') ,
                        'stock'=>$this->integer()->notNull()->comment('库存'),
                        'is_on_sale'=>$this->integer()->notNull()->comment('是否上线'),
                        'status'=>$this->integer()->notNull()->comment('状态'),
                        'sort'=>$this->integer()->notNull()->comment('排序'),
                        'inputtime'=>$this->integer()->notNull()->comment('添加时间'),
                    ]);
                    
                     $this->createTable('goods_intro', [
                                'id' => $this->primaryKey(),
                                'goods_id'=>$this->integer()->notNull()->comment('商品ID'),
                                'content'=>$this->text()->comment('商品描述'),
                            ]);
                            
                            $this->createTable('goods_gallery', [
                                        'id' => $this->primaryKey(),
                                        'goods_id'=>$this->integer()->notNull()->comment('商品ID'),
                                        'path'=>$this->string()->comment('商品地址'),
                                    ]);
                                    
                                    
~~~
###流程

设计数据库、创建模型、创建控制器、创建视图、填写代码、测试

###设计要点

在github网站上下载插件（富文本编辑器，多文件上传）

###要点难点及解决方案

多文件回显与修改后删除七牛云的图片与数据库的图片
在多文件上传的时候通过循环插入数据库，如果是写在if语句中会被循环判定造成其他bug
统计每天创建商品次数，到一个新的数据表中   

#4.商品分类

##4.1需要

###商品分类的增删除改查
无限级分类
列表展示页需要折叠
###4.2设计要点

利用ztree展示分类 利用nested实现左值右值

###4.3.要点难点及解决方案

ztree插件 进入页面就要展开 点击分类后Js控制value
nested 不能用detelte去删除root节点,要用内置的deleteWithChildren()去删除
健壮性的的时候不能放到自己的子孙节点,这个需要异常捕获
JS字符串比较 lft>clft 改成lft-clft>0


#5.管理员

###5.1需要

管理员的增删改查
管理员登录 自动登录
退出
自己资料修改
编辑的时候密码不要回显,如果没有输入密码,不更改,只有输入了密码才更改密码(场景)
###5.2设计要点

自动登录
###5.3.要点难点及解决方案

要修改配置里user组件里用来实现用户的类 Admin::className();
自己登录要实现接口
自己的资料修改
一般情况下都用username做为用户名字段
8.RBAC权限管理

#6.1 需求

权限的增删改查
###6.2 设计要点

配置authManager 组件
数据迁移
实例化authManager,再做增删改查
###6.3.要点难点及解决方案

权限用过滤器来实现,需要设置全局注入
编辑角色,需要先删除原来所有权限,再执行添加操作  

#7.菜单管理

###7.1需求

菜单的增删改查
两级菜单
###7.2 设计要点

无限级菜单

###7.3.要点难点及解决方案

循环第一级菜单(parent_id=0),再根据当前的id循环出来它的子类(parent_id=id)
#8.前台

###8.1需求

会员注册
会员登录
地址管理
###8.2设计要点

会员注册要短信验证
会员登录要实现自动登录
###8.3要点难点及解决方案

阿里大鱼已和阿里云合并,只能用阿里云的包




