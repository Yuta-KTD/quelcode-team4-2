<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MovieSchedules Model
 *
 * @property \App\Model\Table\MoviesTable&\Cake\ORM\Association\BelongsTo $Movies
 *
 * @method \App\Model\Entity\MovieSchedule get($primaryKey, $options = [])
 * @method \App\Model\Entity\MovieSchedule newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MovieSchedule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MovieSchedule|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MovieSchedule saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MovieSchedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MovieSchedule[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MovieSchedule findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MovieSchedulesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('movie_schedules');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Movies', [
            'foreignKey' => 'movie_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->dateTime('screening_start_datetime')
            ->requirePresence('screening_start_datetime', 'create')
            ->notEmptyDateTime('screening_start_datetime');

        $validator
            ->boolean('is_playable')
            ->requirePresence('is_playable', 'create')
            ->notEmptyString('is_playable');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['movie_id'], 'Movies'));

        return $rules;
    }

    /**
     * 映画の選択欄に、上映中のもののみ表示させるmethod
     * @return Cake\ORM\Query 上映終了日が今日以降の映画レコードのidとtitleのリスト
     */
    public function findScreeningNow()
    {
        $today = date("Y-m-d 00:00:00");
        $query = $this->Movies->find('list');
        $screeningNow = $query->select('screening_end_date')->where(['screening_end_date >=' => $today]);
        return $screeningNow;
    }
}
