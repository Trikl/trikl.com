<?php


/**
 * Base class that represents a row from the 'messages_contents' table.
 *
 *
 *
 * @package    propel.generator.social.om
 */
abstract class BaseMessagesContents extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'MessagesContentsPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        MessagesContentsPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the message_id field.
     * @var        int
     */
    protected $message_id;

    /**
     * The value for the thread_id field.
     * @var        int
     */
    protected $thread_id;

    /**
     * The value for the user_id field.
     * @var        int
     */
    protected $user_id;

    /**
     * The value for the contents field.
     * @var        string
     */
    protected $contents;

    /**
     * @var        PropelObjectCollection|Messages[] Collection to store aggregation of Messages objects.
     */
    protected $collMessagess;
    protected $collMessagessPartial;

    /**
     * @var        PropelObjectCollection|MessagesUser[] Collection to store aggregation of MessagesUser objects.
     */
    protected $collMessagesUsers;

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
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $messagesUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $messagessScheduledForDeletion = null;

    /**
     * Get the [message_id] column value.
     *
     * @return int
     */
    public function getMessageId()
    {
        return $this->message_id;
    }

    /**
     * Get the [thread_id] column value.
     *
     * @return int
     */
    public function getThreadId()
    {
        return $this->thread_id;
    }

    /**
     * Get the [user_id] column value.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Get the [contents] column value.
     *
     * @return string
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * Set the value of [message_id] column.
     *
     * @param int $v new value
     * @return MessagesContents The current object (for fluent API support)
     */
    public function setMessageId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->message_id !== $v) {
            $this->message_id = $v;
            $this->modifiedColumns[] = MessagesContentsPeer::MESSAGE_ID;
        }


        return $this;
    } // setMessageId()

    /**
     * Set the value of [thread_id] column.
     *
     * @param int $v new value
     * @return MessagesContents The current object (for fluent API support)
     */
    public function setThreadId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->thread_id !== $v) {
            $this->thread_id = $v;
            $this->modifiedColumns[] = MessagesContentsPeer::THREAD_ID;
        }


        return $this;
    } // setThreadId()

    /**
     * Set the value of [user_id] column.
     *
     * @param int $v new value
     * @return MessagesContents The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[] = MessagesContentsPeer::USER_ID;
        }


        return $this;
    } // setUserId()

    /**
     * Set the value of [contents] column.
     *
     * @param string $v new value
     * @return MessagesContents The current object (for fluent API support)
     */
    public function setContents($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contents !== $v) {
            $this->contents = $v;
            $this->modifiedColumns[] = MessagesContentsPeer::CONTENTS;
        }


        return $this;
    } // setContents()

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

            $this->message_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->thread_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->user_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->contents = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = MessagesContentsPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating MessagesContents object", $e);
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
            $con = Propel::getConnection(MessagesContentsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = MessagesContentsPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collMessagess = null;

            $this->collMessagesUsers = null;
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
            $con = Propel::getConnection(MessagesContentsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = MessagesContentsQuery::create()
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
            $con = Propel::getConnection(MessagesContentsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                MessagesContentsPeer::addInstanceToPool($this);
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

            if ($this->messagesUsersScheduledForDeletion !== null) {
                if (!$this->messagesUsersScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->messagesUsersScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    MessagesQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->messagesUsersScheduledForDeletion = null;
                }

                foreach ($this->getMessagesUsers() as $messagesUser) {
                    if ($messagesUser->isModified()) {
                        $messagesUser->save($con);
                    }
                }
            }

            if ($this->messagessScheduledForDeletion !== null) {
                if (!$this->messagessScheduledForDeletion->isEmpty()) {
                    MessagesQuery::create()
                        ->filterByPrimaryKeys($this->messagessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->messagessScheduledForDeletion = null;
                }
            }

            if ($this->collMessagess !== null) {
                foreach ($this->collMessagess as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

        $this->modifiedColumns[] = MessagesContentsPeer::MESSAGE_ID;
        if (null !== $this->message_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . MessagesContentsPeer::MESSAGE_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(MessagesContentsPeer::MESSAGE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`MESSAGE_ID`';
        }
        if ($this->isColumnModified(MessagesContentsPeer::THREAD_ID)) {
            $modifiedColumns[':p' . $index++]  = '`THREAD_ID`';
        }
        if ($this->isColumnModified(MessagesContentsPeer::USER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`USER_ID`';
        }
        if ($this->isColumnModified(MessagesContentsPeer::CONTENTS)) {
            $modifiedColumns[':p' . $index++]  = '`CONTENTS`';
        }

        $sql = sprintf(
            'INSERT INTO `messages_contents` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`MESSAGE_ID`':
                        $stmt->bindValue($identifier, $this->message_id, PDO::PARAM_INT);
                        break;
                    case '`THREAD_ID`':
                        $stmt->bindValue($identifier, $this->thread_id, PDO::PARAM_INT);
                        break;
                    case '`USER_ID`':
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);
                        break;
                    case '`CONTENTS`':
                        $stmt->bindValue($identifier, $this->contents, PDO::PARAM_STR);
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
        $this->setMessageId($pk);

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


            if (($retval = MessagesContentsPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collMessagess !== null) {
                    foreach ($this->collMessagess as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
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
        $pos = MessagesContentsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getMessageId();
                break;
            case 1:
                return $this->getThreadId();
                break;
            case 2:
                return $this->getUserId();
                break;
            case 3:
                return $this->getContents();
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
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['MessagesContents'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['MessagesContents'][$this->getPrimaryKey()] = true;
        $keys = MessagesContentsPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getMessageId(),
            $keys[1] => $this->getThreadId(),
            $keys[2] => $this->getUserId(),
            $keys[3] => $this->getContents(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collMessagess) {
                $result['Messagess'] = $this->collMessagess->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

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
        $pos = MessagesContentsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setMessageId($value);
                break;
            case 1:
                $this->setThreadId($value);
                break;
            case 2:
                $this->setUserId($value);
                break;
            case 3:
                $this->setContents($value);
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
        $keys = MessagesContentsPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setMessageId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setThreadId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setUserId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setContents($arr[$keys[3]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(MessagesContentsPeer::DATABASE_NAME);

        if ($this->isColumnModified(MessagesContentsPeer::MESSAGE_ID)) $criteria->add(MessagesContentsPeer::MESSAGE_ID, $this->message_id);
        if ($this->isColumnModified(MessagesContentsPeer::THREAD_ID)) $criteria->add(MessagesContentsPeer::THREAD_ID, $this->thread_id);
        if ($this->isColumnModified(MessagesContentsPeer::USER_ID)) $criteria->add(MessagesContentsPeer::USER_ID, $this->user_id);
        if ($this->isColumnModified(MessagesContentsPeer::CONTENTS)) $criteria->add(MessagesContentsPeer::CONTENTS, $this->contents);

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
        $criteria = new Criteria(MessagesContentsPeer::DATABASE_NAME);
        $criteria->add(MessagesContentsPeer::MESSAGE_ID, $this->message_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getMessageId();
    }

    /**
     * Generic method to set the primary key (message_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setMessageId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getMessageId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of MessagesContents (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setThreadId($this->getThreadId());
        $copyObj->setUserId($this->getUserId());
        $copyObj->setContents($this->getContents());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getMessagess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMessages($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setMessageId(NULL); // this is a auto-increment column, so set to default value
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
     * @return MessagesContents Clone of current object.
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
     * @return MessagesContentsPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new MessagesContentsPeer();
        }

        return self::$peer;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Messages' == $relationName) {
            $this->initMessagess();
        }
    }

    /**
     * Clears out the collMessagess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addMessagess()
     */
    public function clearMessagess()
    {
        $this->collMessagess = null; // important to set this to null since that means it is uninitialized
        $this->collMessagessPartial = null;
    }

    /**
     * reset is the collMessagess collection loaded partially
     *
     * @return void
     */
    public function resetPartialMessagess($v = true)
    {
        $this->collMessagessPartial = $v;
    }

    /**
     * Initializes the collMessagess collection.
     *
     * By default this just sets the collMessagess collection to an empty array (like clearcollMessagess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMessagess($overrideExisting = true)
    {
        if (null !== $this->collMessagess && !$overrideExisting) {
            return;
        }
        $this->collMessagess = new PropelObjectCollection();
        $this->collMessagess->setModel('Messages');
    }

    /**
     * Gets an array of Messages objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this MessagesContents is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Messages[] List of Messages objects
     * @throws PropelException
     */
    public function getMessagess($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collMessagessPartial && !$this->isNew();
        if (null === $this->collMessagess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMessagess) {
                // return empty collection
                $this->initMessagess();
            } else {
                $collMessagess = MessagesQuery::create(null, $criteria)
                    ->filterByMessagesContents($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collMessagessPartial && count($collMessagess)) {
                      $this->initMessagess(false);

                      foreach($collMessagess as $obj) {
                        if (false == $this->collMessagess->contains($obj)) {
                          $this->collMessagess->append($obj);
                        }
                      }

                      $this->collMessagessPartial = true;
                    }

                    return $collMessagess;
                }

                if($partial && $this->collMessagess) {
                    foreach($this->collMessagess as $obj) {
                        if($obj->isNew()) {
                            $collMessagess[] = $obj;
                        }
                    }
                }

                $this->collMessagess = $collMessagess;
                $this->collMessagessPartial = false;
            }
        }

        return $this->collMessagess;
    }

    /**
     * Sets a collection of Messages objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $messagess A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setMessagess(PropelCollection $messagess, PropelPDO $con = null)
    {
        $this->messagessScheduledForDeletion = $this->getMessagess(new Criteria(), $con)->diff($messagess);

        foreach ($this->messagessScheduledForDeletion as $messagesRemoved) {
            $messagesRemoved->setMessagesContents(null);
        }

        $this->collMessagess = null;
        foreach ($messagess as $messages) {
            $this->addMessages($messages);
        }

        $this->collMessagess = $messagess;
        $this->collMessagessPartial = false;
    }

    /**
     * Returns the number of related Messages objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Messages objects.
     * @throws PropelException
     */
    public function countMessagess(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collMessagessPartial && !$this->isNew();
        if (null === $this->collMessagess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMessagess) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getMessagess());
                }
                $query = MessagesQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByMessagesContents($this)
                    ->count($con);
            }
        } else {
            return count($this->collMessagess);
        }
    }

    /**
     * Method called to associate a Messages object to this object
     * through the Messages foreign key attribute.
     *
     * @param    Messages $l Messages
     * @return MessagesContents The current object (for fluent API support)
     */
    public function addMessages(Messages $l)
    {
        if ($this->collMessagess === null) {
            $this->initMessagess();
            $this->collMessagessPartial = true;
        }
        if (!in_array($l, $this->collMessagess->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddMessages($l);
        }

        return $this;
    }

    /**
     * @param	Messages $messages The messages object to add.
     */
    protected function doAddMessages($messages)
    {
        $this->collMessagess[]= $messages;
        $messages->setMessagesContents($this);
    }

    /**
     * @param	Messages $messages The messages object to remove.
     */
    public function removeMessages($messages)
    {
        if ($this->getMessagess()->contains($messages)) {
            $this->collMessagess->remove($this->collMessagess->search($messages));
            if (null === $this->messagessScheduledForDeletion) {
                $this->messagessScheduledForDeletion = clone $this->collMessagess;
                $this->messagessScheduledForDeletion->clear();
            }
            $this->messagessScheduledForDeletion[]= $messages;
            $messages->setMessagesContents(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this MessagesContents is new, it will return
     * an empty collection; or if this MessagesContents has previously
     * been saved, it will retrieve related Messagess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in MessagesContents.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Messages[] List of Messages objects
     */
    public function getMessagessJoinMessagesUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = MessagesQuery::create(null, $criteria);
        $query->joinWith('MessagesUser', $join_behavior);

        return $this->getMessagess($query, $con);
    }

    /**
     * Clears out the collMessagesUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addMessagesUsers()
     */
    public function clearMessagesUsers()
    {
        $this->collMessagesUsers = null; // important to set this to null since that means it is uninitialized
        $this->collMessagesUsersPartial = null;
    }

    /**
     * Initializes the collMessagesUsers collection.
     *
     * By default this just sets the collMessagesUsers collection to an empty collection (like clearMessagesUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initMessagesUsers()
    {
        $this->collMessagesUsers = new PropelObjectCollection();
        $this->collMessagesUsers->setModel('MessagesUser');
    }

    /**
     * Gets a collection of MessagesUser objects related by a many-to-many relationship
     * to the current object by way of the messages cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this MessagesContents is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|MessagesUser[] List of MessagesUser objects
     */
    public function getMessagesUsers($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collMessagesUsers || null !== $criteria) {
            if ($this->isNew() && null === $this->collMessagesUsers) {
                // return empty collection
                $this->initMessagesUsers();
            } else {
                $collMessagesUsers = MessagesUserQuery::create(null, $criteria)
                    ->filterByMessagesContents($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collMessagesUsers;
                }
                $this->collMessagesUsers = $collMessagesUsers;
            }
        }

        return $this->collMessagesUsers;
    }

    /**
     * Sets a collection of MessagesUser objects related by a many-to-many relationship
     * to the current object by way of the messages cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $messagesUsers A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setMessagesUsers(PropelCollection $messagesUsers, PropelPDO $con = null)
    {
        $this->clearMessagesUsers();
        $currentMessagesUsers = $this->getMessagesUsers();

        $this->messagesUsersScheduledForDeletion = $currentMessagesUsers->diff($messagesUsers);

        foreach ($messagesUsers as $messagesUser) {
            if (!$currentMessagesUsers->contains($messagesUser)) {
                $this->doAddMessagesUser($messagesUser);
            }
        }

        $this->collMessagesUsers = $messagesUsers;
    }

    /**
     * Gets the number of MessagesUser objects related by a many-to-many relationship
     * to the current object by way of the messages cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related MessagesUser objects
     */
    public function countMessagesUsers($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collMessagesUsers || null !== $criteria) {
            if ($this->isNew() && null === $this->collMessagesUsers) {
                return 0;
            } else {
                $query = MessagesUserQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByMessagesContents($this)
                    ->count($con);
            }
        } else {
            return count($this->collMessagesUsers);
        }
    }

    /**
     * Associate a MessagesUser object to this object
     * through the messages cross reference table.
     *
     * @param  MessagesUser $messagesUser The Messages object to relate
     * @return void
     */
    public function addMessagesUser(MessagesUser $messagesUser)
    {
        if ($this->collMessagesUsers === null) {
            $this->initMessagesUsers();
        }
        if (!$this->collMessagesUsers->contains($messagesUser)) { // only add it if the **same** object is not already associated
            $this->doAddMessagesUser($messagesUser);

            $this->collMessagesUsers[]= $messagesUser;
        }
    }

    /**
     * @param	MessagesUser $messagesUser The messagesUser object to add.
     */
    protected function doAddMessagesUser($messagesUser)
    {
        $messages = new Messages();
        $messages->setMessagesUser($messagesUser);
        $this->addMessages($messages);
    }

    /**
     * Remove a MessagesUser object to this object
     * through the messages cross reference table.
     *
     * @param MessagesUser $messagesUser The Messages object to relate
     * @return void
     */
    public function removeMessagesUser(MessagesUser $messagesUser)
    {
        if ($this->getMessagesUsers()->contains($messagesUser)) {
            $this->collMessagesUsers->remove($this->collMessagesUsers->search($messagesUser));
            if (null === $this->messagesUsersScheduledForDeletion) {
                $this->messagesUsersScheduledForDeletion = clone $this->collMessagesUsers;
                $this->messagesUsersScheduledForDeletion->clear();
            }
            $this->messagesUsersScheduledForDeletion[]= $messagesUser;
        }
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->message_id = null;
        $this->thread_id = null;
        $this->user_id = null;
        $this->contents = null;
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
            if ($this->collMessagess) {
                foreach ($this->collMessagess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMessagesUsers) {
                foreach ($this->collMessagesUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collMessagess instanceof PropelCollection) {
            $this->collMessagess->clearIterator();
        }
        $this->collMessagess = null;
        if ($this->collMessagesUsers instanceof PropelCollection) {
            $this->collMessagesUsers->clearIterator();
        }
        $this->collMessagesUsers = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(MessagesContentsPeer::DEFAULT_STRING_FORMAT);
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
