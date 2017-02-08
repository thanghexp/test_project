<?php

return [
    // SETTING MASTER CATALOG
    'CATALOG_CUSTOMER_STATUS' => env('CUSTOMER_STATUS', 'customer_status'),
    'CATALOG_CUSTOMER_TYPE' => env('CUSTOMER_TYPE', 'customer_type'),
    'CATALOG_CUSTOMER_BILL_TYPE' => env('CUSTOMER_BILL_TYPE', 'customer_bill_type'),

    // BUILD OBJECT
    'OBJECT_CUSTOMER' => env('CUSTOMER', 'customer'),
    'OBJECT_IW' => env('INDUSTRIAL_WASTE', 'industrial_waste'),
    'OBJECT_PU' => env('PURCHASE', 'purchase'),
    'OBJECT_SA' => env('SALE', 'sale'),

    // BUILD ACTION
    'ACTION_CREATE' => env('ACTION_CREATE', 'create'),
    'ACTION_UPDATE' => env('ACTION_UPDATE', 'update'),

    // BUILD TYPE
    'INDUSTRIAL_WASTE_TYPE' => env('INDUSTRIAL_WASTE_TYPE', 'industrial_waste_type'),
    'PURCHASE_TYPE' => env('PURCHASE_TYPE', 'purchase_type'),
    'SALE_TYPE' => env('SALE_TYPE', 'sale_type'),

    // BUILD DEFINITION
    'INDUSTRIAL_WASTE_DEFINITION' => env('INDUSTRIAL_WASTE_DEFINITION', 'industrial_waste_definition'),
    'PURCHASE_DEFINITION' => env('PURCHASE_DEFINITION', 'purchase_definition'),
    'SALE_DEFINITION' => env('SALE_DEFINITION', 'sale_definition')
];
