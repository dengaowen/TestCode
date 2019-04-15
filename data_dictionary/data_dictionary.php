<?php
/**
 * 生成mysql数据字典
 */
header("Content-type: text/html; charset=utf-8");
//配置数据库
$dbserver = "47.100.4.153";
$dbusername = "virtlab";
$dbpassword = "mRwEpkaXwbsZyaxR";
$database = "virtlab";

//其他配置
$mysql_conn = @mysqli_connect("$dbserver", "$dbusername", "$dbpassword") or die("Mysql connect is error.");
mysqli_select_db($mysql_conn, $database);
mysqli_query($mysql_conn, 'SET NAMES utf8');
$table_result = mysqli_query($mysql_conn, 'show tables');

$no_show_table = array(
    '(del)vr_experiment_quote',
    '(del)vr_teach_course',
    '(del)vr_teacher_collect',
    '(del)vr_term',
    '(del)vr_type'
);    //不需要显示的表
$no_show_field = array();   //不需要显示的字段

//取得所有的表名
while ($row = mysqli_fetch_array($table_result)) {
    if (!in_array($row[0], $no_show_table)) {
        $tables[]['TABLE_NAME'] = $row[0];
    }
}
//替换所以表的表前缀
//if($_GET['prefix']){
//	$prefix = 'czzj';
//	foreach($tables as $key => $val){
//		$tableName = $val['TABLE_NAME'];
//		$string = explode('_',$tableName);
//		if($string[0] != $prefix){
//			$string[0] = $prefix;
//			$newTableName = implode('_', $string);
//			mysqli_query('rename table '.$tableName.' TO '.$newTableName);
//		}
//	}
//	echo "替换成功！";exit();
//}

//循环取得所有表的备注及表中列消息
foreach ($tables as $k => $v) {
    $sql = 'SELECT * FROM';
    $sql .= ' INFORMATION_SCHEMA.TABLES ';
    $sql .= 'WHERE ';
    $sql .= "table_name = '{$v['TABLE_NAME']}'  AND table_schema = '{$database}'";
    $table_result = mysqli_query($mysql_conn, $sql);
    while ($t = mysqli_fetch_array($table_result)) {
        $tables[$k]['TABLE_COMMENT'] = $t['TABLE_COMMENT'];
    }

    $sql = 'SELECT * FROM';
    $sql .= ' INFORMATION_SCHEMA.COLUMNS ';
    $sql .= 'WHERE ';
    $sql .= "table_name = '{$v['TABLE_NAME']}' AND table_schema = '{$database}'";

    $fields = array();
    $field_result = mysqli_query($mysql_conn, $sql);
    while ($t = mysqli_fetch_array($field_result)) {
        $fields[] = $t;
    }
    $tables[$k]['COLUMN'] = $fields;
}
mysqli_close($mysql_conn);


$html = '';
//循环所有表

foreach ($tables as $k => $v) {
    $html .= '	<h3>' . ($k + 1) . '、' . $v['TABLE_COMMENT'] . '  （' . $v['TABLE_NAME'] . '）</h3>' . "\n";
    $html .= '	<table border="1" cellspacing="0" cellpadding="0" width="100%">' . "\n";
    $html .= '		<tbody>' . "\n";
    $html .= '			<tr>' . "\n";
    $html .= '				<th>字段名</th>' . "\n";
    $html .= '				<th>数据类型</th>' . "\n";
    $html .= '				<th>默认值</th>' . "\n";
    $html .= '				<th>允许非空</th>' . "\n";
    $html .= '				<th>主键</th>' . "\n";
    $html .= '				<th>自动递增</th>' . "\n";
    $html .= '				<th>备注</th>' . "\n";
    $html .= '			</tr>' . "\n";


    foreach ($v['COLUMN'] as $f) {


        $html .= '			<tr>' . "\n";
        $html .= '				<td class="c1">' . $f['COLUMN_NAME'] . '</td>' . "\n";
        $html .= '				<td class="c2">' . $f['COLUMN_TYPE'] . '</td>' . "\n";
        $html .= '				<td class="c3">' . $f['COLUMN_DEFAULT'] . '</td>' . "\n";
        $html .= '				<td class="c4">' . $f['IS_NULLABLE'] . '</td>' . "\n";
        $html .= '				<td class="c5">' . ($f['COLUMN_KEY'] == 'PRI' ? '是' : '&nbsp;') . '</td>' . "\n";
        $html .= '				<td class="c5">' . ($f['EXTRA'] == 'auto_increment' ? '是' : '&nbsp;') . '</td>' . "\n";
        $html .= '				<td class="c6">' . $f['COLUMN_COMMENT'] . '</td>' . "\n";
        $html .= '			</tr>' . "\n";

    }
    $html .= '		</tbody>' . "\n";
    $html .= '	</table>' . "\n";

}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>数据库数据字典生成代码</title>
    <meta name="generator" content="ThinkDb V1.0"/>
    <meta name="author" content="南昌腾速科技有限公司http://www.tensent.cn"/>
    <meta name="copyright" content="2008-2014 Tensent Inc."/>
    <style>
        body, td, th {
            font-family: "微软雅黑";
            font-size: 14px;
        }

        .warp {
            margin: auto;
            width: 900px;
        }

        .warp h3 {
            margin: 0px;
            padding: 0px;
            line-height: 30px;
            margin-top: 10px;
        }

        table {
            border-collapse: collapse;
            border: 1px solid #CCC;
            background: #efefef;
        }

        table th {
            text-align: left;
            font-weight: bold;
            height: 26px;
            line-height: 26px;
            font-size: 14px;
            text-align: center;
            border: 1px solid #CCC;
            padding: 5px;
        }

        table td {
            height: 20px;
            font-size: 14px;
            border: 1px solid #CCC;
            background-color: #fff;
            padding: 5px;
        }

        .c1 {
            width: 120px;
        }

        .c2 {
            width: 120px;
        }

        .c3 {
            width: 150px;
        }

        .c4 {
            width: 80px;
            text-align: center;
        }

        .c5 {
            width: 80px;
            text-align: center;
        }

        .c6 {
            width: 270px;
        }
    </style>
</head>
<body>
<div class="warp">
    <h1 style="text-align:center;">数据库数据字典生成代码</h1>
    <?php echo $html; ?>
</div>
</body>
</html>