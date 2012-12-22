<?php


/**
 * Base class that represents a query for the 'users' table.
 *
 *
 *
 * @method UserQuery orderById($order = Criteria::ASC) Order by the id column
 * @method UserQuery orderByusername($order = Criteria::ASC) Order by the username column
 * @method UserQuery orderBypassword($order = Criteria::ASC) Order by the password column
 * @method UserQuery orderByemail($order = Criteria::ASC) Order by the email column
 * @method UserQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method UserQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method UserQuery orderByActivateCode($order = Criteria::ASC) Order by the activate_code column
 * @method UserQuery orderByIsActivated($order = Criteria::ASC) Order by the is_activated column
 * @method UserQuery orderByAvatarFilename($order = Criteria::ASC) Order by the avatar_filename column
 * @method UserQuery orderByBannerFilename($order = Criteria::ASC) Order by the banner_filename column
 * @method UserQuery orderByHideStream($order = Criteria::ASC) Order by the hide_stream column
 * @method UserQuery orderByInvisible($order = Criteria::ASC) Order by the invisible column
 *
 * @method UserQuery groupById() Group by the id column
 * @method UserQuery groupByusername() Group by the username column
 * @method UserQuery groupBypassword() Group by the password column
 * @method UserQuery groupByemail() Group by the email column
 * @method UserQuery groupByFirstName() Group by the first_name column
 * @method UserQuery groupByLastName() Group by the last_name column
 * @method UserQuery groupByActivateCode() Group by the activate_code column
 * @method UserQuery groupByIsActivated() Group by the is_activated column
 * @method UserQuery groupByAvatarFilename() Group by the avatar_filename column
 * @method UserQuery groupByBannerFilename() Group by the banner_filename column
 * @method UserQuery groupByHideStream() Group by the hide_stream column
 * @method UserQuery groupByInvisible() Group by the invisible column
 *
 * @method UserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method UserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method UserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method User findOne(PropelPDO $con = null) Return the first User matching the query
 * @method User findOneOrCreate(PropelPDO $con = null) Return the first User matching the query, or a new User object populated from the query conditions when no match is found
 *
 * @method User findOneByusername(string $username) Return the first User filtered by the username column
 * @method User findOneBypassword(string $password) Return the first User filtered by the password column
 * @method User findOneByemail(string $email) Return the first User filtered by the email column
 * @method User findOneByFirstName(string $first_name) Return the first User filtered by the first_name column
 * @method User findOneByLastName(string $last_name) Return the first User filtered by the last_name column
 * @method User findOneByActivateCode(string $activate_code) Return the first User filtered by the activate_code column
 * @method User findOneByIsActivated(int $is_activated) Return the first User filtered by the is_activated column
 * @method User findOneByAvatarFilename(string $avatar_filename) Return the first User filtered by the avatar_filename column
 * @method User findOneByBannerFilename(string $banner_filename) Return the first User filtered by the banner_filename column
 * @method User findOneByHideStream(int $hide_stream) Return the first User filtered by the hide_stream column
 * @method User findOneByInvisible(int $invisible) Return the first User filtered by the invisible column
 *
 * @method array findById(int $id) Return User objects filtered by the id column
 * @method array findByusername(string $username) Return User objects filtered by the username column
 * @method array findBypassword(string $password) Return User objects filtered by the password column
 * @method array findByemail(string $email) Return User objects filtered by the email column
 * @method array findByFirstName(string $first_name) Return User objects filtered by the first_name column
 * @method array findByLastName(string $last_name) Return User objects filtered by the last_name column
 * @method array findByActivateCode(string $activate_code) Return User objects filtered by the activate_code column
 * @method array findByIsActivated(int $is_activated) Return User objects filtered by the is_activated column
 * @method array findByAvatarFilename(string $avatar_filename) Return User objects filtered by the avatar_filename column
 * @method array findByBannerFilename(string $banner_filename) Return User objects filtered by the banner_filename column
 * @method array findByHideStream(int $hide_stream) Return User objects filtered by the hide_stream column
 * @method array findByInvisible(int $invisible) Return User objects filtered by the invisible column
 *
 * @package    propel.generator.social.om
 */
