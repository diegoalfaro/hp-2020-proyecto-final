<?php

return [
    'supplier' => '#:id - :business_name (CUIT :cuit)',
    'customer' => '#:id - :full_name (DNI :identity)',
    'product' => '#:id - :brand - :name',
    'vehicle' => '#:id - :domain - :brand - :model - :year',
    'product_brand' => ':name',
    'vehicle_brand' => ':name',
];
