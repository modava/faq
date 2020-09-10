<?php

use yii\db\Migration;

/**
 * Class m200810_025711_create_table_faq
 */
class m200810_030306_create_table_faq_faq extends Migration
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

        $this->createTable('{{%faq_faq}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull()->unique(),
            'content' => $this->text()->null()->comment('Câu trả lời'),
            'short_content' => $this->text()->null()->comment('Câu trả lời ngắn'),
            'status' => $this->integer(1)->defaultValue(1)->comment('0: Không hiển thị, 1: Hiển thị'),
            'faq_category_id' => $this->integer(11)->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'created_by' => $this->integer(11)->null(),
            'updated_by' => $this->integer(11)->null(),
        ], $tableOptions);

        $this->createIndex('idx-slug', 'faq_faq', 'slug', true);
        $this->addForeignKey('fk-faq_faq__created_by-user__id', 'faq_faq', 'created_by', 'user', 'id');
        $this->addForeignKey('fk-faq_faq__updated_by-user__id', 'faq_faq', 'updated_by', 'user', 'id');
        $this->addForeignKey('fk-faq_faq__faq_category_id-faq_faq_category__id', 'faq_faq', 'faq_category_id', 'faq_faq_category', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%faq_faq}}');
    }
}
