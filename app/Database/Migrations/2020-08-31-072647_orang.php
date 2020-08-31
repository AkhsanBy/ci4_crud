<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Orang extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'nama'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '200',
			],
			'nik'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'alamat'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '200',
			],
			'created_at'       => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'updated_at'       => [
				'type'           => 'DATETIME',
				'null'           => true,
			]			
		]);
		$this->forge->addKey('nik', true);
		$this->forge->createTable('tbl_orang');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_orang');
	}
}
