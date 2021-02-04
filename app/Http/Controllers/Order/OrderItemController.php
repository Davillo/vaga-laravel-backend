<?php

namespace App\Http\Controllers\Order;

use App\Constants\Order\OrderConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderItemStoreRequest;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Response;

class OrderItemController extends Controller
{
    private $orderItemRepository;

    private $orderRepository;

    private $productRepository;

    function __construct(OrderItemRepository $orderItemRepository, OrderRepository $orderRepository, ProductRepository $productRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function index(int $id)
    {
       $items = $this->orderItemRepository->where('order_id', $id)->get();
       return response()->json($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function store(OrderItemStoreRequest $request, int $id)
    {
        $data = $request->validated();

        $order = $this->orderRepository->find($id);

        if(!$order){
            return response()->json(['message' => 'Order not found'], Response::HTTP_NOT_FOUND);
        }

        if($order->status === OrderConstants::ORDER_STATUS_CHECKOUT){
            return response()->json(['message' => 'The order are already on checkout status'], Response::HTTP_BAD_REQUEST);
        }

        $orderItem = $this->orderItemRepository->create(
        array_merge($data, [
            'order_id' => $id
        ]));

        $product = $this->productRepository->find($orderItem->product_id);
        $itemValue = $orderItem->quantity * $product->price;
        
        

        $order->update([
            'total' => $order->total += $itemValue
        ]);

        return response()->json(['data' => $orderItem], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  int  $itemId
     * @return \Illuminate\Http\Response
     */
    public function show(int $id, int $itemId)
    {
        $orderItem = $this->orderItemRepository->where('order_id', $id)->where('id', $itemId)->first();
        return response()->json(['data' => $orderItem]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  int  $itemId
     * @return \Illuminate\Http\Response
     */
    public function update(OrderItemStoreRequest $request, int $id, int $itemId)
    {
        $data = $request->validated();

        $orderItem = $this->orderItemRepository->where('order_id', $id)->where('id', $itemId)->first();

        $orderItem->update($data);

        return response()->json(['data' => $orderItem]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $itemId
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id, int $itemId)
    {        
        $order = $this->orderRepository->find($id);
        $orderItem = $this->orderItemRepository->where('order_id', $id)->where('id', $itemId)->first();

        if(!$order){
            return response()->json(['message' => 'Order not found'], Response::HTTP_NOT_FOUND);
        }

        if(!$orderItem){
            return response()->json(['message' => 'Order item not found'], Response::HTTP_NOT_FOUND);
        }

        if($order === OrderConstants::ORDER_STATUS_CHECKOUT){
            return response()->json(['message' => 'The order are already on checkout status'], Response::HTTP_BAD_REQUEST);
        }

        $product = $this->productRepository->find($orderItem->product_id);
        $itemValue = $orderItem->quantity * $product->price;
        
        $order->update([
            'total' => $order->total -= $itemValue
        ]);
        $orderItem->delete();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
