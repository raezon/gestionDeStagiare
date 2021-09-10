<?php

/*
 * Service Responsible On the creation Of the Grade
 *
 *@author ammar djebabla <amardjebabla10@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace app\service;

use Yii;

use app\models\AuthAssignment as  AuthAssignment;


class ChartCreationService
{
    //Constantes
   
    const MONTHS = ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "December"];
    const TYPEDECAISSEMENT = ["Valide", "Rejeter", "En cour de validation"];

    const JOURS = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30];

    //attributes
    protected  $arrayDataQueries = array();

    protected $arrayDataChart;

    public $arrayLabelsUserNames;

    /**
     * ChartCreationService constructor that intialize our data attribute.
     *
     *                   
     */
    public function __construct($arrayDataQueries,$arrayLabelsUserNames=null)
    {
        // Transaction mensuelle durant cette année
        $this->arrayDataQueries[0] = $arrayDataQueries[0];
        // Top 10 Transaction mensuelle effectué par utilisateur 
        $this->arrayDataQueries[1] = $arrayDataQueries[1];
        // Progression Du nombre de decaissements menuselle
        $this->arrayDataQueries[2] = $arrayDataQueries[2];
        // Progression Du nombre de transactions menuselle

        // Motifi decaissement durant le mois en cours
        $this->arrayDataQueries[3] = $arrayDataQueries[3];

        $this->arrayLabelsUserNames=$arrayLabelsUserNames;
    }


    /**
     * create grade for an approbateur
     * @return bool
     */
    public function createArrayDataChart($data, $labels, $label, $colors)
    {
        if ($labels != ChartCreationService::TYPEDECAISSEMENT)
            return [
                'labels' => $labels,
                'datasets' => [
                    [
                        'data' => $data,
                        'label' =>  $label,
                        'fill' => true,
                        'lineTension' => 0.1,
                        'backgroundColor' => $colors,
                        'borderColor' => "rgba(75,192,192,1)",
                        'borderCapStyle' => 'butt',
                        'borderDash' => [],
                        'borderDashOffset' => 0.0,
                        'borderJoinStyle' => 'miter',
                        'pointBorderColor' => "rgba(75,192,192,1)",
                        'pointBackgroundColor' => "#fff",
                        'pointBorderWidth' => 1,
                        'pointHoverRadius' => 5,
                        'pointHoverBackgroundColor' => "rgba(75,192,192,1)",
                        'pointHoverBorderColor' => "rgba(220,220,220,1)",
                        'pointHoverBorderWidth' => 2,
                        'pointRadius' => 1,
                        'pointHitRadius' => 10,
                        'spanGaps' => false,




                    ],

                ]
            ];

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'data' => $data,
                    'label' =>  $label,
                    'fill' => true,
                    'lineTension' => 0.1,
                    'backgroundColor' => [
                        'rgb(75,181,67)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 205, 86)',
                    ],
                    'borderColor' => $colors,
                    'borderCapStyle' => 'butt',
                    'borderDash' => [],
                    'borderDashOffset' => 0.0,
                    'borderJoinStyle' => 'miter',
                    'pointBorderColor' => "rgba(75,192,192,1)",
                    'pointBackgroundColor' => "#fff",
                    'pointBorderWidth' => 1,
                    'pointHoverRadius' => 5,
                    'pointHoverBackgroundColor' => "rgba(75,192,192,1)",
                    'pointHoverBorderColor' => "rgba(220,220,220,1)",
                    'pointHoverBorderWidth' => 2,
                    'pointRadius' => 1,
                    'pointHitRadius' => 10,
                    'spanGaps' => false,

                ],

            ]
        ];
    }

    /**
     * This Methode is reponsible on creation of the data chart js With
     * Labels,Label,Colors,data
     * @return array;
     */
    public function run()
    {

        $donutsColors = ["rgb(75,181,67)", 'rgb(255, 99, 132)', 'rgb(255, 205, 86)'];
        $otherChartsColors = "rgba(75,192,192,0.4)";

        for ($i = 0; $i < 4; $i++) {

            switch ($i) {
                case 0:
                    $label = "Nombre Stagiare par mois";
                    $this->arrayDataChart[] = $this->createArrayDataChart($this->arrayDataQueries[0], ChartCreationService::MONTHS, $label, $otherChartsColors);
                    break;
                case 1:

                    $label = "Nombre encadreur par mois";
                    $this->arrayDataChart[] = $this->createArrayDataChart($this->arrayDataQueries[1], ChartCreationService::MONTHS, $label, $otherChartsColors);
                    break;
                case 2:
   
                    $label = "Nombre de specialité par mois";
                    $this->arrayDataChart[] = $this->createArrayDataChart($this->arrayDataQueries[2], ChartCreationService::JOURS, $label, $otherChartsColors);

                    break;
                case 3:
                    $label = ["En cours de stage", "Fin de stage"];
                    $this->arrayDataChart[] = $this->createArrayDataChart($this->arrayDataQueries[3], $label, ChartCreationService::TYPEDECAISSEMENT, $donutsColors);
                    break;
            }
        }

        return $this->arrayDataChart;
    }
}
