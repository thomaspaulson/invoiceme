<?php

namespace App\Http\Controllers;

use App\UseCases\Item\ShowItem\ShowItemService;
use App\UseCases\Item\CreateItem\CreateItem;
use App\UseCases\Item\CreateItem\CreateItemService;
use App\UseCases\Item\DeleteItem\DeleteItemService;
use App\UseCases\Item\UpdateItem\UpdateItem;
use App\UseCases\Item\UpdateItem\UpdateItemService;
use App\UseCases\Item\ListItems\ListItemService;
use App\UseCases\Item\ListItems\Item;
use Illuminate\Http\Request;
use App\Http\Requests\Item\CreateItemRequest;
use App\Http\Requests\Item\UpdateItemRequest;

class ItemController extends Controller
{

    public function index(Request $request, ListItemService $listItemService)
    {

        $items = $listItemService->list();
        return array_map(
            fn (Item $item) => $item->asArray(),
            $items
        );

    }

    public function show(Request $request, $id, ShowItemService $showItemService)
    {
        $item = $showItemService->show($id);

        return response()->json($item->asArray());
    }

    public function store(CreateItemRequest $request, CreateItemService $createItemService)
    {

        $createItem = CreateItem::fromRequestData($request->all());
        $itemID = $createItemService->create($createItem);

        return response()->json(['itemID' => $itemID]);
    }

    public function update(UpdateItemRequest $request, $id, UpdateItemService $updateItemService)
    {

        $updateItem = UpdateItem::fromRequestData($request->all());
        $itemID = $updateItemService->update($updateItem, $id);

        return  response()->json(['itemID' => $itemID]);

    }

    public function destroy(Request $request, $id, DeleteItemService $deleteItemService)
    {

        $itemID = $deleteItemService->delete($id);
        return response()->json(['itemID' => $itemID]);
    }

}
