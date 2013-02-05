<?php



/**
 * This class defines the structure of the 'message_contents' table.
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
class MessageContentsTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'social.map.MessageContentsTableMap';

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
        $this->setName('message_contents');
        $this->setPhpName('MessageContents');
        $this->setClassname('MessageContents');
        $this->setPackage('social');
        $this->setUseIdGenerator(true);
        // columns
        $this->addColumn('MESSAGEID', 'Messageid', 'INTEGER', false, 50, null);
        $this->addPrimaryKey('THREADID', 'Threadid', 'INTEGER', true, 50, null);
        $this->addColumn('USERID', 'Userid', 'INTEGER', false, 50, null);
        $this->addColumn('CONTENT', 'Content', 'VARCHAR', false, 500, null);
        $this->addColumn('DATE', 'Date', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // MessageContentsTableMap
