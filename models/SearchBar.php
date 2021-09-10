<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;



/**
 * This is the model class for table "transaction".
 */
class SearchBar extends Model
{
    /**
     * @inheritdoc
     */


    public $date_start;

    public $date_end;

    public $users;

    public function rules()
    {

        return
            [
                [
                    ['date_start', 'date_end','users'], 'safe'],
                    
              
            ];
    }
//Methode will be enhanced later if missing date
   /* public function checkDate($attribute,$attribute2)
    {
       
     //   $date_start = new \DateTime($attribute);
     
     //  echo  $date_start->format('M');
    //    $date_end = new \DateTime($attribute['date_end']);
 
     //   $date_start = date("M",$attribute);
     //   $date_end = date("F", $attribute2);
    //    print_r($date_start);
   //     print_r($date_end);
            die();


        if ($date_start == $date_end) {
            $this->addError('filter_date', 'priorite should not be greater than 3');
            //var_dump($value['priority']);
            Yii::$app->session->addFlash('error', 'Les dates doivent etre dans le meme mois');
            return false;
        }
        Yii::$app->session->addFlash('success', 'contact Form Submitted');
        return true;

        // return true;

    }*/
}
