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
    # Function to get my name from the database; takes a connection, returns a name.
    function get_name($conn) {
        # Prepare the sql query and execute it.
        $sql = 'SELECT name FROM names limit 1';
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_execute($stmt);

        # Get the resulting name and return it.
        $result = mysqli_stmt_get_result($stmt);
        return $result -> fetch_row()[0];
    }

    try {
        # Connect to the remote database and get the name from it, then show it on the web page.
        $conn = mysqli_connect("sql:3306", "root", "password", "apache");
        $name = get_name($conn);

        echo "<h1>$name has reached Milestone 1!!!</h1>";
    } catch (Exception $e) {
        # show any errors.
        echo "<h1>Error: {$e->getMessage()}</h1>";
    }

    # Show the container's hostname on the web page.
    echo "<p>Container: <code>$hostname</code></p>";

    # Close the connection to the database.
    mysqli_close($conn);
    ?>
</body>
</html>