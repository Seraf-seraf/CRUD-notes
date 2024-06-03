<?php
function render($template_file, $data = []) {
    if (!file_exists($template_file)) {
        throw new Exception('Template not found');
    }

    ob_start();
    extract($data);
    include $template_file;

    return ob_get_clean();
}
