<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\UserTypes]].
 *
 * @see \app\models\UserTypes
 */
class UserTypesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\UserTypes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\UserTypes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
