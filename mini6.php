<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve data from POST request
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $book = $_POST['book'];
    $os = $_POST['os'];

    // Format the data as a CSV row
    $csv_row = $first_name . "," . $last_name . "," . $email . "," . $phone . "," . $book . "," . $os . "\n";

    // Append the CSV row to the file 'mini6.csv'
    file_put_contents('mini6.csv', $csv_row, FILE_APPEND);
}

// Begin HTML output
echo '<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
      </style>';

// Check if the file exists and is not empty
if (file_exists('mini6.csv') && filesize('mini6.csv') > 0) {
    // Read CSV file
    $rows = file('mini6.csv', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    echo '<table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Book</th>
                <th>OS</th>
            </tr>';

    foreach ($rows as $row) {
        // Split the CSV row into its components
        list($fname, $lname, $email, $phone, $book, $os) = explode(',', $row);
        echo "<tr>
                <td>$fname</td>
                <td>$lname</td>
                <td>$email</td>
                <td>$phone</td>
                <td>$book</td>
                <td>$os</td>
              </tr>";
    }

    echo '</table>';
} else {
    echo "<p>No records found.</p>";
}

?>
