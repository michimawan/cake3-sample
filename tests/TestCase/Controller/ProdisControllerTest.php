<?php
namespace App\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use App\Controller\ProdisController;
use Cake\TestSuite\IntegrationTestCase;

use App\Model\Entity\Prodi;
/**
 * App\Controller\ProdisController Test Case
 */
class ProdisControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.prodis',
        'app.students'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/prodis/index');
        $this->assertResponseOk();
        $prodis = $this->viewVariable('prodis');
        // $this->assertInstanceOf(Prodi::class, get_class($prodis->first()));
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView_not_found_redirect_to_index()
    {
        $this->get('/prodis/view/3');
        $this->assertResponseSuccess();
        // $prodi = $this->viewVariable('prodi');
        // $this->assertInstanceOf(Prodi::class, get_class($prodi));
        $this->assertRedirect('/prodis');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView_found()
    {
        $this->get('/prodis/view/1');
        $this->assertResponseOk();
        $prodi = $this->viewVariable('prodi');
        // $this->assertInstanceOf(Prodi::class, get_class($prodi));
    }

    /**
     * Test add:get method
     *
     * @return void
     */
    public function testAddGet()
    {
        $this->get('/prodis/add');
        $this->assertResponseOk();
        $prodi = $this->viewVariable('prodi');
        // $this->assertInstanceOf(Prodi::class, get_class($prodi));
    }

    /**
     * Test add:post method
     *
     * @return void
     */
    public function testAddPost()
    {
        $data = [
            'code' => 'Test Add',
            'name' => 'Lorem ipsum dolor sit amet',
            'created' => 1466787971,
            'modified' => 1466787971
        ];
        $prodis = TableRegistry::get('Prodis');
        $prodisCount = $prodis->find()->count();

        $this->post('/prodis/add', $data);
        $this->assertResponseSuccess();
        $this->assertRedirectContains('/prodis');

        $query = $prodis->find()->where(['code' => $data['code']]);
        $this->assertEquals($prodisCount + 1, $prodis->find()->count());
        $this->assertEquals(1, $query->count());
    }

    /**
     * Test edit:get method
     *
     * @return void
     */
    public function testEdit_get()
    {
        $this->get('/prodis/edit/1');
        $this->assertResponseOk();
        $prodi = $this->viewVariable('prodi');
        // $this->assertInstanceOf(Prodi::class, get_class($prodi));
    }

    /**
     * Test edit:get method
     *
     * @return void
     */
    public function testEdit_get_not_found_redirect_to_index()
    {
        $this->get('/prodis/edit/4');
        $this->assertResponseSuccess();
        $this->assertRedirectContains('/prodis');
        // $this->assertInstanceOf(Prodi::class, get_class($prodi));
    }

    /**
     * Test edit:post|put|patch method
     *
     * @return void
     */
    public function testEditPut()
    {
        $prodis = TableRegistry::get('Prodis');
        $prodisCount = $prodis->find()->count();
        $prodi = $prodis->find()->first();
        $prodi->code = 'Edited Prodi';
        $data = $prodi->toArray();

        $this->put('/prodis/edit/' . $data['id'], $data);
        $this->assertResponseSuccess();
        $this->assertRedirectContains('/prodis');

        $query = $prodis->find()->where(['code' => 'Edited Prodi']);
        $this->assertEquals($prodisCount, $prodis->find()->count());
        $this->assertEquals(1, $query->count());
    }

    /**
     * Test edit:post|put|patch method
     *
     * @return void
     */
    public function testEditPut_failed_to_save_change()
    {
        $prodis = TableRegistry::get('Prodis');
        $prodi = $prodis->find()->first();
        $prodi->code = null;
        $data = $prodi->toArray();

        $this->put('/prodis/edit/' . $data['id'], $data);
        $this->assertNoRedirect();
        $prodiView = $this->viewVariable('prodi');
        $this->assertEquals($prodiView['id'], $prodi['id']);
    }

    /**
     * Test delete:get method
     *
     * @return void
     */
    public function testDelete_failed_caused_accessed_byGet()
    {
        $prodis = TableRegistry::get('Prodis');
        $prodiCount = $prodis->find()->count();

        $prodi = $prodis->find()->first();
        $data = $prodi->toArray();

        $this->get('/prodis/delete/' . $data['id']);
        $this->assertResponseSuccess();
        $this->assertRedirectContains('/prodis');
        $this->assertEquals($prodiCount, $prodis->find()->count());
    }

    /**
     * Test delete:get method
     *
     * @return void
     */
    public function testDelete_failed_data_not_found()
    {
        $prodis = TableRegistry::get('Prodis');
        $prodiCount = $prodis->find()->count();

        $this->post('/prodis/delete/100');
        $this->assertResponseSuccess();
        $this->assertRedirectContains('/prodis');
        $this->assertEquals($prodiCount, $prodis->find()->count());
    }

    /**
     * Test delete:post method
     *
     * @return void
     */
    public function testDelete()
    {
        $prodis = TableRegistry::get('Prodis');
        $prodiCount = $prodis->find()->count();

        $prodi = $prodis->find()->first();
        $data = $prodi->toArray();

        $this->post('/prodis/delete/' . $data['id'], $data);
        $this->assertResponseSuccess();
        $this->assertRedirectContains('/prodis');
        $this->assertEquals($prodiCount - 1, $prodis->find()->count());
    }
}
