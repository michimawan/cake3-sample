<?php
namespace App\Controller;

use Exception;
use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Insurances Controller
 *
 * @property \App\Model\Table\InsurancesTable $Insurances
 */
class InsurancesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Api method
     *
     * @param string|null $id Insurance id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function id($id = null)
    {
        $insurance = $this->Insurances->find()->where(['id' => $id])->first();

        $this->set('insurance', json_encode($insurance));
    }

    /**
     * Api method
     *
     * @param string|null $country Insurance country.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function country($country = null)
    {
        $insurances = $this->Insurances->find()->where(['country' => $country])->all();

        if ($insurances->count() == 0)
            $insurances = null;

        $this->set('insurances', json_encode($insurances));
    }

    /**
     * Api method
     *
     * @param string|null $country Insurance country.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function countrySummary($country = null)
    {
        $query = $this->Insurances->find();
        $insurance = $query
            ->where(['country' => $country])
            ->select([
                'statecode',
                'country',
                'eq_site_limit' => $query->func()->sum('eq_site_limit'),
                'hu_site_limit' => $query->func()->sum('hu_site_limit'),
                'fl_site_limit' => $query->func()->sum('fl_site_limit'),
                'fr_site_limit' => $query->func()->sum('fr_site_limit'),
                'tiv_2011' => $query->func()->sum('tiv_2011'),
                'tiv_2012' => $query->func()->sum('tiv_2012'),
                'eq_site_deductible' => $query->func()->sum('eq_site_deductible'),
                'hu_site_deductible' => $query->func()->sum('hu_site_deductible'),
                'fl_site_deductible' => $query->func()->sum('fl_site_deductible'),
                'fr_site_deductible' => $query->func()->sum('fr_site_deductible'),
                'point_latitude' => $query->func()->sum('point_latitude'),
                'point_longitude' => $query->func()->sum('point_longitude'),
            ])
            ->all();

        $this->set('insurance', json_encode($insurance));
    }

    public function beforeRender(Event $event)
    {
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');
        $this->set('_serialize', true);
    }

}
