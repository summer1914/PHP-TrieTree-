<?php
/**
 * @author: kel <https://github.com/deathkel>
 * @version: 1.0
 * @datetime: 2018/2/12 上午10:14
 */

require "../src/TrieTreeAC.php";

$str = file_get_contents("./dict.txt");
$words = explode("\n", $str);
$words_arr = array_filter($words);
unset($words);
$treeOptimize = new \Keyword\TrieTreeAC();
$treeOptimize->buildTrieTree($words_arr);
$treeOptimize->buildFail();

$tree = $treeOptimize->getTree();

$nullCount = 0;
$wrongCount = 0;
function recursiveTestFail(&$tree, &$nullCount, &$wrongCount)
{
    foreach ($tree as $node) {
        if ($node['fail']) {
            if ($node['fail']['value'] != 'root' && $node['value'] != $node['fail']['value']) {
                echo $node['value'] . "->" . $node['fail']['value'] . "fail wrong\n";
                $wrongCount++;
            }
        } else {
            echo $node['value'] . " fail null \n";
            $nullCount++;
        }
        if (!empty($node['child'])) {
            recursiveTestFail($node['child'], $nullCount, $wrongCount);
        }
    }
}

recursiveTestFail($tree['child'], $nullCount, $wrongCount);
echo "fail null count {$nullCount}\n";
echo "fail wrong count {$wrongCount}\n";

if ($nullCount == 0 && $wrongCount == 0) {
    echo "fail point build success\n";
}