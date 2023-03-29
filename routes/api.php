<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProductController;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});


Route::resource("/product", ProductController::class);


Route::get("/invoice/{id}", function ($id) {
    // $data = Invoice::find($id)->items()->get();  Get Only Invoices Items
    $data = Invoice::with("items")->find($id); // Get Invoice With Items
    return response()->json($data);
});


Route::post("/invoice/create", function (Request $request) {

    $invoice = new Invoice($request->get('invoice'));
    $invoice->save();

    foreach ($request->get("items") as $key => $item) {
        $new_item = new InvoiceItem($item);
        $invoice->items()->save($new_item);
    }

    $response_data = Invoice::with("items")->find($invoice->id);
    return response()->json($response_data);
});

Route::get("/invoice/delete/{invoice}", function (Invoice $invoice) {
    $invoice->delete();
    return response()->json($invoice);
});


Route::patch("/invoice/update/{invoice}", function (Request $request, Invoice $invoice) {
    $invoice->update($request->get('invoice'));
    return response()->json($invoice);
});
