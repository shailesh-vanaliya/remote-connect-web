<?php

$defaultPath = public_path() . '/uploads/';
$defaultPath1 = storage_path() . '/app/uploads/';
$viewPath = '/uploads/';
// $viewPath = $_SERVER['APP_URL'] . '/uploads/';
$viewPath1 = storage_path() . '/app/uploads/';
$perPage = 20;
return [
    'pagination' => ['perPage' => '15'],
    'paginationapi' => ['perPage' => '15'],
    'path' => [
        'pdf_download' => 'http://backendbooking.kanhasoftdev.com/public/uploads/signee_pdf/',
    ],
    'uploadFilePath' => [
        'product' => ['default' => $defaultPath . 'product/', 'view' => $viewPath . 'product/'],
        'categories' => ['default' => $defaultPath1 . 'categories/', 'view' => $viewPath1],
    ],
    'reportType' =>  [
        'History Log' => 'History Log', 'Daily Consumption' => 'Daily Consumption', 'Weekly Consumption' => 'Weekly Consumption', 'Monthly Consumption' => 'Monthly Consumption'
    ],
    'alertType' =>  [
        'History Log' => 'History Log', 'Daily Consumption' => 'Daily Consumption', 'Weekly Consumption' => 'Weekly Consumption', 'Monthly Consumption' => 'Monthly Consumption'
    ],
    'storageQuota' =>  [
        '10mb' => '10mb',
        '30mb' => '30mb',
        '50mb' => '50mb',
        '70mb' => '70mb',
        '100mb' => '100mb',
        '500mb' => '500mb',
        '1gb' => '1gb',
        '10gb' => '10gb',
    ],
    'SMSQuota' =>  [
        '50' => '50',
        '100' => '100',
        '200' => '200',
        '300' => '300',
        '400' => '400',
        '500' => '500',
    ],
    'emailQuota' =>  [
        '50' => '50',
        '100' => '100',
        '200' => '200',
        '300' => '300',
        '400' => '400',
        '500' => '500',
    ],
    'reportQuota' =>  [
        '10' => '10',
        '20' => '20',
        '30' => '30',
        '40' => '40',
        '50' => '50',
        '100' => '100',
    ],
    'notificationQuota' =>  [
        '50' => '50',
        '100' => '100',
        '200' => '200',
        '300' => '300',
        '400' => '400',
        '500' => '500',
    ],
    'reportScheduleQuota' =>  [
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
    ],
    'SARoles' =>  [
        "ADMIN"=> "ADMIN", "USER"=> "USER","ENG"=> "ENG"
    ],
    'ARoles' =>  [
        "USER"=> "USER"
    ],
];
