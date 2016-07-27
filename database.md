
## 注意

* 每个 migrations 必须有：$table→timestamps()；
* 文档中字段注释的内容对应：$table→increments('id')→comment(“公司ID”)；
* 其他的内容只是描述而已，不要放到 comment 里；
* down 方法里面：Schema::dropIfExists('tableName');
* 所有金钱都以分为单位

## 文章类别（categories）

字段 | 类型 | 注释 | 其他
---|---|---|---
id | unsigned tiny int | 乘客id | 主键，自增长
name | string, 30 | 类别名称 | NotNull
alias | string, 30 | 类别别名（英文） | NotNull
parent_id | unsigned tiny int | 父类别 | Nullable

## 文章（articles）

字段 | 类型 | 注释 | 其他
---|---|---|---
id | int | 乘客id | 主键，自增长
category_id | unsigned tiny int | 类别id | NotNull
title | string, 50 | 文章标题 | NotNull
summary | string, 200 | 文章摘要 | NotNull
thumbnail | string, 200 | 缩略图 | NotNull
image | string, 200 | 详情大图 | Nullable
content | text| 文章内容 | NotNull
keywords | string, 200 | 关键字（以「,」分割） | Nullable
source | string, 50 | 来源 | Nullable
author | string, 50 | 责任编辑 | NotNull
views | int | 阅读量 | Default(0)
published_at | timestamp | 发布时间 | Nullable
status | unsigned tiny int | 状态（0-创建未审核，1-已审核，2-已发布） | Default(0)

## 视频（videos）
字段 | 类型 | 注释 | 其他
---|---|---|---
id | int | 乘客id | 主键，自增长
category_id | unsigned tiny int | 类别id | NotNull
type | unsigned tiny int | 类型(0-原创、1-转载) | Default(0)
title | string, 50 | 文章标题 | NotNull
summary | string, 200 | 文章摘要 | NotNull
thumbnail | string, 200 | 缩略图 | NotNull
url | string, 300 | 转载视频链接 | Nullable
keywords | string, 200 | 关键字（以「,」分割） | Nullable
source | string, 50 | 来源 | Nullable
author | string, 50 | 责任编辑 | Nullable
views | int | 浏览次数 | Default(0)
recommend | boolean | 是否推荐 | Default(false)
published_at | timestamp | 发布时间 | Nullable
status | unsigned tiny int | 状态（0-创建未审核，1-已审核，2-已发布） | Default(0)

## 视频期数（issues）

字段 | 类型 | 注释 | 其他
---|---|---|---
id | int | 乘客id | 主键，自增长
video_id | int | 视频id | NotNull
name | string, 20 | 期数 | NotNull
summary | string, 200 | 文章摘要 | NotNull
url | string, 300 | 视频链接地址 | NotNull
views | int | 播放次数 | Default(0)
published_at | timestamp | 发布时间 | Nullable
status | unsigned tiny int | 状态（0-创建未审核，1-已审核，2-已发布） | Default(0)

## 首页Banner（banners）

字段 | 类型 | 注释 | 其他
---|---|---|---
id | int | 乘客id | 主键，自增长
target_id | int | 文章或者视频id | NotNull
type | unsigned tiny int | 类型（0-文章、1-视频）| Default(0)
title | string, 50 | 标题 | NotNull
thumb | string, 200 | 缩略图 | NotNull
views | int | 点击次数 | Default(0)
published_at | timestamp | 发布时间 | Nullable
status | unsigned tiny int | 状态（0-创建未审核，1-已审核，2-已发布） | Default(0)

## 广告位（ad_position）

字段 | 类型 | 注释 | 其他
---|---|---|---
id | int | 乘客id | 主键，自增长
name | string | 广告位名称 | NotNull
position | int | 广告位置 | NotNull
published_at | timestamp | 发布时间 | Nullable
status | unsigned tiny int | 状态（0-创建未审核，1-已审核，2-已发布） | Default(0)


## 广告（ads）

字段 | 类型 | 注释 | 其他
---|---|---|---
id | int | 乘客id | 主键，自增长
title | string | 广告标题 | Nullable
thumb | string, 200 | 缩略图 | NotNull
url | string, 300 | 广告链接 | NotNull
views | int | 点击次数 | Default(0)
position_id | int | 广告位id | NotNull
published_at | timestamp | 发布时间 | Nullable
status | unsigned tiny int | 状态（0-创建未审核，1-已审核，2-已发布） | Default(0)


## 友情链接（links）

字段 | 类型 | 注释 | 其他
---|---|---|---
id | int | id | 主键，自增长
title | string,100 | 链接标题 | Nullable
url | string, 300 | 链接 | NotNull
type | int | 类型 | NotNull
status | unsigned tiny int | 状态（0-创建未审核，1-已发布） | Default(0)


## 合作机构（agency）

字段 | 类型 | 注释 | 其他
---|---|---|---
id | int | id | 主键，自增长
title | string,100 | 机构名称 | Nullable
url | string, 300 | 机构网址 | NotNull
status | unsigned tiny int | 状态（0-创建未审核，1-已发布） | Default(0)


