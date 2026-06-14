<?php
// src/app/index.php
// 核心網頁互動看板模組 - 整合既有專案目錄架構
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>輿情監測與分析平台</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; margin: 40px; background-color: #f4f7f9; }
        .container { max-width: 1200px; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .progress-container { width: 100%; background-color: #e2e8f0; border-radius: 8px; height: 12px; margin-top: 4px; }
        .progress-bar { height: 100%; border-radius: 8px; transition: width 0.5s; }
        .bg-positive { background-color: #10b981; }
        .bg-academic { background-color: #3b82f6; }
        .bg-trivia { background-color: #a855f7; }
        .bg-practical { background-color: #f97316; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #cbd5e1; padding: 10px; font-size: 13px; }
        th { background: #1e3d59; color: white; }
    </style>
</head>
<body>
<div class="container">
    <h2>🐋 基於 Docker 容器化技術之社群媒體輿情情緒監測與分析平台</h2>
    <form method="GET">
        <input type="text" name="keyword" placeholder="輸入海洋監測關鍵字..." value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '海洋'; ?>" style="padding: 10px; width: 300px; border-radius:4px; border:1px solid #ccc;">
        <button type="submit" style="padding: 10px 20px; background: #0066cc; color: white; border: none; border-radius: 4px; cursor: pointer;">開始全網分析</button>
    </form>

    <?php
    if (isset($_GET['keyword'])) {
        // 精準跨目錄調用組員 B (utils) 與組員 C (analysis) 的模組
        include_once '../utils/pipeline.php';
        include_once '../analysis/sentiment_model.php';

        $keyword = trim($_GET['keyword']);
        $rawData = fetchSocialData($keyword); 
        $analyzedData = analyzeMultiDimension($rawData); 

        echo "<h3>🎯 關鍵字「".htmlspecialchars($keyword)."」監測報告：</h3>";
        echo "<table><tr><th>來源平台</th><th>討論看板</th><th>發文日期</th><th>作者</th><th>真實文章標題（點擊直達）</th><th>情緒正向度</th><th>學術研究度</th><th>冷知識指數</th><th>實用價值度</th></tr>";

        foreach ($analyzedData as $row) {
            echo "<tr>";
            echo "<td><span style='background:#cc0000;color:white;padding:2px 6px;border-radius:4px;font-size:11px;'>{$row['type']}</span></td>";
            echo "<td>Oceanography板</td><td>{$row['date']}</td><td>{$row['author']}</td>";
            echo "<td><a href='{$row['link']}' target='_blank' style='color:#0066cc;text-decoration:none;'>🔗 " . htmlspecialchars($row['title']) . "</a></td>";
            
            foreach (['positive' => 'bg-positive', 'academic' => 'bg-academic', 'trivia' => 'bg-trivia', 'practical' => 'bg-practical'] as $key => $color) {
                echo "<td><strong>{$row['scores'][$key]}%</strong><div class='progress-container'><div class='progress-bar {$color}' style='width: {$row['scores'][$key]}%'></div></div></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
</div>
</body>
</html>
