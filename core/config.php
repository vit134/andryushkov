<?php
    define('SITE_PATH', realpath(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR);

    function getMysqlFieldType($type) {
        $mysql_data_type = array(
            'tinyint' => 1,
            'smallint' => 2,
            'int' => 3,
            'float'=> 4,
            'double'=> 5,
            'timestamp'=> 7,
            'bigint'=> 8,
            'mediumint'=> 9,
            'date'=> 10,
            'time'=> 11,
            'datetime'=> 12,
            'year'=> 13,
            'bit'=> 16,
            'varchar'=> 253,
            'char'=> 254,
            'decimal'=> 246
        );

        return array_search($type, $mysql_data_type);
    }
?>