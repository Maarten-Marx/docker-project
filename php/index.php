<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
    $hostname = gethostname();
    echo "<title>$hostname</title>";
    ?>
</head>
<body>
    <?php
    function get_name($conn) {
        $sql = 'SELECT name FROM names limit 1';
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        return $result -> fetch_row()[0];
    }

    try {
        $conn = mysqli_connect("sql:3306", "root", "password", "apache");
        $name = get_name($conn);

        echo "<h1>$name has reached Milestone 1!!!</h1>";
    } catch (Exception $e) {
        echo "<h1>Error: {$e->getMessage()}</h1>";
    }

    echo "<p>Container: <code>$hostname</code></p>";

    mysqli_close($conn);
    ?>
</body>
</html>