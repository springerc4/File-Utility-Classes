<?php
    require_once('JSONHelper.php');
    // Create a new JSONHelper object 
    $JSON_reader_1 = new JSONHelper('test.json');
    $backup = new JSONHelper('backup_test.json');
    $backup_array = $backup->readFile();
    $JSON_reader_1->writeFile($backup_array);

    // Read and print the contents of the JSON file as an array
    echo '<h4>Read the Entire JSON File</h4><br>';
    $array = $JSON_reader_1->readFile();
    print_r($array);

    echo '<br><br>';
    // Read a specific record from the JSON File
    echo '<h4>Read one record from the JSON File</h4><br>';
    $first_record = $JSON_reader_1->readFile(0);
    print_r($first_record);

    echo '<br><br>';
    // Read a specific element from the JSON file
    echo '<h4>Read one value from the JSON File</h4><br>';
    $last_name = $JSON_reader_1->readFile(0, 'last name');
    echo $last_name;

    echo '<br><br>';
    // Write to JSON File
    echo '<h4>Write to a JSON File</h4><br>';
    $array[0]['first name'] = 'Cam';
    $JSON_reader_1->writeFile($array);
    print_r($array);

    echo '<br><br>';
    // Append to JSON File
    echo '<h4>Append to a JSON File</h4><br>';
    $new_record = ["first name" => "Carl", "last name" => "Monk"];
    $JSON_reader_1->writeFile($new_record, true);
    print_r($array);

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
    $JSON_reader_1->modifyFile($diff_array);
    print_r($JSON_reader_1->readFile());

    echo '<br><br>';
    // Modify specific record
    echo '<h4>Modify one record in a JSON file</h4><br>';
    $JSON_reader_1->modifyFile($diff_array, 0);
    print_r($JSON_reader_1->readFile());

    echo '<br><br>';
    // Modify one value in a record
    echo '<h4>Modify one value in a JSON record</h4><br>';
    $JSON_reader_1->modifyFile($diff_array, 0, 1);
    print_r($JSON_reader_1->readFile());

    echo '<br><br>';
    // Delete entire file
    echo '<h4>Delete the entire file</h4><br>';
    $JSON_reader_1->deleteFrom();
    print_r($JSON_reader_1->readFile());
    $JSON_reader_1->writeFile($backup_array);

    echo '<br><br>';
    // Delete a specific record
    echo '<h4>Delete second record from the JSON file</h4><br>';
    $JSON_reader_1->deleteFrom(1);
    print_r($JSON_reader_1->readFile());
    $JSON_reader_1->writeFile($backup_array);
    
    echo '<br><br>';
    // Delete a specific value from a record
    echo '<h4>Delete first name from first record</h4><br>';
    $JSON_reader_1->deleteFrom(0, "first name");
    print_r($JSON_reader_1->readFile(0));
    $JSON_reader_1->writeFile($backup_array);

?>