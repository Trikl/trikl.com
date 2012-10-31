<?php


/**
 * Base class that represents a query for the 'profile' table.
 *
 *
 *
 * @method ProfileQuery orderByUserid($order = Criteria::ASC) Order by the userid column
 * @method ProfileQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method ProfileQuery orderByBio($order = Criteria::ASC) Order by the bio column
 * @method ProfileQuery orderByWebsite($order = Criteria::ASC) Order by the website column
 *
 * @method ProfileQuery groupByUserid() Group by the userid column
 * @method ProfileQuery groupByPhone() Group by the phone column
 * @method ProfileQuery groupByBio() Group by the bio column
 * @method ProfileQuery groupByWebsite() Group by the website column
 *
 * @method ProfileQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ProfileQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ProfileQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Profile findOne(PropelPDO $con = null) Return the first Profile matching the query
 * @method Profile findOneOrCreate(PropelPDO $con = null) Return the first Profile matching the query, or a new Profile object populated from the query conditions when no match is found
 *
 * @method Profile findOneByPhone(string $phone) Return the first Profile filtered by the phone column
 * @method Profile findOneByBio(string $bio) Return the first Profile filtered by the bio column
 * @method Profile findOneByWebsite(string $website) Return the first Profile filtered by the website column
 *
 * @method array findByUserid(int $userid) Return Profile objects filtered by the userid column
 * @method array findByPhone(string $phone) Return Profile objects filtered by the phone column
 * @method array findByBio(string $bio) Return Profile objects filtered by the bio column
 * @method array findByWebsite(string $website) Return Profile objects filtered by the website column
 *
 * @package    propel.generator.social.om
 */
abstract class BaseProfileQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseProfileQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'social', $modelName = 'Profile', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ProfileQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     ProfileQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ProfileQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ProfileQuery) {
            return $criteria;
        }
        $query = new ProfileQuery();
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
     * @return   Profile|Profile[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProfilePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Profile A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneByUserid($key, $con = null)
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
     * @return   Profile A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `USERID`, `PHONE`, `BIO`, `WEBSITE` FROM `profile` WHERE `USERID` = :p0';
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
            $obj = new Profile();
            $obj->hydrate($row);
            ProfilePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Profile|Profile[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Profile[]|mixed the list of results, formatted by the current formatter
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
     * @return ProfileQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProfilePeer::USERID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ProfileQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProfilePeer::USERID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the userid column
     *
     * Example usage:
     * <code>
     * $query->filterByUserid(1234); // WHERE userid = 1234
     * $query->filterByUserid(array(12, 34)); // WHERE userid IN (12, 34)
     * $query->filterByUserid(array('min' => 12)); // WHERE userid > 12
     * </code>
     *
     * @param     mixed $userid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProfileQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(ProfilePeer::USERID, $userid, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%'); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProfileQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phone)) {
                $phone = str_replace('*', '%', $phone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfilePeer::PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the bio column
     *
     * Example usage:
     * <code>
     * $query->filterByBio('fooValue');   // WHERE bio = 'fooValue'
     * $query->filterByBio('%fooValue%'); // WHERE bio LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bio The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProfileQuery The current query, for fluid interface
     */
    public function filterByBio($bio = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bio)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bio)) {
                $bio = str_replace('*', '%', $bio);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfilePeer::BIO, $bio, $comparison);
    }

    /**
     * Filter the query on the website column
     *
     * Example usage:
     * <code>
     * $query->filterByWebsite('fooValue');   // WHERE website = 'fooValue'
     * $query->filterByWebsite('%fooValue%'); // WHERE website LIKE '%fooValue%'
     * </code>
     *
     * @param     string $website The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProfileQuery The current query, for fluid interface
     */
    public function filterByWebsite($website = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($website)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $website)) {
                $website = str_replace('*', '%', $website);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfilePeer::WEBSITE, $website, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Profile $profile Object to remove from the list of results
     *
     * @return ProfileQuery The current query, for fluid interface
     */
    public function prune($profile = null)
    {
        if ($profile) {
            $this->addUsingAlias(ProfilePeer::USERID, $profile->getUserid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
