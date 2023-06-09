<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CsvFile Entity
 *
 * @property int $id
 * @property string $name
 * @property string $table_name
 * @property int|null $num_rows
 * @property string|null $status
 * @property string|null $error_message
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class CsvFile extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'name' => true,
        'table_name' => true,
        'num_rows' => true,
        'status' => true,
        'error_message' => true,
        'created' => true,
        'modified' => true,
    ];
}
