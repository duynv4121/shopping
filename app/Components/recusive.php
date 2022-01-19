<?php

namespace App\Components;

class recusive{
    private $data;
    private $htmlSelect = '';

    public function __construct($data)
    {
       $this->data = $data;
    }
    
    public function danhMucDeQuy($parent_id, $id=0, $text = ''){

        foreach($this->data as $val){ 
            if($val['parent_id'] == $id){
                if(!empty($parent_id) && $parent_id == $val['id']){
                    $this->htmlSelect.='<option selected value="'.$val['id'].'">'.$text. $val['name'].'</option>';

                }else{
                    $this->htmlSelect.='<option  value="'.$val['id'].'">'.$text. $val['name'].'</option>';

                }
                $this->danhMucDeQuy($parent_id, $val['id'], $text.'-');
            }
        }

        return $this->htmlSelect;
    }

}