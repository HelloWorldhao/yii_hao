<?php

use yii\db\Migration;

class m170222_035806_migration extends Migration
{
    public function up()
    {
		$this->execute('SET foreign_key_checks = 0');
 
$this->createTable('{{%auth_assignment}}', [
	'item_name' => 'VARCHAR(64) NOT NULL',
	'user_id' => 'VARCHAR(64) NOT NULL',
	'created_at' => 'INT(11) NULL',
	'PRIMARY KEY (`item_name`,`user_id`)'
], "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB");
 
$this->createTable('{{%auth_item}}', [
	'name' => 'VARCHAR(64) NOT NULL',
	'type' => 'SMALLINT(6) NOT NULL',
	'description' => 'TEXT NULL',
	'rule_name' => 'VARCHAR(64) NULL',
	'data' => 'BLOB NULL',
	'created_at' => 'INT(11) NULL',
	'updated_at' => 'INT(11) NULL',
	'PRIMARY KEY (`name`)'
], "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB");
 
$this->createIndex('rule_name','{{%auth_item}}','rule_name',0);
$this->createIndex('type','{{%auth_item}}','type',0);
 
$this->createTable('{{%auth_item_child}}', [
	'parent' => 'VARCHAR(64) NOT NULL',
	'child' => 'VARCHAR(64) NOT NULL',
	'PRIMARY KEY (`parent`,`child`)'
], "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB");
 
$this->createIndex('child','{{%auth_item_child}}','child',0);
 
$this->createTable('{{%auth_rule}}', [
	'name' => 'VARCHAR(64) NOT NULL',
	'data' => 'BLOB NULL',
	'created_at' => 'INT(11) NULL',
	'updated_at' => 'INT(11) NULL',
	'PRIMARY KEY (`name`)'
], "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB");
 
$this->createTable('{{%author}}', [
	'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
	'pseudonym' => 'VARCHAR(128) NOT NULL',
	'userid' => 'INT(11) NOT NULL',
	'PRIMARY KEY (`id`)'
], "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB");
 
$this->createTable('{{%comment}}', [
	'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
	'content' => 'TEXT NOT NULL',
	'status' => 'INT(11) NOT NULL',
	'create_time' => 'INT(11) NULL',
	'userid' => 'INT(11) NOT NULL',
	'novel_id' => 'INT(11) NOT NULL',
	'PRIMARY KEY (`id`)'
], "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB");
 
$this->createTable('{{%menu}}', [
	'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
	'name' => 'VARCHAR(128) NOT NULL',
	'parent' => 'INT(11) NULL',
	'route' => 'VARCHAR(256) NULL',
	'order' => 'INT(11) NULL',
	'data' => 'TEXT NULL',
	'PRIMARY KEY (`id`)'
], "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB");
 
$this->createIndex('parent','{{%menu}}','parent',0);
 
$this->createTable('{{%migration}}', [
	'version' => 'VARCHAR(180) NOT NULL',
	'apply_time' => 'INT(11) NULL',
	'PRIMARY KEY (`version`)'
], "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB");
 
$this->createTable('{{%novel}}', [
	'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
	'title' => 'VARCHAR(128) NOT NULL',
	'content' => 'TEXT NOT NULL',
	'tags' => 'TEXT NOT NULL',
	'status' => 'INT(11) NOT NULL',
	'is_top' => 'SMALLINT(1) NOT NULL DEFAULT \'0\'',
	'is_hot' => 'SMALLINT(1) NOT NULL DEFAULT \'0\'',
	'is_best' => 'SMALLINT(1) NOT NULL DEFAULT \'0\'',
	'create_time' => 'INT(11) NULL',
	'update_time' => 'INT(11) NULL',
	'author_id' => 'INT(11) NOT NULL',
	'PRIMARY KEY (`id`)'
], "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB");
 
$this->createTable('{{%tag}}', [
	'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
	'name' => 'VARCHAR(128) NOT NULL',
	'frequency' => 'INT(11) NOT NULL DEFAULT \'1\'',
	'PRIMARY KEY (`id`)'
], "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB");
 
$this->createTable('{{%user}}', [
	'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
	'username' => 'VARCHAR(255) NOT NULL',
	'pseudonym' => 'VARCHAR(128) NOT NULL',
	'auth_key' => 'VARCHAR(32) NOT NULL',
	'password_hash' => 'VARCHAR(255) NOT NULL',
	'password_reset_token' => 'VARCHAR(255) NULL',
	'email' => 'VARCHAR(255) NOT NULL',
	'status' => 'SMALLINT(6) NOT NULL DEFAULT \'10\'',
	'created_at' => 'INT(11) NOT NULL',
	'updated_at' => 'INT(11) NOT NULL',
	'PRIMARY KEY (`id`)'
], "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB");
 
$this->createIndex('username','{{%user}}','username',1);
$this->createIndex('email','{{%user}}','email',1);
$this->createIndex('password_reset_token','{{%user}}','password_reset_token',1);
 
$this->addForeignKey('auth_assignment_ibfk_1', '{{%auth_assignment}}', 'item_name', '{{%auth_item}}', 'name', 'CASCADE', 'CASCADE' );
$this->addForeignKey('auth_item_ibfk_1', '{{%auth_item}}', 'rule_name', '{{%auth_rule}}', 'name', 'SET NULL', 'CASCADE' );
$this->addForeignKey('auth_item_child_ibfk_1', '{{%auth_item_child}}', 'parent', '{{%auth_item}}', 'name', 'CASCADE', 'CASCADE' );
$this->addForeignKey('auth_item_child_ibfk_2', '{{%auth_item_child}}', 'child', '{{%auth_item}}', 'name', 'CASCADE', 'CASCADE' );
$this->addForeignKey('menu_ibfk_1', '{{%menu}}', 'parent', '{{%menu}}', 'id', 'SET NULL', 'CASCADE' );
 
$this->execute('SET foreign_key_checks = 1;');
$this->execute('SET foreign_key_checks = 0');
 
/* Table auth_assignment */
$this->batchInsert('{{%auth_assignment}}',['item_name','user_id','created_at'],[['普通管理员','3','1487659336'],
['站长','1','1487658283'],
]);
 
/* Table auth_item */
$this->batchInsert('{{%auth_item}}',['name','type','description','rule_name','data','created_at','updated_at'],[[' 测试','2',null,null,null,'1487659162','1487735265'],
['/admin/assignment/*','2',null,null,null,'1487658031','1487658031'],
['/admin/assignment/index','2',null,null,null,'1487658480','1487658480'],
['/admin/default/index','2',null,null,null,'1487659074','1487659074'],
['/admin/menu/*','2',null,null,null,'1487658490','1487658490'],
['/admin/menu/index','2',null,null,null,'1487658494','1487658494'],
['/admin/permission/*','2',null,null,null,'1487658047','1487658047'],
['/admin/permission/index','2',null,null,null,'1487658498','1487658498'],
['/admin/role/*','2',null,null,null,'1487658051','1487658051'],
['/admin/role/index','2',null,null,null,'1487658502','1487658502'],
['/admin/route/*','2',null,null,null,'1487658054','1487658054'],
['/admin/route/index','2',null,null,null,'1487658509','1487658509'],
['/comment/*','2',null,null,null,'1487659581','1487659581'],
['/comment/index','2',null,null,null,'1487659588','1487659588'],
['/debug/*','2',null,null,null,'1487659081','1487659081'],
['/debug/default/index','2',null,null,null,'1487659094','1487659094'],
['/gii/*','2',null,null,null,'1487659070','1487659070'],
['/gii/default/index','2',null,null,null,'1487659111','1487659111'],
['/migration/*','2',null,null,null,'1487735249','1487735249'],
['/novel/*','2',null,null,null,'1487659568','1487659568'],
['/novel/index','2',null,null,null,'1487659576','1487659576'],
['/tag/*','2',null,null,null,'1487659557','1487659557'],
['/tag/index','2',null,null,null,'1487659564','1487659564'],
['/user/*','2',null,null,null,'1487659542','1487659542'],
['/user/index','2',null,null,null,'1487659554','1487659554'],
['内容','2',null,null,null,'1487659623','1487659623'],
['普通管理员','1',null,null,null,'1487659305','1487659305'],
['权限控制','2',null,null,null,'1487658159','1487658557'],
['站长','1',null,null,null,'1487658253','1487659657'],
]);
 
/* Table auth_item_child */
$this->batchInsert('{{%auth_item_child}}',['parent','child'],[['普通管理员',' 测试'],
['站长',' 测试'],
['普通管理员','/admin/assignment/*'],
['权限控制','/admin/assignment/*'],
['权限控制','/admin/menu/*'],
['权限控制','/admin/permission/*'],
['权限控制','/admin/role/*'],
['权限控制','/admin/route/*'],
['内容','/comment/*'],
[' 测试','/debug/*'],
[' 测试','/gii/*'],
[' 测试','/migration/*'],
['内容','/novel/*'],
['内容','/tag/*'],
['内容','/user/*'],
['站长','内容'],
['站长','权限控制'],
]);
 
/* Table auth_rule */
$this->batchInsert('{{%auth_rule}}',['name','data','created_at','updated_at'],[]);
 
/* Table author */
$this->batchInsert('{{%author}}',['id','pseudonym','userid'],[['1','三生三世十里桃花','3'],
]);
 
/* Table comment */
$this->batchInsert('{{%comment}}',['id','content','status','create_time','userid','novel_id'],[['3','真漂亮','1',null,'3','16'],
]);
 
/* Table menu */
$this->batchInsert('{{%menu}}',['id','name','parent','route','order','data'],[['1','权限控制',null,null,'1','{"icon":"fa fa-lock","visible":true}'],
['2','路由','1','/admin/route/index','1',null],
['3','权限','1','/admin/permission/index','2',null],
['4','角色','1','/admin/role/index','3',null],
['5','分配','1','/admin/assignment/index','4',null],
['6','菜单','1','/admin/menu/index','5',null],
['7','测试',null,null,'2',null],
['8','gii','7','/gii/default/index','1',null],
['9','debug','7','/debug/default/index','2',null],
['10','内容',null,null,'3',null],
['11','用户管理','10','/user/index','2','{"icon":"fa fa-user","visible":true}'],
['12','文章管理','10','/novel/index','1','{"icon":"fa fa-book","visible":true}'],
['13','评论管理','10','/comment/index','2','{"icon":"fa fa-clipboard","visible":true}'],
['14','标签管理','10','/tag/index','3','{"icon":"fa fa-tags","visible":true}'],
]);
 
/* Table migration */
$this->batchInsert('{{%migration}}',['version','apply_time'],[['m000000_000000_base','1486960791'],
['m130524_201442_init','1486960793'],
]);
 
/* Table novel */
$this->batchInsert('{{%novel}}',['id','title','content','tags','status','is_top','is_hot','is_best','create_time','update_time','author_id'],[['16','123','123123','13','2','1','0','0','1487580884','1487730633','3'],
]);
 
/* Table tag */
$this->batchInsert('{{%tag}}',['id','name','frequency'],[['13','mysql','1'],
['14','php','0'],
['16','yii','0'],
['17','javascript','0'],
['18','html','0'],
['19','杂记','0'],
['21','13','0'],
]);
 
/* Table user */
$this->batchInsert('{{%user}}',['id','username','pseudonym','auth_key','password_hash','password_reset_token','email','status','created_at','updated_at'],[['1','admin','admin','NvaYY0LjTKyp7JSI_8us8F7j7vhXJc3b','$2y$13$28dBdBqwSwmsqXLjPMXJd.MX2534mAfhEuZCldaBHZKJiuaEdE4Ji',null,'admin@163.com','1','1486960848','1487213465'],
['3','朱则浩','三生三世十里桃花','NvaYY0LjTKyp7JSI_8us8F7j7vhXJc3b','$2y$13$1rznNkYsq4TlSCUpoXMqUOyaY7gJ1BU5ARNQGCZtFcgIdv.XKKrqq',null,'zhuzehao@163.com','1','1486960848','1486960848'],
]);
 
$this->execute('SET foreign_key_checks = 1;');    }

    public function down()
    {
    
    	        $this->execute('SET foreign_key_checks = 0');
$this->dropTable('{{%user}}');
$this->dropTable('{{%user}}');
$this->dropTable('{{%user}}');
$this->dropTable('{{%user}}');
$this->dropTable('{{%user}}');
$this->dropTable('{{%user}}');
$this->dropTable('{{%user}}');
$this->dropTable('{{%user}}');
$this->dropTable('{{%user}}');
$this->dropTable('{{%user}}');
$this->dropTable('{{%user}}');
$this->execute('SET foreign_key_checks = 1;');		    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
