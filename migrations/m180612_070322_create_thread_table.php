    <?php

    use yii\db\Migration;

    /**
     * Handles the creation of table `thread`.
     */
    class m180612_070322_create_thread_table extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->createTable('thread', [
                    'id' => $this->primaryKey(),
                    'user_id'=>$this->integer()->notNull(),
                    'title'=>$this->string()->notNull(),
                    'body'=>$this->text(),
                    'create_at'=>$this->timestamp()->defaultValue(null),
                    'update_at'=>$this->timestamp()->defaultValue(null)
                ]);

            $this->createIndex(
                'idx-thread-user_id',
                'thread',
                'user_id'
            );

            //create foreign key
            $this->addForeignKey(
                'fk-thread-user_id',
                'thread',
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
            $this->dropTable('thread');
        }
    }
