<?php
class appFuncAjax
{
    public function addItem($get, $itemArray = [], $includeFile)
    {
        if (isset($get['id'])) {
            $itemId = $get['id'];
            if (isset($itemArray[$itemId])) {
                $date = date('ymdhis');
                $id = $itemId . '_' . $date;
                $itemName = $itemArray[$itemId]['name'];
                $itemInt = 1;
                $itemPrice = $itemArray[$itemId]['price'];
                include_once $includeFile;
            }
        } else {
        }
    }
}
