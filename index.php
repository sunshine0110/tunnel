<?php
include 'dd.php';
$readmePath = "readme.txt"; // Ganti dengan path lokal yang sesuai
$requestedParams = [];

// Menggunakan file_get_contents untuk membaca file dari path lokal
$readmeContent = file_get_contents($readmePath);

if ($readmeContent !== false) {
    $requestedParams = explode("\n", $readmeContent);
    $requestedParams = array_map('trim', $requestedParams);
}

$requestedsitus = isset($_GET["bo"]) ? $_GET["bo"] : "";

$filePath = "lp.html"; // Ganti dengan path lokal yang sesuai

$phpLocation = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

$baseUrl = str_replace("index.php", "", $phpLocation);

if (!empty($requestedsitus) && in_array($requestedsitus, $requestedParams) && !empty($requestedParams[0])) {
    // Menggunakan file_get_contents untuk membaca file dari path lokal
    $filedata = file_get_contents($filePath);

    if ($filedata !== false) {
        $newContent = str_replace("GODA88", strtoupper($requestedsitus), $filedata);
        
        $newContent = str_replace("goda88", strtoupper($requestedsitus), $newContent);
        
        echo $newContent;
    } else {
        echo "gagal get content";
    }
} else {
    if (isset($_GET['get']) && $_GET['get'] === 'sitemap') {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">';

        foreach ($requestedParams as $keyword) {
            $keyword = trim($keyword);
            if (!empty($keyword)) {
                $urlWithParam = rtrim($baseUrl, '/') . '/?bo=' . urlencode($keyword);
                $lastmod = date('c'); 
                $xml .= "\n\t<url>\n\t\t<loc>$urlWithParam</loc>\n\t\t<lastmod>$lastmod</lastmod>\n\t</url>";
            }
        }

        $xml .= "\n</urlset>";


        $sitemapPath = 'sitemap.xml';
        file_put_contents($sitemapPath, $xml);

        echo '<p>Sitemap telah berhasil dibuat</p>';
    } else if (isset($_GET['get']) && $_GET['get'] === 'sitemap2') {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">';

        foreach ($requestedParams as $keyword) {
            $keyword = trim($keyword);
            if (!empty($keyword)) {
                $urlWithParam = rtrim($baseUrl, '/') . '/' . urlencode($keyword);
                $lastmod = date('c'); 
                $xml .= "\n\t<url>\n\t\t<loc>$urlWithParam</loc>\n\t\t<lastmod>$lastmod</lastmod>\n\t</url>";
            }
        }

        $xml .= "\n</urlset>";


        $sitemapPath = 'sitemap.xml';
        file_put_contents($sitemapPath, $xml);

        echo '<p>Sitemap kedua telah berhasil dibuat</p>';
    } else if (isset($_GET['get']) && $_GET['get'] === 'google') {
        $value = 'google';
        $file_name = $value . '87618203b2b36fbc.html';
        $content = "google-site-verification: {$file_name}";

        // Menggunakan path lokal untuk menyimpan file HTML
        if (file_put_contents($file_name, $content) === false) {
            die("Gagal membuat file HTML.");
        } else {
            echo '<p>google verif berhasil di letakan</p>';
        }
    } else if (isset($_GET['get']) && $_GET['get'] === 'folder') {
        foreach ($requestedParams as $folderName) {
            $folderName = trim($folderName);
            if (!empty($folderName)) {
                if (!file_exists($folderName)) {
                    mkdir($folderName);
                    echo "Folder \"$folderName\" berhasil dibuat.<br>";
                } else {
                    echo "Folder \"$folderName\" sudah ada.<br>";
                }
            }
        }
    } else if (isset($_GET['get']) && $_GET['get'] === 'input') {
        $filename = $filePath;
        $file_content = file_get_contents($filename);

        $readme_url = $readmePath;
        $readme_content = file_get_contents($readme_url);

        $folder_names = explode("\n", $readme_content);

        foreach ($folder_names as $folder_name) {
            $folder_name = trim($folder_name); 
            if (!empty($folder_name)) {
                $folder_name_uppercase = strtoupper($folder_name);
                $folder_content = str_replace("GODA88", $folder_name_uppercase, $file_content);
                $folder_content = str_replace("goda88", $folder_name_uppercase, $folder_content);
                $html_filename = "lp.html"; // Ganti dengan path lokal yang sesuai
                file_put_contents($html_filename, $folder_content);
                echo "File \"$html_filename\" telah disimpan.<br>";
            }
        }
    } else {
            $lpContent = file_get_contents("lp.html");
    if ($lpContent !== false) {
        header('Content-Type: text/html');
        echo $lpContent;
        } else {
            echo "gagal get content";
        }
    }
}
?>
