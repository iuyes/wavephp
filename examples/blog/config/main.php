<?php
$config = array(
    'import'=>array(
        'models.*'
    ),
    'database'=>array(
        'db'=>array(
            'dbhost'        => 'localhost',
            'dbport'        => '3306',
            'dbuser'        => 'root',
            'dbpasswd'      => '',
            'dbname'        => 'wordpress',
            'dbpconnect'    => 0,
            'dbchart'       => 'utf8'
        ),
        'db2'=>array(
            'dbhost'        => 'localhost',
            'dbport'        => '3306',
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