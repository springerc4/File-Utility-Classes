<?php
    require_once('CSVHelper.php');
    // Create a new CSVHelper object 
    $CSV_file_helper_1 = new CSVHelper('random.CSV');
    $backup = new CSVHelper('backup_random.CSV');
    $backup_array = $backup->readFile();
    $CSV_file_helper_1->writeFile($backup_array);

    // Read and print the contents of the CSV file as an array
    echo '<h4>Read the Entire CSV File</h4><br>';
    $array = $CSV_file_helper_1->readFile();
    print_r($array);

    echo '<br><br>';
    // Read a specific record from the CSV File
    echo '<h4>Read one record from the CSV File</h4><br>';
    $first_record = $CSV_file_helper_1->readFile(0);
    print_r($first_record);

    echo '<br><br>';
    // Read a specific element from the CSV file
    echo '<h4>Read one value from the CSV File</h4><br>';
    $last_name = $CSV_file_helper_1->readFile(0, 1);
    echo $last_name;

    echo '<br><br>';
    // Write to CSV File
    echo '<h4>Write to a CSV File</h4><br>';
    $array[0][1] = 'Cam';
    $CSV_file_helper_1->writeFile($array);
    print_r($array);

    echo '<br><br>';
    // Append to CSV File
    echo '<h4>Append to a CSV File</h4><br>';
    $new_record = ['first', 'second'];
    $CSV_file_helper_1->writeFile($new_record, true);
    print_r($CSV_file_helper_1->readFile());

    echo '<br><br>';
    // Modify Entire File
    echo '<h4>Modify entire array</h4><br>';
    $diff_array = [
        [
            'cat',
            'dog'
        ],
        [
            'mouse',
            'deer'
        ]
    ];
    $CSV_file_helper_1->modifyFile($diff_array);
    print_r($CSV_file_helper_1->readFile());

    echo '<br><br>';
    // Modify specific record
    echo '<h4>Modify one record in a CSV file</h4><br>';
    $CSV_file_helper_1->modifyFile($diff_array, 0);
    print_r($CSV_file_helper_1->readFile());

    echo '<br><br>';
    // Modify one value in a record
    echo '<h4>Modify one value in a CSV record</h4><br>';
    $CSV_file_helper_1->modifyFile($diff_array, 0, 1);
    print_r($CSV_file_helper_1->readFile());

    echo '<br><br>';
    // Delete entire file
    echo '<h4>Delete the entire file</h4><br>';
    $CSV_file_helper_1->deleteFrom();
    print_r($CSV_file_helper_1->readFile());
    $CSV_file_helper_1->writeFile($backup_array);

    echo '<br><br>';
    // Delete a specific record
    echo '<h4>Delete second record from the CSV file</h4><br>';
    $CSV_file_helper_1->deleteFrom(1);
    print_r($CSV_file_helper_1->readFile());
    $CSV_file_helper_1->writeFile($backup_array);
    
    echo '<br><br>';
    // Delete a specific value from a record
    echo '<h4>Delete first name from first record</h4><br>';
    $CSV_file_helper_1->deleteFrom(0, );
    print_r($CSV_file_helper_1->readFile(0));
    $CSV_file_helper_1->writeFile($backup_array);

?>