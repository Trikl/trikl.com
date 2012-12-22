<?php



/**
 * This class defines the structure of the 'comments' table.
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
class CommentsTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'social.map.CommentsTableMap';

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
        $this->setName('comments');
        $this->setPhpName('Comments');
        $this->setClassname('Comments');
        $this->setPackage('social');
        $this->setUseIdGenerator(true);
        // columns
        $this->addColumn('POSTID', 'Postid', 'INTEGER', true, 50, null);
        $this->addPrimaryKey('COMMENTID', 'Commentid', 'INTEGER', true, 50, null);
        $this->addColumn('USERID', 'Userid', 'INTEGER', true, 50, null);
        $this->addColumn('DATE', 'Date', 'TIMESTAMP', true, null, null);
        $this->addColumn('CONTENT', 'Content', 'VARCHAR', true, 500, null);
        $this->addColumn('TIER', 'Tier', 'INTEGER', true, 11, 0);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // CommentsTableMap
