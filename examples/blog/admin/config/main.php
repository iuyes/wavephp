<?php
$config = array(
    'projectName'=>'admin',
    'modelName'=>'protected',

    'import'=>array(
        'models.*'
    ),

    'defaultController'=>'site',
    
    'database'=>array(
        'db'=>array(
            'dbhost'        => 'localhost',
            'dbport'        => '3306',
            'dbuser'        => 'root',
            'dbpasswd'      => '',
            'dbname'        => 'wave_blog',
            'dbpconnect'    => 0,
            'dbchart'       => 'utf8'
        )
    ),
    'session'=>array(
        'prefix'            => '',
        'timeout'           => 86400
    )
);
?>