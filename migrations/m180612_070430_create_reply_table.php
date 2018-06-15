<?php

use yii\db\Migration;

/**
 * Handles the creation of table `reply`.
 */
class m180612_070430_create_reply_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('reply', [
            'id' => $this->primaryKey(),
            'thread_id' => $this->integer()->notNull(),
            'user_id'=> $this->integer()->notNull(),
            'body'=>$this->text(),
            'create_at'=>$this->timestamp()->defaultValue(null),
            'update_at'=>$this->timestamp()->defaultValue(null)
        ]);


            $this->createIndex(
                'idx-reply-user_id',
                'reply',
                'user_id'
            );

            //create foreign key
            $this->addForeignKey(
                'fk-reply-user_id',
                'reply',
                'user_id',
                'user',
                'id',
                'CASCADE'
            );

             $this->createIndex(
                'idx-reply-thread_id',
                'reply',
                'thread_id'
            );

            //create foreign key
            $this->addForeignKey(
                'fk-reply-thread_id',
                'reply',
                'user_id',
                'user',
                'id',
                'CASCADE'
            );




    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {   
        $this->dropForeignKey(
            'fk-reply-user_id',
            'reply'
        );
        $this->dropIndex(
            'idx-reply-user_id',
            'reply'
        );
        $this->dropForeignKey(
            'fk-reply-thread_id',
            'reply'
        );
        $this->dropIndex(
            'idx-reply-thread_id',
            'reply'
        );
        $this->dropTable('reply');
    }
}
