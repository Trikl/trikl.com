<?php



/**
 * This class defines the structure of the 'messages_contents' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.social.map
 */
class MessagesContentsTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'social.map.MessagesContentsTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('messages_contents');
        $this->setPhpName('MessagesContents');
        $this->setClassname('MessagesContents');
        $this->setPackage('social');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('MESSAGE_ID', 'MessageId', 'INTEGER', true, 50, null);
        $this->addColumn('THREAD_ID', 'ThreadId', 'INTEGER', true, 50, null);
        $this->addColumn('USER_ID', 'UserId', 'INTEGER', true, 50, null);
        $this->addColumn('CONTENTS', 'Contents', 'VARCHAR', true, 500, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Messages', 'Messages', RelationMap::ONE_TO_MANY, array('message_id' => 'message_id', ), null, null, 'Messagess');
        $this->addRelation('MessagesUser', 'MessagesUser', RelationMap::MANY_TO_MANY, array(), null, null, 'MessagesUsers');
    } // buildRelations()

} // MessagesContentsTableMap
