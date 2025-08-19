<?php
$packageDir = __DIR__ . "/package";
if (is_dir($packageDir)) {
    $files = glob($packageDir . "/*.php");
    if ($files !== false) {
        foreach ($files as $file) {
            if (is_file($file)) {
                include_once $file;
            }
        }
    }
}
?>
