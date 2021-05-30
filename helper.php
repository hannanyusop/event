<?php

function strLimit($str, $limit = 20){
    if (strlen($str) > $limit){
        return substr($str, 0, $limit) . ' . . .';
    }
}

function dd($string){

    return var_dump($string);exit();
}


function createBill($categoryCode, $billName, $billDescription, $billAmount, $billReturnUrl, $billCallbackUrl, $billTo, $billEmail,$billPhone){

    $some_data = array(
        'userSecretKey'=> $GLOBALS['toyyib_secret_key'],
        'categoryCode'=> $categoryCode,
        'billName'=>$billName,
        'billDescription'=>$billDescription,
        'billPriceSetting'=>0,
        'billPayorInfo'=>1,
        'billAmount'=>$billAmount,
        'billReturnUrl'=> $billReturnUrl,
        'billCallbackUrl'=>$billCallbackUrl,
        'billExternalReferenceNo' => 'AFR341DFI',
        'billTo'=>$billTo,
        'billEmail'=>$billEmail,
        'billPhone'=>$billPhone,
        'billSplitPayment'=>0,
        'billSplitPaymentArgs'=>'',
        'billPaymentChannel'=>'0',
        'billContentEmail'=>'Thank you for purchasing our product!',
        'billChargeToCustomer'=>1
    );

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_URL, $GLOBALS['toyyib_url'].'index.php/api/createBill');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

    $result = curl_exec($curl);
    $info = curl_getinfo($curl);
    curl_close($curl);
    $obj = json_decode($result);

    // var_dump($obj[0]->BillCode);exit();

    return $obj[0]->BillCode;
}


?>