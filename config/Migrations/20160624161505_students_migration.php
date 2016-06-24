<?php

use Phinx\Migration\AbstractMigration;

class StudentsMigration extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('students');
        $table->addColumn('nim', 'integer', [
            'null' => false,
        ]);
        $table->addColumn('name', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('prodi_id', 'integer', [
            'null' => false,
        ]);
        $table->addColumn('file_name', 'text', [
            'null' => false,
        ]);
        $table->addColumn('file_path', 'text', [
            'null' => false,
        ]);
        $table->addColumn('mime_type', 'text', [
            'null' => false,
        ]);
        $table->addColumn('created', 'timestamp', [
            'null' => false,
        ]);
        $table->addColumn('modified', 'timestamp', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ]);
        $table->addIndex(['name', 'prodi_id', 'nim']);
        $table->create();
    }
}
