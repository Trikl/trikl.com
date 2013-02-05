<?php


/**
 * Base class that represents a row from the 'url' table.
 *
 *
 *
 * @package    propel.generator.social.om
 */
abstract class BaseUrl extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'UrlPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        UrlPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the urlid field.
     * @var        int
     */
    protected $urlid;

    /**
     * The value for the urlhost field.
     * @var        string
     */
    protected $urlhost;

    /**
     * The value for the urlpath field.
     * @var        string
     */
    protected $urlpath;

    /**
     * The value for the urlquery field.
     * @var        string
     */
    protected $urlquery;

    /**
     * The value for the contenttype field.
     * @var        string
     */
    protected $contenttype;

    /**
     * The value for the title field.
     * @var        string
     */
    protected $title;

    /**
     * The value for the content field.
     * @var        string
     */
    protected $content;

    /**
     * The value for the contentimg field.
     * @var        string
     */
    protected $contentimg;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Get the [urlid] column value.
     *
     * @return int
     */
    public function getUrlid()
    {
        return $this->urlid;
    }

    /**
     * Get the [urlhost] column value.
     *
     * @return string
     */
    public function getUrlhost()
    {
        return $this->urlhost;
    }

    /**
     * Get the [urlpath] column value.
     *
     * @return string
     */
    public function getUrlpath()
    {
        return $this->urlpath;
    }

    /**
     * Get the [urlquery] column value.
     *
     * @return string
     */
    public function getUrlquery()
    {
        return $this->urlquery;
    }

    /**
     * Get the [contenttype] column value.
     *
     * @return string
     */
    public function getContenttype()
    {
        return $this->contenttype;
    }

    /**
     * Get the [title] column value.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the [content] column value.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the [contentimg] column value.
     *
     * @return string
     */
    public function getContentimg()
    {
        return $this->contentimg;
    }

    /**
     * Set the value of [urlid] column.
     *
     * @param int $v new value
     * @return Url The current object (for fluent API support)
     */
    public function setUrlid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->urlid !== $v) {
            $this->urlid = $v;
            $this->modifiedColumns[] = UrlPeer::URLID;
        }


        return $this;
    } // setUrlid()

    /**
     * Set the value of [urlhost] column.
     *
     * @param string $v new value
     * @return Url The current object (for fluent API support)
     */
    public function setUrlhost($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->urlhost !== $v) {
            $this->urlhost = $v;
            $this->modifiedColumns[] = UrlPeer::URLHOST;
        }


        return $this;
    } // setUrlhost()

    /**
     * Set the value of [urlpath] column.
     *
     * @param string $v new value
     * @return Url The current object (for fluent API support)
     */
    public function setUrlpath($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->urlpath !== $v) {
            $this->urlpath = $v;
            $this->modifiedColumns[] = UrlPeer::URLPATH;
        }


        return $this;
    } // setUrlpath()

    /**
     * Set the value of [urlquery] column.
     *
     * @param string $v new value
     * @return Url The current object (for fluent API support)
     */
    public function setUrlquery($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->urlquery !== $v) {
            $this->urlquery = $v;
            $this->modifiedColumns[] = UrlPeer::URLQUERY;
        }


        return $this;
    } // setUrlquery()

    /**
     * Set the value of [contenttype] column.
     *
     * @param string $v new value
     * @return Url The current object (for fluent API support)
     */
    public function setContenttype($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contenttype !== $v) {
            $this->contenttype = $v;
            $this->modifiedColumns[] = UrlPeer::CONTENTTYPE;
        }


        return $this;
    } // setContenttype()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return Url The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[] = UrlPeer::TITLE;
        }


        return $this;
    } // setTitle()

    /**
     * Set the value of [content] column.
     *
     * @param string $v new value
     * @return Url The current object (for fluent API support)
     */
    public function setContent($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->content !== $v) {
            $this->content = $v;
            $this->modifiedColumns[] = UrlPeer::CONTENT;
        }


        return $this;
    } // setContent()

    /**
     * Set the value of [contentimg] column.
     *
     * @param string $v new value
     * @return Url The current object (for fluent API support)
     */
    public function setContentimg($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contentimg !== $v) {
            $this->contentimg = $v;
            $this->modifiedColumns[] = UrlPeer::CONTENTIMG;
        }


        return $this;
    } // setContentimg()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->urlid = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->urlhost = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->urlpath = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->urlquery = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->contenttype = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->title = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->content = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->contentimg = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = UrlPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Url object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(UrlPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = UrlPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(UrlPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = UrlQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(UrlPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                UrlPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = UrlPeer::URLID;
        if (null !== $this->urlid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UrlPeer::URLID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UrlPeer::URLID)) {
            $modifiedColumns[':p' . $index++]  = '`URLID`';
        }
        if ($this->isColumnModified(UrlPeer::URLHOST)) {
            $modifiedColumns[':p' . $index++]  = '`URLHOST`';
        }
        if ($this->isColumnModified(UrlPeer::URLPATH)) {
            $modifiedColumns[':p' . $index++]  = '`URLPATH`';
        }
        if ($this->isColumnModified(UrlPeer::URLQUERY)) {
            $modifiedColumns[':p' . $index++]  = '`URLQUERY`';
        }
        if ($this->isColumnModified(UrlPeer::CONTENTTYPE)) {
            $modifiedColumns[':p' . $index++]  = '`CONTENTTYPE`';
        }
        if ($this->isColumnModified(UrlPeer::TITLE)) {
            $modifiedColumns[':p' . $index++]  = '`TITLE`';
        }
        if ($this->isColumnModified(UrlPeer::CONTENT)) {
            $modifiedColumns[':p' . $index++]  = '`CONTENT`';
        }
        if ($this->isColumnModified(UrlPeer::CONTENTIMG)) {
            $modifiedColumns[':p' . $index++]  = '`CONTENTIMG`';
        }

        $sql = sprintf(
            'INSERT INTO `url` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`URLID`':
                        $stmt->bindValue($identifier, $this->urlid, PDO::PARAM_INT);
                        break;
                    case '`URLHOST`':
                        $stmt->bindValue($identifier, $this->urlhost, PDO::PARAM_STR);
                        break;
                    case '`URLPATH`':
                        $stmt->bindValue($identifier, $this->urlpath, PDO::PARAM_STR);
                        break;
                    case '`URLQUERY`':
                        $stmt->bindValue($identifier, $this->urlquery, PDO::PARAM_STR);
                        break;
                    case '`CONTENTTYPE`':
                        $stmt->bindValue($identifier, $this->contenttype, PDO::PARAM_STR);
                        break;
                    case '`TITLE`':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case '`CONTENT`':
                        $stmt->bindValue($identifier, $this->content, PDO::PARAM_STR);
                        break;
                    case '`CONTENTIMG`':
                        $stmt->bindValue($identifier, $this->contentimg, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setUrlid($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        } else {
            $this->validationFailures = $res;

            return false;
        }
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = UrlPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }



            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = UrlPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getUrlid();
                break;
            case 1:
                return $this->getUrlhost();
                break;
            case 2:
                return $this->getUrlpath();
                break;
            case 3:
                return $this->getUrlquery();
                break;
            case 4:
                return $this->getContenttype();
                break;
            case 5:
                return $this->getTitle();
                break;
            case 6:
                return $this->getContent();
                break;
            case 7:
                return $this->getContentimg();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {
        if (isset($alreadyDumpedObjects['Url'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Url'][$this->getPrimaryKey()] = true;
        $keys = UrlPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getUrlid(),
            $keys[1] => $this->getUrlhost(),
            $keys[2] => $this->getUrlpath(),
            $keys[3] => $this->getUrlquery(),
            $keys[4] => $this->getContenttype(),
            $keys[5] => $this->getTitle(),
            $keys[6] => $this->getContent(),
            $keys[7] => $this->getContentimg(),
        );

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = UrlPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setUrlid($value);
                break;
            case 1:
                $this->setUrlhost($value);
                break;
            case 2:
                $this->setUrlpath($value);
                break;
            case 3:
                $this->setUrlquery($value);
                break;
            case 4:
                $this->setContenttype($value);
                break;
            case 5:
                $this->setTitle($value);
                break;
            case 6:
                $this->setContent($value);
                break;
            case 7:
                $this->setContentimg($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = UrlPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setUrlid($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setUrlhost($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setUrlpath($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setUrlquery($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setContenttype($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setTitle($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setContent($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setContentimg($arr[$keys[7]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(UrlPeer::DATABASE_NAME);

        if ($this->isColumnModified(UrlPeer::URLID)) $criteria->add(UrlPeer::URLID, $this->urlid);
        if ($this->isColumnModified(UrlPeer::URLHOST)) $criteria->add(UrlPeer::URLHOST, $this->urlhost);
        if ($this->isColumnModified(UrlPeer::URLPATH)) $criteria->add(UrlPeer::URLPATH, $this->urlpath);
        if ($this->isColumnModified(UrlPeer::URLQUERY)) $criteria->add(UrlPeer::URLQUERY, $this->urlquery);
        if ($this->isColumnModified(UrlPeer::CONTENTTYPE)) $criteria->add(UrlPeer::CONTENTTYPE, $this->contenttype);
        if ($this->isColumnModified(UrlPeer::TITLE)) $criteria->add(UrlPeer::TITLE, $this->title);
        if ($this->isColumnModified(UrlPeer::CONTENT)) $criteria->add(UrlPeer::CONTENT, $this->content);
        if ($this->isColumnModified(UrlPeer::CONTENTIMG)) $criteria->add(UrlPeer::CONTENTIMG, $this->contentimg);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(UrlPeer::DATABASE_NAME);
        $criteria->add(UrlPeer::URLID, $this->urlid);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getUrlid();
    }

    /**
     * Generic method to set the primary key (urlid column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setUrlid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getUrlid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Url (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUrlhost($this->getUrlhost());
        $copyObj->setUrlpath($this->getUrlpath());
        $copyObj->setUrlquery($this->getUrlquery());
        $copyObj->setContenttype($this->getContenttype());
        $copyObj->setTitle($this->getTitle());
        $copyObj->setContent($this->getContent());
        $copyObj->setContentimg($this->getContentimg());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setUrlid(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Url Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return UrlPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new UrlPeer();
        }

        return self::$peer;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->urlid = null;
        $this->urlhost = null;
        $this->urlpath = null;
        $this->urlquery = null;
        $this->contenttype = null;
        $this->title = null;
        $this->content = null;
        $this->contentimg = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UrlPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
