前言
---
开发这款工具的初衷是为了辅助自己的工作，提供自己日常工作的效率，自己使用了一段时间下来觉得很有用，于是完善之后开源。如今已经开源近2年，第一个版本是在2020年9月份开源，收获了390个star，后来持续收集到不少的建议，持续完善版本。

上一个版本是一个开源的可以用于商业运营的版本，但是代码简单、BUG多、安全问题也很多。有非常多的功能，深受一些用户的喜欢，例如 **`活动码、付费进群插件`** 等。总觉得做得太大没必要，维护也不容易，所以不打算维护上一个版本。


所以新开了一个项目并且正式更名为 **`引流宝`**，重构代码，版本号为1.0.0开始。之前的名字是 **`活码管理系统`**，我认为这个东西不应该叫做系统，系统没有这么简单粗糙，这只能简单理解为一个网页小工具。这个项目相对于上一个版本，砍掉了很多东西，很多用户表示非常遗憾，但是没有办法，一些功能我暂时没有那个想法了。


这是一个 **`开源的、免费的、便于协助自己、他人，`** 进行微信私域流量资源获取的工具，更有效率地开展营销推广活动！降低运营成本，提高工作效率，获取更多资源。

目前还是主要在活码方面发挥一些作用，但是已经有了更多的想法，会逐渐以 **`“引流”`** 为中心去开发各种有助于提高引流效率的小功能。

技术要点
---
做这个东西没有技术可言，太简单了，有手就行。因为这是简单的CURD了，不敢吹嘘这是用了什么牛逼技术。其实使用的是Jquery操作Dom，PHP做CURD来实现创建、编辑、删除、分享、更新等基本操作，HTML+CSS传统的网页布局。

~~没有使用主流的Vue框架，也没有使用大企业喜欢的React框架，不需要学习任何的包管理、项目构建、编译、打包、路由管理~~等知识，因为我也不喜欢这些（虽然我自己也在用Vue）。但是我的项目也是为了照顾技术基础较差，甚至是建站基础较差的菜鸟级用户的。

界面
---
![](https://d1.faiusr.com/4/AAEIABAEGAAggIKSnAYouLrKpAUwsgo4jwc.png)
![](https://d1.faiusr.com/4/AAEIABAEGAAgp4KSnAYo6JeVeDCnCjiXBw.png)
![](https://d1.faiusr.com/4/AAEIABAEGAAgr4KSnAYouOjIugQwrwo4nQc.png)
![](https://d1.faiusr.com/4/AAEIABAEGAAgtYKSnAYokLWoqwQwqwo4lAc.png)
![](https://d1.faiusr.com/4/AAEIABAEGAAgu4KSnAYohuHsoAYwpQo4jQc.png)

主要功能
---
#### 首页
1. 查看群活码、客服码、渠道码当天总访问量
2. 查看成员账号个数
3. 查看群活码、客服码、渠道码当天各时段访问量

#### 群活码
1. 创建、编辑、删除、分享群活码
2. 查看群活码访问量、各群访问量、到阈值自动切换下一个群
3. 去重功能、入口域名、落地域名、短链域名、生成短链接
4. 显示/隐藏客服入口，显示/隐藏顶部扫码安全提示
5. 重置二维码扫码数据（阈值、访问量均可重置）

#### 客服码
1. 创建、编辑、删除、分享客服码
2. 查看客服码访问量、各客服访问量、到阈值自动切换下一个群
3. 2种循环模式、入口域名、落地域名、短链域名、生成短链接
4. 显示/隐藏顶部扫码安全提示，显示/隐藏在线状态
5. 重置二维码扫码数据（阈值、访问量均可重置）

#### 渠道码
1. 创建、编辑、删除、分享渠道码
2. 查看渠道码访问量、各渠道访问量、来源APP和设备、IP地址、时间
3. 入口域名、落地域名、短链域名、生成短链接
4. 可将IP地址加入黑名单

#### 短网址
1. 创建、编辑、删除短网址
2. 查看短网址访问量、各时段访问量
3. 可设置入口域名、中转域名、短链域名
4. 提供开放API，可设置ApiKey和设置请求白名单IP，有开发文档和示例代码
5. 可对短网址设置访问限制，例如仅限微信内访问，仅限Android手机访问等

#### 淘宝客
1. 创建、编辑、删除、分享中间页
2. 查看中间页访问量、淘口令复制次数
3. 可设置入口域名、落地域名、短链域名、生成短链接
4. 可一键转链，一键自动解析填写商品信息

阈值
---
阈值就是扫码次数（访问量）的最大值，你设置阈值为200，即群活码页面被扫码200次，就达到了阈值，如果你还上传了另外一个二维码，此时就会被自动切换到下一个二维码展示给用户。

如果还没到阈值，那么就按照顺序展示第一个，到了阈值，第一个就不会被展示，就会轮到第二个展示。

如下图所示，序号2的阈值是200，访问量为107，那么还没达到阈值，此时别人扫描你的群活码，展示的就是序号2的微信群二维码，如果访问量达到了200，就会被自动切换为序号3的微信群二维码，如果序号3此时停用，则不会展示序号3，将会跳过继续检索下面的，根据下方截图可知，序号2以下只有序号9是正常开启，并且访问量小于阈值的，当序号2访问量达到了200，就会展示序号9的二维码。如果都没有，那么就不显示任何二维码。

![](https://d1.faiusr.com/4/AAEIABAEGAAgwIOSnAYo_c2N4gEwlwY4nAQ.png)

入口、落地、短链域名的区别和用途
---
#### 1、入口域名
入口域名，顾名思义就是创建活码的时候，用于生成二维码的链接使用的域名，用户扫描的二维码后进行跳转就是使用入口域名。简单来说，二维码解析出来是一个链接，这个链接使用的域名就是入口域名。

#### 2、落地域名
落地域名，顾名思义就是用户扫码后展示的页面，这个页面的链接所使用的域名就是落地域名。落地就是落地页的意思，就是最终呈现给用户的那个页面就是落地页。那么扫描活码后，自然就是跳转到落地页。

#### 3、短链域名
短链域名，顾名思义就是短链接（短网址）使用的域名。在我们当前版本的引流宝当中，我们直接就生成短链接，便于推广。

源码下载
---
https://github.com/likeyun/liKeYun_Huoma

使用指南
---
https://docs.qq.com/doc/DREdWVGJxeFFOSFhI

作者
---
TANKING
