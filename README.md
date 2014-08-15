#豆瓣一刻web版 1.0.0

##写在前面：
>豆瓣一刻推送的文章还是不错的，可惜没有PC端的（虽说这样可能违背了这个app的初衷），但像知乎日报不也有了，所以打算自己写一个，顺便把之前接触的cURL练练手。


###详细的信息
来自：[我滴Github项目页面](https://github.com/MapleShaw/dbMoment)

###备注
有些文章没有作者和头像
猜测，文章的ID从100000开始，截至2014.07.18，最大数为103148
每天19篇
豆瓣本身比较坑爹的问题，使用curl的时候有时候会出现403，但是直接访问页面正常，google了很久都没能解决，因为一开始以为是curl的问题，后来尝试百度其他网页都没问题才定位到豆瓣，加了代理，done！
[php curl函数应用方法](http://blog.csdn.net/eroswang/article/details/3426375)

###待解决问题
  *   客户端：目前存放数据的data.js是单独一个文件，随着日积月累肯定会很大，页面每次加载不能总是加载整个js，所以需要分割按需加载
  *   服务端：每天自动爬数据，以前爬过的当然没必要重新爬。
  *   思路：
      爬的时候从最近一次的最后一个id加1开始，爬100+，记录能够爬到的最后一个id，下一次备用。（观察到豆瓣一刻是以天为单位更新的）爬到的数据存入数组作为一个data.js。

###更新（2014/08/05）
   * 目前还是找不到他的更新规律，顺序上没办法更app一致，但能保证最新
   * 按需扒取已实现，用持续100次没有文章来作为扒取的分界线
   * 由于需要获取最新文章的id，目前getData.php文件只能在本地跑

###更新（2014/08/11）
   * 展示顺序改为从最近的开始
   * 估计app的更新速度为每天20篇，所以写了个cutDataJs.php把之前的大文件按20一个js分割，命名加上序号
   * 创建一个txt文档记录最新的文章ID号

###更新（2014/08/12）
   * txt文档修改为js格式文件，方便main.js通过ajax读取
   * 写入数据js文件和记录最新信息封装成独立函数，并设置标致判断是否需要对记录文件操作
   * 对sqlData里面的数据文件做无缝优化，即判断最新js文件内容，看看是否需要补全还是另外新建js
   * cutDataJs.php只作为临时性脚本，对以前扒取的数据进行分割，可不用理会
   * 遗留问题：搬到服务器上并加上自动运行脚本

###阶段性更新（2014/08/15）
  * 自己的服务器比较坑爹，自动跑脚本被限制了，最后只能本地手动跑，然后同步到服务器
  * 美国的服务器，访问起来有点慢
  * 优化待爬取文章数量超过20后不会自动分割
  * 放到服务器之后，图片有些没办法加载，显示403拒绝访问，但是把图片链接单独打开没问题
  * runTheScript.bat只是执行脚本，原本还考虑设置成开机执行一次
  * 待优化：搜索功能，分类功能