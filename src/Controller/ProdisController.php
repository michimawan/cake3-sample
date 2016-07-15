<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Prodis Controller
 *
 * @property \App\Model\Table\ProdisTable $Prodis
 */
class ProdisController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $prodis = $this->paginate($this->Prodis);

        $this->set(compact('prodis'));
        $this->set('_serialize', ['prodis']);
    }

    /**
     * View method
     *
     * @param string|null $id Prodi id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        try {
        $prodi = $this->Prodis->get($id, [
            'contain' => ['Students']
        ]);
        } catch (\Exception $e) {
            $this->Flash->success(__('The prodi with that ID does not exist'));
            return $this->redirect(['action' => 'index']);
        }

        $this->set('prodi', $prodi);
        $this->set('_serialize', ['prodi']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $prodi = $this->Prodis->newEntity();
        if ($this->request->is('post')) {
            $prodi = $this->Prodis->patchEntity($prodi, $this->request->data);
            if ($this->Prodis->save($prodi)) {
                $this->Flash->success(__('The prodi has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The prodi could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('prodi'));
        $this->set('_serialize', ['prodi']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Prodi id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        try {
            $prodi = $this->Prodis->get($id, [
                'contain' => []
            ]);
        } catch (\Exception $e) {
            $this->Flash->success(__('There is no prodi as requested'));
            return $this->redirect(['action' => 'index']);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $prodi = $this->Prodis->patchEntity($prodi, $this->request->data);
            if ($this->Prodis->save($prodi)) {
                $this->Flash->success(__('The prodi has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The prodi could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('prodi'));
        $this->set('_serialize', ['prodi']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Prodi id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @throws \Cake\Network\Exception\MethodNotAllowedException When not using post
     */
    public function delete($id = null)
    {
        try {
            $this->request->allowMethod(['post']);
            $prodi = $this->Prodis->get($id);
        } catch (\Exception $e) {
            return $this->redirect(['action' => 'index']);
        }
        if ($this->Prodis->delete($prodi)) {
            $this->Flash->success(__('The prodi has been deleted.'));
        } else {
            $this->Flash->error(__('The prodi could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
