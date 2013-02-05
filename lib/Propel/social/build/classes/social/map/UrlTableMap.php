<?php



/**
 * This class defines the structure of the 'url' table.
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
class UrlTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'social.map.UrlTableMap';

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
        $this->setName('url');
        $this->setPhpName('Url');
        $this->setClassname('Url');
        $this->setPackage('social');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('URLID', 'Urlid', 'INTEGER', true, 50, null);
        $this->addColumn('URLHOST', 'Urlhost', 'VARCHAR', true, 255, null);
        $this->addColumn('URLPATH', 'Urlpath', 'VARCHAR', true, 255, null);
        $this->addColumn('URLQUERY', 'Urlquery', 'VARCHAR', true, 255, null);
        $this->addColumn('CONTENTTYPE', 'Contenttype', 'VARCHAR', true, 255, null);
        $this->addColumn('TITLE', 'Title', 'VARCHAR', true, 255, null);
        $this->addColumn('CONTENT', 'Content', 'VARCHAR', true, 255, null);
        $this->addColumn('CONTENTIMG', 'Contentimg', 'VARCHAR', true, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // UrlTableMap
