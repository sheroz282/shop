<?php

class ProductService
{
    public function getBasketItems($items)
    {
        $total = 0;
        foreach ($items as $key => $item) {
            $items[$key]['product'] = (new Product()) ->getById($item['product_id']);
            $items[$key]['product']['sum'] = $items[$key]['product']['price'] * $items[$key]['quantity'];
            $total += $items[$key]['product']['sum'];
        }

        return [
            'items' => $items,
            'total' => $total
        ];
    }
}