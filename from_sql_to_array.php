<?php

/*
    *Use this script to extract data from sql insert statements and convert it to a PHP array format.
    *The script reads a file containing SQL insert statements, extracts the relevant data using regex,
    *and then outputs the data as a PHP array.
    *The script is designed to work with a specific format of SQL insert statements, so it may need to be
    *modified if the format of the SQL statements changes.
*/
$sqlData = file_get_contents('/path_to_your_sql_file.sql');

preg_match_all(
    'set your expression here',
    //EXAMPLE:
    // "/\((\d+),(-?\d+(?:\.\d+)?),(-?\d+(?:\.\d+)?),'([^']*)','([^']*)','([^']*)','([^']*)','([^']*)','([^']*)',(\d+),'([^']*)','([^']*)',(\d+),'([^']*)',(-?\d+),(-?\d+)\)/",
    //"/\((\d+),('[^']*'),('[^']*'),('[^']*'),('[^']*'),('[^']*'),('[^']*'),(\d+),('[^']*'),('[^']*'),(\d+),(-?\d+),(-?\d+)\)/",
    $sqlData,
    $matches,
    PREG_SET_ORDER
);

$locationsData = [];
foreach ($matches as $match) {
    $locationsData[] = [
        // Adjust the indices based on your regex pattern
        'id' => (int)$match[1],
        'name' => $match[2],
        'family_name' => $match[3],
        'age' => $match[4],
        'gender' => $match[5],
    ];
}

// Output as PHP array format
echo "<?php\n\nreturn [\n";
foreach ($locationsData as $location) {
    echo "    [\n";
    foreach ($location as $key => $value) {
        if (is_numeric($value)) {
            echo "        '$key' => $value,\n";
        } else {
            $escaped = addslashes($value);
            echo "        '$key' => '$escaped',\n";
        }
    }
    echo "    ],\n";
}
echo "];\n";
