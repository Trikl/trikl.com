<?php



/**
 * This class defines the structure of the 'photos' table.
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
class PhotosTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'social.map.PhotosTableMap';

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
        $this->setName('photos');
        $this->setPhpName('Photos');
        $this->setClassname('Photos');
        $this->setPackage('social');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('PHOTOID', 'Photoid', 'INTEGER', true, 50, null);
        $this->addColumn('USERID', 'Userid', 'INTEGER', true, 50, null);
        $this->addColumn('GALLERYID', 'Galleryid', 'INTEGER', true, 50, null);
        $this->addColumn('PHOTONAME', 'Photoname', 'VARCHAR', true, 50, null);
        $this->addColumn('DATE', 'Date', 'TIMESTAMP', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // PhotosTableMap
