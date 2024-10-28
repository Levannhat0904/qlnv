 <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include('department/info_employee.php');
    $command = "cd /Applications/XAMPP/xamppfiles/htdocs/qlvn/spark/department/ && /usr/local/spark/bin/spark-submit scr.py 2>&1";
    $output = shell_exec($command);
    echo "<pre>$output</pre>";
    include('department/data_analysis_json.php');


    ?>
