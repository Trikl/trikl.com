<?php



/**
 * This class defines the structure of the 'messages_user' table.
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
class MessagesUserTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'social.map.MessagesUserTableMap';

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
        $this->setName('messages_user');
        $this->setPhpName('MessagesUser');
        $this->setClassname('MessagesUser');
        $this->setPackage('social');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('USER_ID', 'UserId', 'INTEGER', true, null, null);
        $this->addColumn('THREAD_ID', 'ThreadId', 'INTEGER', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Messages', 'Messages', RelationMap::ONE_TO_MANY, array('user_id' => 'user_id', ), null, null, 'Messagess');
        $this->addRelation('MessagesContents', 'MessagesContents', RelationMap::MANY_TO_MANY, array(), null, null, 'MessagesContentss');
    } // buildRelations()

} // MessagesUserTableMap
