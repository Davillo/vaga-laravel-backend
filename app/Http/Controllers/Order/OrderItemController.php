<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderItemStoreRequest;
use App\Repositories\OrderItemRepository;
use Illuminate\Http\Response;

class OrderItemController extends Controller
{
    private $orderItemRepository;

    function __construct(OrderItemRepository $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
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

        $orderItem = $this->orderItemRepository->create(
        array_merge($data, [
            'order_id' => $id
        ]));

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

        $orderItem->update([
            'quantity' => $data['quantity']
        ]);

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
        $this->orderItemRepository->where('order_id', $id)->where('id', $itemId)->delete();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
