# PHP-TrieTree
## 这是一个支持中英文混合的PHP的字典树

> 注1：本字典树是在 https://github.com/AbelZhou/PHP-TrieTree 的基础上做了进一步的修改，本想将个人的优化更新push到该仓库，但作者由于客观原因不方便merge我的更改，故重新开了仓库。

> 注2：测试的词库引用了Abel的，谢谢Abel

## 示例
```php
<?php
require "../src/TrieTree.php";


$testArr = array("张三","张四","王五","张大宝","张三四","张氏家族","王二麻子");

$tree = new \Keyword\TrieTree();

foreach ($testArr as $str){
    $tree->append($str);
}

$res = $tree->getTree();

var_dump($res);

$res = $tree->search("有一个叫张三的哥们");
var_dump($res);

$res = $tree->search("我叫李四喜");
var_dump($res);

//删除
$res = $tree->delete("张三");

//删除整棵树 连带“张三”和张三下的“张三四”一并删除
$tree->delete("张三",true);
```

## 使用场景
- 敏感词过滤
- 内链建设

## 性能
test目录下有个1.5w左右的敏感词。
mac下检索耗时2~5毫秒左右
这些敏感词来自网络，不是很全。

- - -

## Aho-Corasick算法优化版（TrieTreeAC.php）
使用AC算法优化版。
### 性能对比(TireTreeAC.php与TrieTree.php比较)

* 测试speedCompare.php
```$xslt
TrieTree SearchTime {3.6691551208496}s
TrieTreeAC SearchTime {3.8403348922729}s

```
`中文情况下（离散度比较大）,与原版差别不大,测试样例还没原版快,真是醉了`

* 测试speedCompareUrl.php
```$xslt
TrieTree SearchTime {0.743901014328}s
TrieTreeAC SearchTime {0.38025712966919}s

```
`英文,数字等（离散度低）的铭感次库,明显优于原版`
