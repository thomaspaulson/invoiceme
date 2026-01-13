<?php

/**
 * return
*/
return [
    'taxes' => [
        'cgst' => [
         'label' => 'CGST',
         'required' => true,
        ],
        'sgst' => [
         'label' => 'SGST',
         'required' => false,
        ],
        'igst' => [
         'label' => 'IGST',
         'required' => false,
        ],
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
