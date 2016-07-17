<?php
namespace App\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use App\Controller\StudentsController;
use Cake\TestSuite\IntegrationTestCase;

use App\Model\Entity\Student;
/**
 * App\Controller\StudentsController Test Case
 */
class StudentsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.students',
        'app.prodis'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/students/index');
        $this->assertResponseOk();
        $students = $this->viewVariable('students');
        // $this->assertInstanceOf(Student::class, get_class($students->first()));
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView_not_found_redirect_to_index()
    {
        $this->get('/students/view/4');
        $this->assertResponseSuccess();
        // $student = $this->viewVariable('student');
        // $this->assertInstanceOf(Student::class, get_class($student));
        $this->assertRedirect('/students');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView_found()
    {
        $this->get('/students/view/1');
        $this->assertResponseOk();
        $student = $this->viewVariable('student');
        // $this->assertInstanceOf(Student::class, get_class($student));
    }

    /**
     * Test add:get method
     *
     * @return void
     */
    public function testAddGet()
    {
        $this->get('/students/add');
        $this->assertResponseOk();
        $student = $this->viewVariable('student');
        // $this->assertInstanceOf(Student::class, get_class($student));
    }

    /**
     * Test add:post method
     *
     * @return void
     */
    public function testAddPost_fail_to_save()
    {
        $students = TableRegistry::get('students');
        $studentsCount = $students->find()->count();
        $student = $students->find()->first();
        $data = [
            'nim' => $student->id,
            'name' => 'Third Student',
            'photo' => [
                'tmp_name' => 'foo',
                'name' => 'foo',
            ],
            'created' => 1466787971,
            'modified' => 1466787971
        ];

        $this->post('/students/add', $data);
        $this->assertNoRedirect();

        $query = $students->find()->where(['name' => $data['name']]);
        $this->assertEquals($studentsCount, $students->find()->count());
    }

    /**
     * Test add:post method
     *
     * @return void
     */
    public function testAddPost()
    {
        $prodis = TableRegistry::get('prodis');
        $prodi = $prodis->find()->first();

        $data = [
            'nim' => '99',
            'name' => 'Third Student',
            'prodi_id' => $prodi->id,
            'photo' => [
                'tmp_name' => 'foo',
                'name' => 'foo',
                'type' => 'foo',
            ],
            'created' => 1466787971,
            'modified' => 1466787971
        ];
        $students = TableRegistry::get('students');
        $studentsCount = $students->find()->count();
        $lastStudent = $students->find()->order('id')->last();

        $data['nim'] = $lastStudent->nim + 99;
        $this->post('/students/add', $data);
        $this->assertResponseSuccess();
        $this->assertRedirectContains('/students');

        $query = $students->find()->where(['name' => $data['name']]);
        $this->assertEquals(1, $query->count());
        $this->assertEquals($studentsCount + 1, $students->find()->count());
    }

    /**
     * Test edit:get method
     *
     * @return void
     */
    public function testEdit_get()
    {
        $this->get('/students/edit/1');
        $this->assertResponseOk();
        $student = $this->viewVariable('student');
        // $this->assertInstanceOf(Student::class, get_class($student));
    }

    /**
     * Test edit:get method
     *
     * @return void
     */
    public function testEdit_get_not_found_redirect_to_index()
    {
        $this->get('/students/edit/4');
        $this->assertResponseSuccess();
        $this->assertRedirectContains('/students');
        // $this->assertInstanceOf(Student::class, get_class($student));
    }

    /**
     * Test edit:post|put|patch method
     *
     * @return void
     */
    public function testEditPut()
    {
        $students = TableRegistry::get('students');
        $studentsCount = $students->find()->count();
        $student = $students->find()->first();
        $student->name = 'Edited Student';
        $data = $student->toArray();
        $data = array_merge($data, 
            ['photo' => [
                'tmp_name' => 'foo',
                'name' => 'foo',
                'type' => 'foo',
            ]]
        );

        $this->put('/students/edit/' . $data['id'], $data);
        $this->assertResponseSuccess();
        $this->assertRedirectContains('/students');

        $query = $students->find()->where(['name' => 'Edited student']);
        $this->assertEquals($studentsCount, $students->find()->count());
        $this->assertEquals(1, $query->count());
    }

    /**
     * Test delete:get method
     *
     * @return void
     */
    public function testDelete_failed_caused_accessed_byGet()
    {
        $students = TableRegistry::get('Students');
        $studentCount = $students->find()->count();

        $student = $students->find()->first();
        $data = $student->toArray();

        $this->get('/students/delete/' . $data['id']);
        $this->assertResponseSuccess();
        $this->assertRedirectContains('/students');
        $this->assertEquals($studentCount, $students->find()->count());
    }

    /**
     * Test delete:get method
     *
     * @return void
     */
    public function testDelete_failed_data_not_found()
    {
        $students = TableRegistry::get('Students');
        $studentCount = $students->find()->count();

        $this->post('/students/delete/100');
        $this->assertResponseSuccess();
        $this->assertRedirectContains('/students');
        $this->assertEquals($studentCount, $students->find()->count());
    }

    /**
     * Test delete:post method
     *
     * @return void
     */
    public function testDelete()
    {
        $students = TableRegistry::get('Students');
        $studentCount = $students->find()->count();

        $student = $students->find()->first();
        $data = $student->toArray();

        $this->post('/students/delete/' . $data['id'], $data);
        $this->assertResponseSuccess();
        $this->assertRedirectContains('/students');
        $this->assertEquals($studentCount - 1, $students->find()->count());
    }
}
