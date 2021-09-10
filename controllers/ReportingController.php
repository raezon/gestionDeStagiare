<?php

namespace app\controllers;

use app\models\AuthAssignment;
use app\models\SearchBar;
use app\models\TransactionSearch;
use app\models\User;
use app\repository\BiQuery;
//models
use app\service\ChartCreationService;
use Da\User\Filter\AccessRuleFilter;
//Filter
use Da\User\Traits\ContainerAwareTrait;
//repository
use Yii;
//service
use yii\data\ActiveDataProvider;
//traits
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller as Controller;

class ReportingController extends Controller
{

    use ContainerAwareTrait;

    public $user;

    public $arrayDataQueries;

    public $arrayResultQueries;

    public $arrayDataChartJs;

    public $dates;

    public $listOfUtiliateurs;

    public $dataProviders;

    public function behaviors()
    {
        return [
            'verbs'  => [
                'class'   => VerbFilter::class,
                'actions' => [
                    'delete'                => ['post'],
                    'confirm'               => ['post'],
                    'block'                 => ['post'],
                    //'switch-identity' => ['post','get'],
                    'password-reset'        => ['post'],
                    'force-password-change' => ['post'],
                ],
            ],
            'access' => [
                'class'      => AccessControl::class,
                'ruleConfig' => [
                    'class' => AccessRuleFilter::class,
                ],
                'rules'      => [

                    [
                        'allow'         => true,
                        'roles'         => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return $this->user->isAdmin();
                        },
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return  $this->user->isApprobateur();
                        },
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return  $this->user->isFinancier();
                        },
                    ],
                ],
            ],
        ];
    }

    public function init()
    {

        $this->user = new User();
        // array use for transaction during the month 
        $this->arrayDataQueries[0] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        // array used for yearly transaction
        $this->arrayDataQueries[1] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        // array used for monthly decaissement
        $this->arrayDataQueries[2] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        // array used for donuts
        $this->arrayDataQueries[3] = [0, 0, 0];
        //
        $this->dates = ["", ""];

        parent::init();
    }


    /**
     * Methods responsible on getting the result of queries of the repository BiQuery.
     *
     * @param [type] $class
     * @param [type] $filter
     * @return array
     */
    public function queriesAnswer($class, $date_state = null, $date_end = null, $listOfUtiliateurs = null)
    {
        $arrayQueriesResult = [];
        $methods            = get_class_methods($class);
        $class = new BiQuery($date_state, $date_end, $listOfUtiliateurs);

        foreach ($methods as $method) {
            if ($method != '__construct') {
                $arrayQueriesResult[] = $class->{$method}();
            }
        }
        return $arrayQueriesResult;
    }

    /**
     * Undocumented function
     *
     * @param [type] $arrayResultQueries
     * @return void
     */
    public function objectToArrayData($arrayResultQueries)
    {
        $counter = 0;
        $index   = 0;

        foreach ($arrayResultQueries as $elementResultQueries) {

            if ($counter == 0) {
                foreach ($elementResultQueries as $subElementResultQueries) {
                    $this->arrayDataQueries[0][8] = (int)$subElementResultQueries["count(stagiaire.id)"];
                }
            } else {

                if ($counter == 1) {
                    foreach ($elementResultQueries as $subElementResultQueries) {
                       
                        $this->arrayDataQueries[1][8] = (int)$subElementResultQueries["count(encadreur.id)"];
                       // print_r($this->arrayDataQueries[1]);
                       // die();
                    }
                } else {
                    if ($counter == 2) {
                        foreach ($elementResultQueries as $subElementResultQueries) {
                           
                            $this->arrayDataQueries[2][8] = (int)$subElementResultQueries["count(stagiaire.specialite)"];
                            
                        }
                    } else {
                       /* if ($counter == 3) {
                            foreach ($elementResultQueries as $subElementResultQueries) {
                                if (array_key_exists("status_admin", $subElementResultQueries)) {
                                    switch ($subElementResultQueries["status_admin"]) {
                                        case 0:
                                            $this->arrayDataQueries[3][1] = (int)$subElementResultQueries["count(decaissement.status_admin)"];
                                            break;

                                        case 1:
                                            $this->arrayDataQueries[3][0] = (int)$subElementResultQueries["count(decaissement.status_admin)"];
                                            break;
                                        case 2:
                                            $this->arrayDataQueries[3][2] = (int)$subElementResultQueries["count(decaissement.status_admin)"];
                                            break;
                                    }
                                }
                            }
                        }*/
                    }
                }
            }
            $counter++;
        }
    }
    /**
     * create data provide used in exort data exel
     *
     * @param [type] $searchModel
     * @param [type] $date_start
     * @param [type] $date_end
     * @return object
     */
    public function constructDataProvider($searchModel)
    {

        return $searchModel
            ->search(\Yii::$app->request->queryParams);
    }
    /**
     * loading data after admin fil search bar
     *
     * @param [type] $model
     * @return void
     */
    public function loadingData($model)
    {
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {

            $this->dates[0] = $model->date_start;
            $this->dates[1]   = $model->date_end;
            $this->listOfUtiliateurs = $model->users;
        }
    }

    /**
     * function return the main view of reporting
     *
     * @return void
     */
    public function actionIndex($filter = null)
    {

        $model        = new SearchBar();
       
        $this->loadingData($model);
        $this->arrayResultQueries = $this->queriesAnswer(BiQuery::class, $this->dates[0], $this->dates[1], $this->listOfUtiliateurs);
        //construction of data provider used in export xls csv
    //    $searchModel         = $this->make(TransactionSearch::class);
    //    $this->dataProviders = $this->constructDataProvider($searchModel);
        //construction of data used in js
        $this->objectToArrayData($this->arrayResultQueries);
        $this->arrayDataChartJs = Yii::$app->controller->make(ChartCreationService::class, [$this->arrayDataQueries])->run();

        return $this->render(
            '/reporting/index',
            [

                'dailyTransactionOfCurentMonth' => $this->arrayDataChartJs[0],
                'yearlyTransactions'            => $this->arrayDataChartJs[1],
                'dailyDecaissementRequest'      => $this->arrayDataChartJs[2],
      //          'monthlyMotifyDecaissements'    => $this->arrayDataChartJs[3],
                'dataProviders'                 => $this->dataProviders,
                'model'                         => $model,
              
            ]
        );
    }
}
