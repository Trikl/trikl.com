<?php



/**
 * This class defines the structure of the 'users' table.
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
class UserTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'social.map.UserTableMap';

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
        $this->setName('users');
        $this->setPhpName('User');
        $this->setClassname('User');
        $this->setPackage('social');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 50, null);
        $this->addColumn('USERNAME', 'username', 'VARCHAR', true, 15, null);
        $this->addColumn('PASSWORD', 'password', 'VARCHAR', true, 75, null);
        $this->addColumn('EMAIL', 'email', 'VARCHAR', true, 50, null);
        $this->addColumn('FIRST_NAME', 'FirstName', 'VARCHAR', true, 50, null);
        $this->addColumn('LAST_NAME', 'LastName', 'VARCHAR', true, 50, null);
        $this->addColumn('ACTIVATE_CODE', 'ActivateCode', 'VARCHAR', true, 10, null);
        $this->addColumn('IS_ACTIVATED', 'IsActivated', 'INTEGER', true, 1, 1);
        $this->addColumn('AVATAR_FILENAME', 'AvatarFilename', 'VARCHAR', true, 50, null);
        $this->addColumn('HIDE_STREAM', 'HideStream', 'INTEGER', true, 1, 0);
        $this->addColumn('INVISIBLE', 'Invisible', 'INTEGER', true, 1, 0);
        // validators
        $this->addValidator('USERNAME', 'minLength', 'propel.validator.MinLengthValidator', '8', 'Username must be at least 8 characters !');
        $this->addValidator('USERNAME', 'unique', 'propel.validator.UniqueValidator', '', 'Username already exists !');
        $this->addValidator('EMAIL', 'match', 'propel.validator.MatchValidator', '/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9])+(\.[a-zA-Z0-9_-]+)+$/', 'Please enter a valid email address.');
        $this->addValidator('EMAIL', 'unique', 'propel.validator.UniqueValidator', '', 'Email already in use!');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // UserTableMap
