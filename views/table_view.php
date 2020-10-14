<html>
<head>
    <link rel="Stylesheets" href="static/style.css"/>
<style type="text/css">
    body {
        font: 16px Roboto, Arial, Helvetica, Sans-serif;
    }
    td, th {
        padding: 4px 8px;
    }
    th {
        background: #eee;
        font-weight: 500;
    }
    tr:nth-child(odd) {
        background: #f4f4f4;
    }
</style>
</head>
<body>
    <table>
    <tr>
    <?php
    if(empty($data)){
        echo "No data Found";
    }else{
        foreach($headings as $heading){
            echo "<td>$heading</td>";
        }
    }

?>


    </tr>

    <?php
foreach($data as $row){
    echo "<tr>";
foreach($row as $key=>$value){

    echo "<td> $value </td>";
}
    echo "</tr>";

}
?>
    </table>
</body>
</html>