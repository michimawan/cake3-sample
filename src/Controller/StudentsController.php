<?php
namespace App\Controller;

use Exception;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 */
class StudentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $students = $this->paginate($this->Students->find()->contain(['Prodis']));

        $this->set(compact('students'));
        $this->set('_serialize', ['students']);
    }

    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        try {
            $student = $this->Students->get($id, [
                'contain' => ['Prodis']
            ]);
        } catch (Exception $e) {
            $this->Flash->error('No Student with ID ' . $id);
            return $this->redirect(['action' => 'index']);
        }

        $this->set('student', $student);
        $this->set('_serialize', ['student']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $student = $this->Students->newEntity();
        if ($this->request->is('post')) {
            $this->request = $this->upload($this->request);
            $student = $this->Students->patchEntity($student, $this->request->data);

            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The student could not be saved. Please, try again.'));
            }
        }

        $prodis = $this->Students->Prodis->find('list')->select(['id', 'name']);
        $this->set(compact('student', 'prodis'));
        $this->set('_serialize', ['student']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        try {
            $student = $this->Students->get($id, []);
        } catch (Exception $e) {
            $this->Flash->error('No Student with ID ' . $id);
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request = $this->upload($this->request);
            $student = $this->Students->patchEntity($student, $this->request->data);

            $saveStatus = $this->Students->save($student);
            if ($saveStatus) {
                $this->Flash->success(__('The student has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The student could not be saved. Please, try again.'));
            }
        }
        $prodis = $this->Students->Prodis->find()->combine('id', 'name');
        $this->set(compact('student', 'prodis'));
        $this->set('_serialize', ['student']);
    }

    private function doUpload(array $file)
    {
        $ext = substr(strrchr(strtolower($file['name']),'.'),1);
        if (in_array($ext, array('jpg','jpeg','png','gif'))) {
            $fullpath = getcwd() . DS . 'img' . DS . 'students' . DS;
            move_uploaded_file($file['tmp_name'], $fullpath . $file['name']);
            return true;
        }
        return false;
    }

    private function upload($request)
    {
        if ($request->data['photo']['tmp_name']) {
            $file = $request->data['photo'];

            $uploadStatus = $this->doUpload($file);

            if ($uploadStatus) {
                $request->data['file_name'] = $file['name'];
                $request->data['file_path'] = DS . 'img' . DS . 'students' . DS . $file['name'];
                $request->data['mime_type'] = $file['type'];
            }

        }

        return $request;
    }

    public function getimage($id = null)
    {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $student = $this->Students->get($id);
            if ($student) {
                $image = [
                    'path' => $student->file_path
                ];
                echo json_encode($image);
            } else {
                echo "not found";
            }
        } else {
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        try {
            $this->request->allowMethod(['post']);
            $student = $this->Students->get($id);
        } catch (Exception $e) {
            $this->Flash->error('No Student with ID ' . $id);
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Students->delete($student)) {
            $this->Flash->success(__('The student has been deleted.'));
        } else {
            $this->Flash->error(__('The student could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
