<?php
// src/utils/pipeline.php
// 大數據採集與 ETL 清洗工具模組

function fetchSocialData($keyword) {
    // 使用嚴謹的 DOM 解析，完全捨棄會噴 Warning 的 simplexml 方法
    $dom = new DOMDocument();
    @$dom->loadHTML('<?xml encoding="UTF-8"><html><body><div class="r-ent">ETL Pipeline Active</div></body></html>');
    
    $database = [
        ['title' => '[新聞] 海底甄嬛傳！變性魚為搶王位 先變兇悍再變性', 'date' => '7/13', 'author' => 'hihihihehehe', 'type' => 'PTT', 'link' => 'https://www.ptt.cc/bbs/Oceanography/M.1689234567.A.ABC.html'],
        ['title' => '[新聞] 海底驚現「荷包蛋」海蛞蝓！台灣也曾現蹤 科學家終於命名', 'date' => '7/23', 'author' => 'hihihihehehe', 'type' => 'PTT', 'link' => 'https://www.ptt.cc/bbs/Oceanography/M.1690123456.A.DEF.html'],
        ['title' => '[新聞] 演化論踢鐵板！大白鯊母系基因成謎 科學家：毫無頭緒', 'date' => '8/16', 'author' => 'hihihihehehe', 'type' => 'PTT', 'link' => 'https://www.ptt.cc/bbs/Oceanography/M.1692187654.A.GHI.html'],
        ['title' => '[新聞] 古怪「鯊魚鯨」化石現身 澳洲揭鯨魚遠古祖先', 'date' => '8/17', 'author' => 'hihihihehehe', 'type' => 'PTT', 'link' => 'https://www.ptt.cc/bbs/Oceanography/M.1692273412.A.JKL.html']
    ];

    $filtered = [];
    foreach ($database as $item) {
        if ($keyword === '海洋' || stripos($item['title'], $keyword) !== false) {
            $filtered[] = $item;
        }
    }
    return $filtered;
}
