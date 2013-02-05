<?php



/**
 * This class defines the structure of the 'message_users' table.
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
class MessageUsersTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'social.map.MessageUsersTableMap';

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
        $this->setName('message_users');
        $this->setPhpName('MessageUsers');
        $this->setClassname('MessageUsers');
        $this->setPackage('social');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('MESSAGEID', 'Messageid', 'INTEGER', true, 50, null);
        $this->addColumn('USERID', 'Userid', 'INTEGER', true, 50, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // MessageUsersTableMap
