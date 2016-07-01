<?php
use Phinx\Migration\AbstractMigration;

class InsuranceMigration extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('insurances');
        $table->addColumn('statecode', 'string', [
            'limit' => '10',
            'null' => false,
        ]);
        $table->addColumn('country', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('eq_site_limit', 'float', [
            'null' => false,
        ]);
        $table->addColumn('hu_site_limit', 'float', [
            'null' => false,
        ]);
        $table->addColumn('fl_site_limit', 'float', [
            'null' => false,
        ]);
        $table->addColumn('fr_site_limit', 'float', [
            'null' => false,
        ]);
        $table->addColumn('tiv_2011', 'float', [
            'null' => false,
        ]);
        $table->addColumn('tiv_2012', 'float', [
            'null' => false,
        ]);
        $table->addColumn('eq_site_deductible', 'float', [
            'null' => false,
        ]);
        $table->addColumn('hu_site_deductible', 'float', [
            'null' => false,
        ]);
        $table->addColumn('fl_site_deductible', 'float', [
            'null' => false,
        ]);
        $table->addColumn('fr_site_deductible', 'float', [
            'null' => false,
        ]);
        $table->addColumn('point_latitude', 'float', [
            'null' => false,
        ]);
        $table->addColumn('point_longitude', 'float', [
            'null' => false,
        ]);
        $table->addColumn('line', 'string', [
            'null' => false,
        ]);
        $table->addColumn('construction', 'string', [
            'null' => false,
        ]);
        $table->addColumn('point_granulity', 'string', [
            'null' => false,
        ]);
        $table->addColumn('created', 'timestamp', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ]);
        $table->addColumn('modified', 'timestamp', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ]);
        $table->create();
    }
}
