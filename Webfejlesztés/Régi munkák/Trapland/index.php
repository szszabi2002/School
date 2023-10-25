<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trapland</title>
    <style>
        * {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        body {
            font-family: Helvetica;
            -webkit-font-smoothing: antialiased;
            background: rgba(71, 147, 227, 1);
        }

        h2 {
            text-align: center;
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: white;
            padding: 30px 0;
        }

        /* Table Styles */

        .table-wrapper {
            margin: 10px 70px 70px;
            box-shadow: 0px 35px 50px rgba(0, 0, 0, 0.2);
        }

        .fl-table {
            border-radius: 5px;
            font-size: 12px;
            font-weight: normal;
            border: none;
            border-collapse: collapse;
            width: 100%;
            max-width: 100%;
            white-space: nowrap;
            background-color: white;
        }

        .fl-table td,
        .fl-table th {
            text-align: center;
            padding: 8px;
        }

        .fl-table td {
            border-right: 1px solid #f8f8f8;
            font-size: 12px;
        }

        .fl-table thead th {
            color: #ffffff;
            background: #4FC3A1;
        }


        .fl-table thead th:nth-child(odd) {
            color: #ffffff;
            background: #324960;
        }

        .fl-table tr:nth-child(even) {
            background: #F8F8F8;
        }

        /* Responsive */

        @media (max-width: 767px) {
            .fl-table {
                display: block;
                width: 100%;
            }

            .table-wrapper:before {
                content: "Scroll horizontally >";
                display: block;
                text-align: right;
                font-size: 11px;
                color: white;
                padding: 0 0 10px;
            }

            .fl-table thead,
            .fl-table tbody,
            .fl-table thead th {
                display: block;
            }

            .fl-table thead th:last-child {
                border-bottom: none;
            }

            .fl-table thead {
                float: left;
            }

            .fl-table tbody {
                width: auto;
                position: relative;
                overflow-x: auto;
            }

            .fl-table td,
            .fl-table th {
                padding: 20px .625em .625em .625em;
                height: 60px;
                vertical-align: middle;
                box-sizing: border-box;
                overflow-x: hidden;
                overflow-y: auto;
                width: 120px;
                font-size: 13px;
                text-overflow: ellipsis;
            }

            .fl-table thead th {
                text-align: left;
                border-bottom: 1px solid #f7f7f9;
            }

            .fl-table tbody tr {
                display: table-cell;
            }

            .fl-table tbody tr:nth-child(odd) {
                background: none;
            }

            .fl-table tr:nth-child(even) {
                background: transparent;
            }

            .fl-table tr td:nth-child(odd) {
                background: #F8F8F8;
                border-right: 1px solid #E6E4E4;
            }

            .fl-table tr td:nth-child(even) {
                border-right: 1px solid #E6E4E4;
            }

            .fl-table tbody td {
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <h2>Trapland Stats</h2>
    <div class="table-wrapper">
        <table class="fl-table">
            <tr>
                <th>ID</th>
                <th>Username</th>
            </tr>
            <?php
            $con = mysqli_connect('localhost', 'id18623828_root', 'L=M\7-dJvYwbe|dv', 'id18623828_trapland');
            //check that connection happened
            if (mysqli_connect_errno()) {
                echo "1: Connection failed"; //error code #1 = connection failed
                exit();
            }
            $sql = "SELECT ID, Username FROM username;";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    $ID = $row["ID"];
                    $Username = $row["Username"];
                    echo "<tr><td>" . $ID . "</td><td>" . $Username . "</td></tr>";
                }
            } else {
                echo "0 results";
            }
            ?>
        </table>
    </div>
    <div class="table-wrapper">
        <table class="fl-table">
            <tr>
                <th>Username</th>
                <th>Level</th>
                <th>Time</th>
                <th>DeathCounter</th>
            </tr>
            <?php
            try {
                $sql1 = "SELECT * FROM stats";
                $result = mysqli_query($con, $sql1);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $username_id = $row["Username_ID"];
                        $level = $row["Level"];
                        $time = $row["Time"];
                        $deathcounter = $row["DeathCounter"];
                        echo "<tr><td>" . $username_id . "</td><td>" . $level . "</td><td>" . $time . "</td><td>" . $deathcounter . "</td></tr>";
                    }
                }
            } catch (Exception $e) {
                echo "Error: " . $e;
            } ?>
        </table>
    </div>
</body>

</html>