<?php

/**
 * return
*/
return [
    'required' => [
        'cgst' => 'CGST'
    ],
    'optional' => [
        'sgst' => 'SGST',
        'igst' => 'IGST'
    ],
    /** tax based on hsncode */
    'hsncodes' => [
        '27040030' => 'L',
        '27131130' => 'H',
        '25021000' => 'L',
    ],
    'codes'=> [
        'H' => 18,
        'L' => 5,
        'N' => 0,
    ]
];
