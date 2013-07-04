<?php
$config = array(
    'import'=>array(
        'models.*',
        'zabbix.*'
    ),
    'database'=>array(
        'db'=>array(
            'dbhost'        => 'localhost',
            'dbuser'        => 'root',
            'dbpasswd'      => '',
            'dbname'        => 'wordpress',
            'dbpconnect'    => 0,
            'dbchart'       => 'utf8'
        ),
        'db2'=>array(
            'dbhost'        => 'localhost',
            'dbuser'        => 'root',
            'dbpasswd'      => '',
            'dbname'        => 'joke',
            'dbpconnect'    => 0,
            'dbchart'       => 'utf8'
        )
    ),
    'session'=>array(
        'timeout'           => 86400
    )
);
?>