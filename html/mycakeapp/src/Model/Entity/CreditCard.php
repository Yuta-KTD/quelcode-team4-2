<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;

/**
 * CreditCard Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $card_number
 * @property string $holder_name
 * @property string $expiration_date
 * @property bool $is_deleted
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\User $user
 */
class CreditCard extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'card_number' => true,
        'holder_name' => true,
        'expiration_date' => true,
        'is_deleted' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];

    // $user_idに値をセットする関数
    public function setUserId($user_id) {
        $this->user_id = $user_id;
        return true;
    }
    // $is_deletedに値をセットする関数
    public function setIsDeleted() {
        $this->is_deleted = 0;
        return true;
    }
}
