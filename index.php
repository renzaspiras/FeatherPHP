<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Web Title</title>
</head>
    <body>

    				<?php
        // Config Manager
        $configs = ["head-package", "env"];
        foreach ($configs as $i) {
            $config_file = "./config/{$i}.php";
            if (file_exists($config_file)) {
                require $config_file;
            }
        }

        $request_uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

        // This is the router engine
        $page_directory = "./pages";

        // Handle root path directly
        if ($request_uri === "/") {
            $index_file = $page_directory . "/index/index.php";
            if (file_exists($index_file)) {
                include $index_file;
                exit();
            }
        } else {
            // Extract folder name directly from URI
            $folder = ltrim($request_uri, "/");
            // Only check if it contains no additional slashes (single level)
            if (strpos($folder, "/") === false) {
                $index_file = $page_directory . "/" . $folder . "/index.php";
                if (file_exists($index_file)) {
                    include $index_file;
                    exit();
                }
            }
        }

        // 404 fallback
        $not_found_file = $page_directory . "/404/index.php";
        if (file_exists($not_found_file)) {
            include $not_found_file;
        }
        ?>
    </body>
</html>
