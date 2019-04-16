### strpos，stripos(不区分大小写)
查找字符串首次出现的位置
```
( string $haystack , string $needle [, int $offset = 0 ] ) : int
```
### 参数
haystack
在该字符串中查找。

needle
注意 needle 可以是一个单字符或者多字符的字符串。

如果 needle 不是一个字符串，那么它将被转换为整型并被视为字符顺序值。

offset
可选的 offset 参数，从字符此数量的开始位置进行搜索。 如果是负数，就从字符末尾此数量的字符数开始统计。
### 返回值
返回 needle 存在于 haystack 字符串开始的位置(独立于偏移量)。同时注意字符串位置起始于 0，而不是 1。

如果未发现 needle 将返回 FALSE。

### strrpos，strripos(不区分大小写)
计算指定字符串在目标字符串中最后一次出现的位置
```
( string $haystack , string $needle [, int $offset = 0 ] ) : int
```
### 参数
haystack
在该字符串中查找。

needle
注意 needle 可以是一个单字符或者多字符的字符串。

如果 needle 不是一个字符串，那么它将被转换为整型并被视为字符顺序值。

offset
可选的 offset 参数，从字符此数量的开始位置进行搜索。 如果是负数，就从字符末尾此数量的字符数开始统计。
### 返回值
返回 needle 存在于 haystack 字符串开始的位置(独立于偏移量)。同时注意字符串位置起始于 0，而不是 1。

如果未发现 needle 将返回 FALSE。
