<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 * Has foreign keys to the tables:
 * - `{{%user_types}}`
 * - `{{%cities}}`
 */
class m190512_203237_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'username' => $this->string(32)->notNull()->unique(),
            'id_type' => $this->integer(),
            'surname' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'middlename' => $this->string(),
            'birthday' => $this->integer()->notNull(),
            'email' => $this->string(128)->notNull()->unique(),
            'telegram_name' => $this->string(),
            'telephone' => $this->string(10)->notNull()->unique(),
            'id_city' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_type`
        $this->createIndex(
            '{{%idx-users-id_type}}',
            '{{%users}}',
            'id_type'
        );

        // add foreign key for table `{{%user_types}}`
        $this->addForeignKey(
            '{{%fk-users-id_type}}',
            '{{%users}}',
            'id_type',
            '{{%user_types}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_city`
        $this->createIndex(
            '{{%idx-users-id_city}}',
            '{{%users}}',
            'id_city'
        );

        // add foreign key for table `{{%cities}}`
        $this->addForeignKey(
            '{{%fk-users-id_city}}',
            '{{%users}}',
            'id_city',
            '{{%cities}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user_types}}`
        $this->dropForeignKey(
            '{{%fk-users-id_type}}',
            '{{%users}}'
        );

        // drops index for column `id_type`
        $this->dropIndex(
            '{{%idx-users-id_type}}',
            '{{%users}}'
        );

        // drops foreign key for table `{{%cities}}`
        $this->dropForeignKey(
            '{{%fk-users-id_city}}',
            '{{%users}}'
        );

        // drops index for column `id_city`
        $this->dropIndex(
            '{{%idx-users-id_city}}',
            '{{%users}}'
        );

        $this->dropTable('{{%users}}');
    }
}
