<?php
/**
 * Created by PhpStorm.
 * User: LydiaPC
 * Date: 19/04/18
 * Time: 16:18
 */

class Controller
{
    function isValid($var){
        if(isset($var)){
            if($var){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}