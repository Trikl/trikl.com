<?php


/**
 * Base class that represents a query for the 'galleries' table.
 *
 *
 *
 * @method GalleriesQuery orderByGalleryid($order = Criteria::ASC) Order by the GalleryID column
 * @method GalleriesQuery orderByUserid($order = Criteria::ASC) Order by the UserID column
 * @method GalleriesQuery orderByGalleryname($order = Criteria::ASC) Order by the GalleryName column
 * @method GalleriesQuery orderByDate($order = Criteria::ASC) Order by the Date column
 *
 * @method GalleriesQuery groupByGalleryid() Group by the GalleryID column
 * @method GalleriesQuery groupByUserid() Group by the UserID column
 * @method GalleriesQuery groupByGalleryname() Group by the GalleryName column
 * @method GalleriesQuery groupByDate() Group by the Date column
 *
 * @method GalleriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method GalleriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method GalleriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Galleries findOne(PropelPDO $con = null) Return the first Galleries matching the query
 * @method Galleries findOneOrCreate(PropelPDO $con = null) Return the first Galleries matching the query, or a new Galleries object populated from the query conditions when no match is found
 *
 * @method Galleries findOneByUserid(int $UserID) Return the first Galleries filtered by the UserID column
 * @method Galleries findOneByGalleryname(string $GalleryName) Return the first Galleries filtered by the GalleryName column
 * @method Galleries findOneByDate(string $Date) Return the first Galleries filtered by the Date column
 *
 * @method array findByGalleryid(int $GalleryID) Return Galleries objects filtered by the GalleryID column
 * @method array findByUserid(int $UserID) Return Galleries objects filtered by the UserID column
 * @method array findByGalleryname(string $GalleryName) Return Galleries objects filtered by the GalleryName column
 * @method array findByDate(string $Date) Return Galleries objects filtered by the Date column
 *
 * @package    propel.generator.social.om
 */
abstract class BaseGalleriesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseGalleriesQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'social', $modelName = 'Galleries', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new GalleriesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     GalleriesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return GalleriesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof GalleriesQuery) {
            return $criteria;
        }
        $query = new GalleriesQuery();
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
     * @return   Galleries|Galleries[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = GalleriesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(GalleriesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Galleries A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneByGalleryid($key, $con = null)
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
     * @return   Galleries A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `GALLERYID`, `USERID`, `GALLERYNAME`, `DATE` FROM `galleries` WHERE `GALLERYID` = :p0';
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
            $obj = new Galleries();
            $obj->hydrate($row);
            GalleriesPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Galleries|Galleries[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Galleries[]|mixed the list of results, formatted by the current formatter
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
     * @return GalleriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GalleriesPeer::GALLERYID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return GalleriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GalleriesPeer::GALLERYID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the GalleryID column
     *
     * Example usage:
     * <code>
     * $query->filterByGalleryid(1234); // WHERE GalleryID = 1234
     * $query->filterByGalleryid(array(12, 34)); // WHERE GalleryID IN (12, 34)
     * $query->filterByGalleryid(array('min' => 12)); // WHERE GalleryID > 12
     * </code>
     *
     * @param     mixed $galleryid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GalleriesQuery The current query, for fluid interface
     */
    public function filterByGalleryid($galleryid = null, $comparison = null)
    {
        if (is_array($galleryid) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(GalleriesPeer::GALLERYID, $galleryid, $comparison);
    }

    /**
     * Filter the query on the UserID column
     *
     * Example usage:
     * <code>
     * $query->filterByUserid(1234); // WHERE UserID = 1234
     * $query->filterByUserid(array(12, 34)); // WHERE UserID IN (12, 34)
     * $query->filterByUserid(array('min' => 12)); // WHERE UserID > 12
     * </code>
     *
     * @param     mixed $userid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GalleriesQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid)) {
            $useMinMax = false;
            if (isset($userid['min'])) {
                $this->addUsingAlias(GalleriesPeer::USERID, $userid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userid['max'])) {
                $this->addUsingAlias(GalleriesPeer::USERID, $userid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GalleriesPeer::USERID, $userid, $comparison);
    }

    /**
     * Filter the query on the GalleryName column
     *
     * Example usage:
     * <code>
     * $query->filterByGalleryname('fooValue');   // WHERE GalleryName = 'fooValue'
     * $query->filterByGalleryname('%fooValue%'); // WHERE GalleryName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $galleryname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GalleriesQuery The current query, for fluid interface
     */
    public function filterByGalleryname($galleryname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($galleryname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $galleryname)) {
                $galleryname = str_replace('*', '%', $galleryname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GalleriesPeer::GALLERYNAME, $galleryname, $comparison);
    }

    /**
     * Filter the query on the Date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE Date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE Date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE Date > '2011-03-13'
     * </code>
     *
     * @param     mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GalleriesQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(GalleriesPeer::DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(GalleriesPeer::DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GalleriesPeer::DATE, $date, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Galleries $galleries Object to remove from the list of results
     *
     * @return GalleriesQuery The current query, for fluid interface
     */
    public function prune($galleries = null)
    {
        if ($galleries) {
            $this->addUsingAlias(GalleriesPeer::GALLERYID, $galleries->getGalleryid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
