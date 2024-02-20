<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\ToothType;
use App\Models\Transaction;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{

    public function index( Request $request )
    {
        // fitler by
        // doctor_id, color_id, tooth_type_id, PAID or UNPAID, DELIVERED or UDELIVERD
        // search by patient_name
        // datepicker
        $ordersQuery = Order::with([
            'doctor',
            'invoice',
            'color',
            'toothType',
            'units.unitType'
        ])->orderBy('created_at', 'desc');

        if($request->doctor_id ){
          $ordersQuery->where('doctor_id',$request->doctor_id);
        }

        if($request->color_id ){
            $ordersQuery->where('color_id',$request->color_id);
          }

        if($request->tooth_type_id ){
          $ordersQuery->where('tooth_type_id',$request->tooth_type_id);
        }

        if(isset($request->delivered)){
            $ordersQuery->where('delivered',$request->delivered);
        }

        if($request->date_from){
            $ordersQuery->whereDate('created_at','>=',$request->date_from);
        }

        if($request->date_to){
            $ordersQuery->whereDate('created_at','<=',$request->date_to);
        }

        if($request->date){
            $ordersQuery->whereDate('created_at',$request->date);
        }

        if($request->payment_status){
            $paymentStatus = $request->payment_status;
            $ordersQuery->whereHas('invoice',function($q) use ($paymentStatus) {
                $q->where('payment_status',$paymentStatus);
            });
        }

        if($request->patient_name){
            $ordersQuery->where('patient_name','like',"%{$request->patient_name}%");
        }

        $orders = $ordersQuery->paginate(10);
        return response()->json(['data'=>$orders,'message'],Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOrderRequest $request)
    {
        $data=[
            'doctor_id' => $request['doctor_id'],
            'color_id' => $request['color_id'],
            'tooth_type_id' =>$request['tooth_type_id'],
            'patient_name' => $request['patient_name']
        ];

        if($request->file()) {
            $fileName = time().'_orders_'.$request->attachment->getClientOriginalName();
            $request->attachment->move(public_path('storage/uploads'), $fileName);
            $data['attachment'] = $fileName;
        }
        $order = Order::create($data);

        // 2- create unit

        foreach($request->unit_types_ids as $id ){
            Unit::create([
                'unit_type_id'=>$id,
                'order_id' => $order->id
            ]);
        }

        // 3- creat unpaid invoice

        $costPerUnit =  ToothType::where('id',$request['tooth_type_id'])
                                   ->select('cost')
                                   ->first()
                                   ->cost;

        $allUnitsCost = $costPerUnit * count($request->unit_types_ids);

        $invoiceData = [
            'order_id' =>$order->id,
            'payment_status' => 'UNPAID',
            'subtotal_amount' => $allUnitsCost,
            'total_amount' =>  $allUnitsCost,
            'remaining_amount'=> $allUnitsCost,
            'paid_amount' => 0
        ];

        if($request->discount_type  && $request->discount_value  ){
            if($request->discount_type == 'PERCENTAGE'){
              $invoiceData['discount_type'] = 'PERCENTAGE';
              $invoiceData['discount_value'] = $request->discount_value;
              $invoiceData['discount_amount'] = ($request->discount_value /100)  * ($allUnitsCost);
              $invoiceData['total_amount'] =    $allUnitsCost  -  (($request->discount_value / 100)  * $allUnitsCost);
              $invoiceData['remaining_amount'] =    $allUnitsCost  -  (($request->discount_value / 100)  * $allUnitsCost);
            }  else{
                $invoiceData['discount_type'] = 'FIXED';
                $invoiceData['discount_amount'] = $request->discount_value;
                $invoiceData['discount_value'] = $request->discount_value;
                $invoiceData['total_amount'] =  $allUnitsCost - $request->discount_value;
                $invoiceData['remaining_amount'] =  $allUnitsCost - $request->discount_value;
            }
          }

        $invoice = Invoice::create($invoiceData);
        return response()->json(['message'=>'order created successfully','data'=>[]], Response::HTTP_CREATED );
    }


       /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request)
    {
        $data = $request->all();
        if($request->file()) {
            $fileName = time().'_orders_'.$request->attachment->getClientOriginalName();
            $request->attachment->move(public_path('storage/uploads'), $fileName);
            $data['attachment'] = $fileName;
        }

        $order  = Order::where(['id'=>$request->id])->with(['units','invoice.transaction','toothType'])->first();
        $order->units()->delete();
        $order->invoice()->delete();
        unset($data['unit_types_ids']);
        unset($data['discount_value']);
        unset($data['discount_type']);

        $order->update($data);
        // 2- create unit
        foreach($request->unit_types_ids as $id ){
            Unit::create([
                'unit_type_id'=>$id,
                'order_id' => $order->id
            ]);
        }

        // 3- creat unpaid invoice


        $costPerUnit =0;
        if(isset($request['tooth_type_id'])){

        $costPerUnit =  ToothType::where('id',$request['tooth_type_id'])
            ->select('cost')
            ->first()
            ->cost;

        }else {
         $costPerUnit = $order->toothType->cost;
        }

        $allUnitsCost = $costPerUnit * count($request->unit_types_ids);

        $invoiceData = [
            'order_id' =>$order->id,
            'payment_status' => 'UNPAID',
            'subtotal_amount' => $allUnitsCost,
            'total_amount' =>  $allUnitsCost ,
            'remaining_amount' =>    $allUnitsCost,
            'paid_amount' => 0
        ];

        if($request->discount_type  && $request->discount_value  ){
            if($request->discount_type == 'PERCENTAGE'){
              $invoiceData['discount_type'] = 'PERCENTAGE';
              $invoiceData['discount_value'] = $request->discount_value;
              $invoiceData['discount_amount'] = ($request->discount_value /100)  * ($allUnitsCost);
              $invoiceData['total_amount'] =    $allUnitsCost  -  (($request->discount_value / 100)  * $allUnitsCost);
              $invoiceData['remaining_amount'] =    $allUnitsCost  -  (($request->discount_value / 100)  * $allUnitsCost);
            }  else{
                $invoiceData['discount_type'] = 'FIXED';
                $invoiceData['discount_amount'] = $request->discount_value;
                $invoiceData['discount_value'] = $request->discount_value;
                $invoiceData['total_amount'] =  $allUnitsCost - $request->discount_value;
                $invoiceData['remaining_amount'] =  $allUnitsCost - $request->discount_value;
            }
          }

        $invoice = Invoice::create($invoiceData);

        return response()->json(['message'=>'order updated successfully','data'=>[]], Response::HTTP_CREATED );
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $order = Order::where('id',$id)->with([
            'doctor',
            'invoice',
            'color',
            'toothType',
            'units.unitType'
        ])->get()->first();
        return response()->json(['data'=>$order,'message'=>''],Response::HTTP_OK);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::where('id',$id)->update(['deleted_at'=>Carbon::now()]);
        return response()->json(['data'=>[], 'message' => 'deleted successfully'],Response::HTTP_OK);
    }

    public function restore(int $id){
        Order::withTrashed()->where('id',$id)->update(['deleted_at'=>null]);
        return response()->json(['data'=>[],"message"=>'restored successfully'],Response::HTTP_OK);
    }

    public function markAsPaid(int $invoiceId){
       $invoice = Invoice::find($invoiceId);
       if($invoice->payment_status == 'PAID') return response()->json(['message'=>'already paid','data'=>[]],200);
       $invoice->payment_status = 'PAID';
       $invoice->paid_amount = $invoice->total_amount;
       $invoice->remaining_amount = 0;
       $invoice->save();
       Transaction::create([
        'type' => 'INVOICE',
        'invoice_id' => $invoiceId
      ]);
      return response()->json(['data'=>[],'message'=>'Paid Successfully'],Response::HTTP_OK);
    }

    public function setDelivered(int $orderId){
     $order = Order::where('id',$orderId)->select('id','delivered')->first();

     if($order->delivered){
        $order->delivered = false;
     }else {
        $order->delivered = true;
     }
     $order->save();

     return response()->json(['data'=>'Order updated Successfully'],Response::HTTP_OK);
    }


    public function markAsUnPaid(int $invoiceId){
        $invoice = Invoice::find($invoiceId);
        if($invoice->payment_status == 'UNPAID') return response()->json(['message'=>'already markd as unpaid','data'=>[]],200);
        $invoice->payment_status = 'UNPAID';
        $invoice->paid_amount =  0;
        $invoice->remaining_amount = $invoice->total_amount;
        $invoice->save();
        $invoice->transaction()->delete();

        return response()->json(['data'=>[],'message'=>'Marked as unpaid successfully'],Response::HTTP_OK);
     }

}
