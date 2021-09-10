<?php

namespace app\repository;

use yii\db\Query;

/**
 * This is the class responsible on all Query of the Bi part
 */
class BiQuery
{

    //public attributes for current day,month,year
    public $currentDay;

    public $currentMonth;

    public $currentYear;

    // public attributes used  in research

    public $date_start;

    public $date_end;

    public $listOfUtiliateurs;

    public $monthUsedInExport;

    public function __construct($date_start = null, $date_end = null, $listOfUtiliateurs = null)
    {
        setlocale(LC_TIME, 'fr_FR', 'french', 'French_France.1252', 'fr_FR.ISO8859-1', 'fra');

        if ($date_start && $date_end) {

            $this->date_start = date('Y-m-d H:i:s', strtotime($date_start));
            $this->date_end = date('Y-m-d H:i:s', strtotime($date_end));
            $this->currentYear = date('Y', strtotime($date_start));
            $this->currentMonth = date('m', strtotime($date_start));
            $this->currentDay = date('d', time());
        } else {

            $this->date_start = "";
            $this->date_end = "";
            $this->currentYear = date('Y', time());
            $this->currentMonth = date('m', time());
            $this->currentDay = date('d', time());
        }
    }

    /**
     * Method daily transactions of the current month
     *
     * @return object
     */
    public function countStagiare()
    {
        $query = (new Query())
            ->select('count(stagiaire.id)')
            ->from('{{%stagiaire}}')
            ;
            if ($this->date_start) {
                $query->andWhere(['between', 'date', $this->date_start, $this->date_end]);
            }
        return $query->all();
    }

    /**
     * Method monthly transactions of the current year
     *
     * @return object
     */
    public function countEncadreur()
    {
        $query = (new Query())
            ->select('count(encadreur.id)')
            ->from('{{%encadreur}}')
        ;
        if ($this->date_start) {
            $query->andWhere(['between', 'date', $this->date_start, $this->date_end]);
        }

        return $query->all();
    }

    /**
     * Method  d daily requests (aka Décaissement) for the current month.
     *
     * @return object
     */
    public function countSpeciality()
    {

        $query = (new Query())
            ->select('count(stagiaire.specialite)')
            ->from('{{%stagiaire}}')
        ;
        if ($this->date_start) {
            $query->andWhere(['between', 'date', $this->date_start, $this->date_end]);
        }
        return $query->all();
    }

        /**
     * Method  d daily requests (aka Décaissement) for the current month.
     *
     * @return object
     */
    public function countYearlyStatusStage()
    {

        $query = (new Query())
            ->select('count(stagiaire.id),status')
            ->from('stagiaire')
            ->groupBy(['status'])
        ;
        if ($this->date_start) {
            $query->andWhere(['between', 'date', $this->date_start, $this->date_end]);
        }
      
        return $query->all();
    }

    /*
    public function countYearlyStage()
    {

        $query = (new Query())
            ->select('count(stage.id)')
            ->from('{{%stage}}')
        ;
        if ($this->date_start) {
            $query->andWhere(['between', 'date_debut_du_stage', $this->date_start, $this->date_end]);
        }

        return $query->all();
    }*/
}
