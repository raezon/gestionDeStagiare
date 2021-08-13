<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Encadreur;

/**
 * app\models\EncadreurSearch represents the model behind the search form about `app\models\Encadreur`.
 */
 class EncadreurSearch extends Encadreur
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_departement'], 'integer'],
            [['nom', 'prenom', 'id_encadreur', 'email', 'statu', 'numr_telephone'], 'safe'],
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
        $query = Encadreur::find();

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
            'id' => $this->id,
            'id_departement' => $this->id_departement,
        ]);

        $query->andFilterWhere(['like', 'nom', $this->nom])
            ->andFilterWhere(['like', 'prenom', $this->prenom])
            ->andFilterWhere(['like', 'id_encadreur', $this->id_encadreur])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'statu', $this->statu])
            ->andFilterWhere(['like', 'numr_telephone', $this->numr_telephone]);

        return $dataProvider;
    }
}
