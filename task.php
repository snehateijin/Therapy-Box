<?php

/*
 * Example PHP implementation used for the index.html example
 */

// DataTables PHP library
include( "datatables/lib/DataTables.php" );
// Alias Editor classes so they are easy to use
use DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Options,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate,
    DataTables\Editor\ValidateOptions;
//echo "here";
// Build our Editor instance and process the data coming from _POST
Editor::inst($db, 'task')
       
        ->fields(
                Field::inst('task_name')
                ->validator(Validate::notEmpty(ValidateOptions::inst()
                                ->message('A Task name is required')
                )), Field::inst('task_status')
                ->setFormatter(function ( $val, $data, $opts ) {
                    return !$val ? 0 : 1;
                })
        )
        ->process($_POST)
        ->json();
                
