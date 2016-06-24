<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Student Entity.
 *
 * @property int $id
 * @property int $nim
 * @property string $name
 * @property int $prodi_id
 * @property \App\Model\Entity\Prodi $prodi
 * @property string $file_name
 * @property string $file_path
 * @property string $mime_type
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Student extends Entity
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
        '*' => true,
        'id' => false,
    ];
}
