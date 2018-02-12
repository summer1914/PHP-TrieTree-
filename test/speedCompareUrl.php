<?php
/**
 * @author: kel <https://github.com/deathkel>
 * @version: 1.0
 * @datetime: 2018/2/12 上午10:14
 */

require "../src/TrieTree.php";
require "../src/TrieTreeAC.php";
ini_set('memory_limit','512M');
$str = file_get_contents("./urls.txt");
$words_arr = explode("\n", $str);

$tree = new \Keyword\TrieTree();

foreach ($words_arr as $str) {
    $tree->addWord($str);
}

$treeOptimize = new \Keyword\TrieTreeAC();

$treeOptimize->buildTrieTree($words_arr);
echo "before build fail Memory" . memory_get_usage() / 1024 / 1024 . "M\n";
$treeOptimize->buildFail();
echo "after build fail Memory" . memory_get_usage() / 1024 / 1024 . "M\n";

$str = <<<EOF
-EOF新华社北京7月28日电;
-008.youyiv.cn12
-008.zhifo231g.cn
-00852555.cn
-00852tm888.com123
-008567.cn
-00ad.3322.org
-00ooll.cn
-00pp00.360yyy.8800.org
-00zzd.2288ty.org
-010246.com
-0102168.com
-010389.cdsom
-01048828.cn
-01058789.com3
-20106658.cn
-01066773.cn
-0108686.cn
-01088218.cn
-03210899.com
-010907921.com
-0109888das.cn
-22010caipiao.com
-010kys.com
-010zgcp.com
-0111152.3322.org
-01324.cna
-01696.com
-022.70o2.cnd
-21023tvb.us
-02lh.infoas
-03.xiezhen.co.cc
-0303.tok77.orgs
-0303.tok88d.com
-0303.tok99.com
EOF;
print_r("str len " . mb_strlen($str) . "\n");

$t1 = microtime(true);

for ($i = 0; $i < 1000; $i++) {
    $tree->search($str);
}

$t2 = microtime(true);

$t3 = microtime(true);

for ($i = 0; $i < 1000; $i++) {
    $treeOptimize->search($str);
}
$t4 = microtime(true);

echo 'TrieTree SearchTime {' . ($t2 - $t1) . '}s' . PHP_EOL;
echo 'TrieTreeAC SearchTime {' . ($t4 - $t3) . '}s' . PHP_EOL;

