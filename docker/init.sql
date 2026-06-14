-- docker/init.sql
-- 初始化海洋輿情監測平台之歷史紀錄庫與預警數據表

CREATE DATABASE IF NOT EXISTS marine_sentiment_db;
USE marine_sentiment_db;

-- 建立歷史紀錄資料表
CREATE TABLE IF NOT EXISTS `sentiment_history` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `keyword` VARCHAR(255) NOT NULL COMMENT '使用者查詢關鍵字',
    `search_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '檢索日期時間',
    `title_summary` TEXT NOT NULL COMMENT '社群文章標題摘要',
    `score_positive` INT NOT NULL COMMENT 'AI量化：情緒正向度',
    `score_academic` INT NOT NULL COMMENT 'AI量化：學術研究度',
    `score_trivia` INT NOT NULL COMMENT 'AI量化：冷知識指數',
    `score_practical` INT NOT NULL COMMENT 'AI量化：實用價值度',
    `article_url` VARCHAR(512) NOT NULL COMMENT '真實有效超連結'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 預灌一筆測試數據，確保系統底層運行正常
INSERT INTO `sentiment_history` (`keyword`, `title_summary`, `score_positive`, `score_academic`, `score_trivia`, `score_practical`, `article_url`) 
VALUES ('海洋', '[新聞] 海底驚現「荷包蛋」海蛞蝓！台灣也曾現蹤 科學家終於命名', 62, 85, 78, 42, 'https://www.ptt.cc/bbs/Oceanography/M.1690123456.A.DEF.html');
