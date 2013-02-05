<?php



/**
 * This class defines the structure of the 'votes' table.
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
class VotesTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'social.map.VotesTableMap';

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
        $this->setName('votes');
        $this->setPhpName('Votes');
        $this->setClassname('Votes');
        $this->setPackage('social');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('VOTEID', 'Voteid', 'INTEGER', true, 50, null);
        $this->addColumn('POSTID', 'Postid', 'INTEGER', false, 50, null);
        $this->addColumn('USERID', 'Userid', 'INTEGER', false, 50, null);
        $this->addColumn('VALUE', 'Value', 'INTEGER', false, 50, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // VotesTableMap
