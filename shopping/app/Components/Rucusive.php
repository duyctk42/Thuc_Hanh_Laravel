<?php
namespace App\Components;
class Rucusive {
    private $data;
    private $htmlSeclect = '';
    public  function __construct($data)
    {
        $this->data = $data;
    }

    public function categoryRecusive($parenId, $id = 0, $text = '')
    {
        foreach ($this->data as $value){
            if ($value['paren_id'] == $id){
                if (!empty($parenId) && $parenId == $value['id']){
                    $this->htmlSeclect .="<option selected value='" . $value['id'] . "'>" .$text.$value['name']."<option>";
                }else {
                    $this->htmlSeclect .="<option  value='" . $value['id'] . "'>" .$text.$value['name']."<option>";
                }

                $this->categoryRecusive($parenId, $value['id'], $text.'--');

            }
        }
        return $this->htmlSeclect;
    }
}
