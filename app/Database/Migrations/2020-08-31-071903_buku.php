<?php 

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Buku extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'auto_increment' => true,
			],
			'judul'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '200',
			],
			'pengarang'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '200',
			],
			'penerbit'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '200',
			],
			'image'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
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
		$this->forge->addKey('id', true);
		$this->forge->createTable('tbl_buku');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_buku');
	}
}
