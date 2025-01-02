<?php
echo "<h2>PHP Settings Test</h2>";
echo "<pre>";
echo "Memory Limit: " . ini_get('memory_limit') . "\n";
echo "Max Execution Time: " . ini_get('max_execution_time') . "\n";
echo "Upload Max Filesize: " . ini_get('upload_max_filesize') . "\n";
echo "Post Max Size: " . ini_get('post_max_size') . "\n";
echo "Display Errors: " . ini_get('display_errors') . "\n";
echo "Error Reporting: " . ini_get('error_reporting') . "\n";
echo "Session Cookie HTTPOnly: " . ini_get('session.cookie_httponly') . "\n";
echo "Session Cookie Secure: " . ini_get('session.cookie_secure') . "\n";
echo "Timezone: " . ini_get('date.timezone') . "\n";
echo "Allow URL fopen: " . ini_get('allow_url_fopen') . "\n";
echo "Output Buffering: " . ini_get('output_buffering') . "\n";
echo "MySQL Connect Timeout: " . ini_get('mysql.connect_timeout') . "\n";
echo "</pre>"; 