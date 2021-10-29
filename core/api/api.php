<?php

header('Content-Type: application/json');

if (file_exists($core_api = __root.CORE.API.($uri[2]??false).".api.php")) {                                             // определённая api-команда
    try {
        include $core_api;
    } catch (Err $err) {
        $error=(__debug??false)?$err:'fatal';
        exit("{error: \"$error\"}");
    }
} elseif (!($uri[2]??false)) {                                                                                          // API без команды (ping)
    exit('{project: "'.__project.'", version: "'.__version.'", datetime: "'.date("Y-m-d H:i:s").'"}');
} else {                                                                                                                // несуществующая команда API
    exit('{API: "command not found"}');
}
exit;