abstract class BaseUserQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseUserQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'social', $modelName = 'User', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new UserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     UserQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return UserQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof UserQuery) {
            return $criteria;
        }
        $query = new UserQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   User|User[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   User A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   User A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `USERNAME`, `PASSWORD`, `EMAIL`, `FIRST_NAME`, `LAST_NAME`, `ACTIVATE_CODE`, `IS_ACTIVATED`, `AVATAR_FILENAME`, `BANNER_FILENAME`, `HIDE_STREAM`, `INVISIBLE` FROM `users` WHERE `ID` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new User();
            $obj->hydrate($row);
            UserPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return User|User[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|User[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(UserPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByusername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByusername('%fooValue%'); // WHERE username LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByusername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $username)) {
                $username = str_replace('*', '%', $username);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::USERNAME, $username, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterBypassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterBypassword('%fooValue%'); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterBypassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $password)) {
                $password = str_replace('*', '%', $password);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByemail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByemail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByemail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE first_name = 'fooValue'
     * $query->filterByFirstName('%fooValue%'); // WHERE first_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByFirstName($firstName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $firstName)) {
                $firstName = str_replace('*', '%', $firstName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::FIRST_NAME, $firstName, $comparison);
    }

    /**
     * Filter the query on the last_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLastName('fooValue');   // WHERE last_name = 'fooValue'
     * $query->filterByLastName('%fooValue%'); // WHERE last_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByLastName($lastName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lastName)) {
                $lastName = str_replace('*', '%', $lastName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::LAST_NAME, $lastName, $comparison);
    }

    /**
     * Filter the query on the activate_code column
     *
     * Example usage:
     * <code>
     * $query->filterByActivateCode('fooValue');   // WHERE activate_code = 'fooValue'
     * $query->filterByActivateCode('%fooValue%'); // WHERE activate_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $activateCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByActivateCode($activateCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($activateCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $activateCode)) {
                $activateCode = str_replace('*', '%', $activateCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::ACTIVATE_CODE, $activateCode, $comparison);
    }

    /**
     * Filter the query on the is_activated column
     *
     * Example usage:
     * <code>
     * $query->filterByIsActivated(1234); // WHERE is_activated = 1234
     * $query->filterByIsActivated(array(12, 34)); // WHERE is_activated IN (12, 34)
     * $query->filterByIsActivated(array('min' => 12)); // WHERE is_activated > 12
     * </code>
     *
     * @param     mixed $isActivated The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByIsActivated($isActivated = null, $comparison = null)
    {
        if (is_array($isActivated)) {
            $useMinMax = false;
            if (isset($isActivated['min'])) {
                $this->addUsingAlias(UserPeer::IS_ACTIVATED, $isActivated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isActivated['max'])) {
                $this->addUsingAlias(UserPeer::IS_ACTIVATED, $isActivated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::IS_ACTIVATED, $isActivated, $comparison);
    }

    /**
     * Filter the query on the avatar_filename column
     *
     * Example usage:
     * <code>
     * $query->filterByAvatarFilename('fooValue');   // WHERE avatar_filename = 'fooValue'
     * $query->filterByAvatarFilename('%fooValue%'); // WHERE avatar_filename LIKE '%fooValue%'
     * </code>
     *
     * @param     string $avatarFilename The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByAvatarFilename($avatarFilename = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($avatarFilename)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $avatarFilename)) {
                $avatarFilename = str_replace('*', '%', $avatarFilename);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::AVATAR_FILENAME, $avatarFilename, $comparison);
    }

    /**
     * Filter the query on the banner_filename column
     *
     * Example usage:
     * <code>
     * $query->filterByBannerFilename('fooValue');   // WHERE banner_filename = 'fooValue'
     * $query->filterByBannerFilename('%fooValue%'); // WHERE banner_filename LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bannerFilename The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByBannerFilename($bannerFilename = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bannerFilename)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bannerFilename)) {
                $bannerFilename = str_replace('*', '%', $bannerFilename);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::BANNER_FILENAME, $bannerFilename, $comparison);
    }

    /**
     * Filter the query on the hide_stream column
     *
     * Example usage:
     * <code>
     * $query->filterByHideStream(1234); // WHERE hide_stream = 1234
     * $query->filterByHideStream(array(12, 34)); // WHERE hide_stream IN (12, 34)
     * $query->filterByHideStream(array('min' => 12)); // WHERE hide_stream > 12
     * </code>
     *
     * @param     mixed $hideStream The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByHideStream($hideStream = null, $comparison = null)
    {
        if (is_array($hideStream)) {
            $useMinMax = false;
            if (isset($hideStream['min'])) {
                $this->addUsingAlias(UserPeer::HIDE_STREAM, $hideStream['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hideStream['max'])) {
                $this->addUsingAlias(UserPeer::HIDE_STREAM, $hideStream['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::HIDE_STREAM, $hideStream, $comparison);
    }

    /**
     * Filter the query on the invisible column
     *
     * Example usage:
     * <code>
     * $query->filterByInvisible(1234); // WHERE invisible = 1234
     * $query->filterByInvisible(array(12, 34)); // WHERE invisible IN (12, 34)
     * $query->filterByInvisible(array('min' => 12)); // WHERE invisible > 12
     * </code>
     *
     * @param     mixed $invisible The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByInvisible($invisible = null, $comparison = null)
    {
        if (is_array($invisible)) {
            $useMinMax = false;
            if (isset($invisible['min'])) {
                $this->addUsingAlias(UserPeer::INVISIBLE, $invisible['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($invisible['max'])) {
                $this->addUsingAlias(UserPeer::INVISIBLE, $invisible['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::INVISIBLE, $invisible, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   User $user Object to remove from the list of results
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function prune($user = null)
    {
        if ($user) {
            $this->addUsingAlias(UserPeer::ID, $user->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
