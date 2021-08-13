<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Stagiaire;

/**
 * app\models\StagiaireSearch represents the model behind the search form about `app\models\Stagiaire`.
 */
 class StagiaireSearch extends Stagiaire
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nom', 'prenom', 'age', 'niveaux', 'email', 'numr_telephone', 'adress', 'specialite'], 'safe'],
            [['id_encadreur', 'id_stage', 'id_centre_etude'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Stagiaire::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_encadreur' => $this->id_encadreur,
            'id_stage' => $this->id_stage,
            'id_centre_etude' => $this->id_centre_etude,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'nom', $this->nom])
            ->andFilterWhere(['like', 'prenom', $this->prenom])
            ->andFilterWhere(['like', 'age', $this->age])
            ->andFilterWhere(['like', 'niveaux', $this->niveaux])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'numr_telephone', $this->numr_telephone])
            ->andFilterWhere(['like', 'adress', $this->adress])
            ->andFilterWhere(['like', 'specialite', $this->specialite]);

        return $dataProvider;
    }
}
