<?php

use Phinx\Migration\AbstractMigration;

class ProdisMigration extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('prodis');
        $table->addColumn('code', 'string', [
            'limit' => '20',
            'null' => false,
        ]);
        $table->addColumn('name', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('created', 'timestamp', [
            'null' => false,
        ]);
        $table->addColumn('modified', 'timestamp', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ]);
        $table->create();

    }
}
