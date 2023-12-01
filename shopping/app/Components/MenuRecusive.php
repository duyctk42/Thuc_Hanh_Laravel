<?php
namespace App\Components;
use App\Menu;

class MenuRecusive  {
    private $html;
    public function __construct(){
        $this->html= '';
    }
    public  function MenuRecusiveAdd($parenId = 0, $subMark = ''){
        $data = Menu::where('paren_id', $parenId) ->get();
        foreach ($data as $dataItem) {
            $this->html .= '<option value="' . $dataItem->id . '">' . $subMark . $dataItem->name . '</option>';
            $this->MenuRecusiveAdd($dataItem->id,$subMark . '--');
        }
        return $this->html;
    }
    public  function MenuRecusiveEdit($parenIdMenuEdit, $parenId = 0, $subMark =''){
        $data = Menu::where('paren_id', $parenId) ->get();
        foreach ($data as $dataItem) {
            if ($parenIdMenuEdit == $dataItem->id ){
                $this->html .= '<option selected value="' . $dataItem->id . '">' . $subMark . $dataItem->name . '</option>';
            }else{
                $this->html .= '<option value="' . $dataItem->id . '">' . $subMark . $dataItem->name . '</option>';
            }

            $this->MenuRecusiveEdit($parenIdMenuEdit, $dataItem->id, $subMark . '--');
        }
        return $this->html;
    }
}
