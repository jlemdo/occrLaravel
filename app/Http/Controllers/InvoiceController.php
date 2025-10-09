<?php

namespace App\Http\Controllers;

use App\Models\Deals;
use App\Models\Invoice;
use App\Models\Leads;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   

    private function calculateTotalPrice($quantities, $unitPrices)
{
    $totalPrice = 0;
    
    foreach ($quantities as $index => $quantity) {
        $totalPrice += $quantity * $unitPrices[$index];
    }
    
    return $totalPrice;
}

    private function buildItemDetail($items, $quantities, $unitPrices)
{
    $itemDetail = [];
    
    foreach ($items as $index => $item) {
        $itemDetail[] = [
            'item_id' => $item,
            'quantity' => $quantities[$index],
            'unit_price' => $unitPrices[$index]
        ];
    }
    
    return $itemDetail;
}

   
}
