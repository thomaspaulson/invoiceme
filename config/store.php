<?php

/**
 * return

*/
return [
    'company' => [
        'name' => env('APP_NAME', 'Laravel'),
        'address' => env('APP_NAME', 'Laravel'),
        'zipcode' => env('APP_NAME', 'Laravel'),
        'gstin' => env('APP_NAME', 'Laravel'),
    ],
    /** tax based on hsncode */
    'hsncodes' => [
        '27040030' => 'H',
        '2704300' => 'L',
    ],
    'taxes'=> [
       'H' => 18,
       'L' => 5,
       'N' => 0,
    ]
];
