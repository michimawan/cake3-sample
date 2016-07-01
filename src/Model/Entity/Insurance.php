<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Insurance Entity.
 *
 * @property int $id
 * @property string $statecode
 * @property string $country
 * @property float $eq_site_limit
 * @property float $hu_site_limit
 * @property float $fl_site_limit
 * @property float $fr_site_limit
 * @property float $tiv_2011
 * @property float $tiv_2012
 * @property float $eq_site_deductible
 * @property float $hu_site_deductible
 * @property float $fl_site_deductible
 * @property float $fr_site_deductible
 * @property float $point_latitude
 * @property float $point_longitude
 * @property string $line
 * @property string $construction
 * @property string $point_granulity
 */
class Insurance extends Entity
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
