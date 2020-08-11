<?php

use yii\db\Migration;

/**
 * Class m200810_030306_create_table_affiliate_faq_category
 */
class m200810_025711_create_table_faq_faq_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%faq_faq_category}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull()->unique(),
            'status' => $this->integer(1)->defaultValue(1)->comment('0: Không hiển thị, 1: Hiển thị'),
            'description' => $this->text()->null()->comment('Mô tả'),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'created_by' => $this->integer(11)->null(),
            'updated_by' => $this->integer(11)->null(),
        ], $tableOptions);

        $this->createIndex('idx-slug', 'faq_faq_category', 'slug', true);
        $this->addForeignKey('fk-faq_faq_category__created_by-user__id', 'faq_faq_category', 'created_by', 'user', 'id');
        $this->addForeignKey('fk-faq_faq_category__updated_by-user__id', 'faq_faq_category', 'updated_by', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%faq_faq_category}}');
    }
}
