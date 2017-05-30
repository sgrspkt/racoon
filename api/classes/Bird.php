<?php

/**
 * Created by PhpStorm.
 * User: narendra
 * Date: 9/12/16
 * Time: 10:46 PM
 */
class Bird extends Db
{

    public $name;
    public $imageUrl;
    public $_order;
    public $binomial_name;
    public $species;
    public $genus;
    public $family;
    public $id;
    public $reviews;
    public $total;
    public $totalReview;
    public $averageRating;
    protected $table = "birds";


    function __construct( $id = '',$name = '', $imageUrl = '', $_order = '',$binomial_name = '',$species = '',$genus = '',$family = '')
    {
        $this->setId( $id );
        $this->setName( $name );
        $this->setImageUrl( $imageUrl );
        $this->setOrder( $_order );
        $this->setBinomialName( $binomial_name );
        $this->setSpecies( $species );
        $this->setGenus( $genus );
        $this->setFamily( $family );
    }


    /**
     * @return mixed
     */
    public function getAverageRating()
    {
        return $this->averageRating;
    }

    /**
     * @param mixed $averageRating
     */
    public function setAverageRating($averageRating)
    {
        $this->averageRating = $averageRating;
    }


    public function getTotalRe()
    {
        return $this->total;
    }
    
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param mixed $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    public function getBinomialName()
    {
        return $this->binomial_name;
    }/**
     * @param mixed $binomial_name
     */
    public function setBinomialName($binomial_name)
    {
        $this->binomial_name = $binomial_name;
    }/**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->_order;
    }/**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->_order = $order;
    }/**
     * @return mixed
     */
    public function getSpecies()
    {
        return $this->species;
    }/**
     * @param mixed $species
     */
    public function setSpecies($species)
    {
        $this->species = $species;
    }/**
     * @return mixed
     */
    public function getGenus()
    {
        return $this->genus;
    }/**
     * @param mixed $genus
     */
    public function setGenus($genus)
    {
        $this->genus = $genus;
    }/**
     * @return mixed
     */
    public function getFamily()
    {
        return $this->family;
    }/**
     * @param mixed $family
     */
    public function setFamily($family)
    {
        $this->family = $family;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    function save() {

        $this->insert( ['name' => $this->name, 'image_url' => $this->imageUrl ] );

    }

    function getAllBirds()
    {
        $result = $this->getAll();
        $resultArr = [];
        while( $row = $result->fetch_assoc() ) {
            $bird = new self( $row['id'],$row['name'], $row['image_url'], $row['_order'], $row['binomial_name'], $row['species'], $row['genus'], $row['family']);
            $resultArr[] = $bird;
        }
        return $resultArr;

    }


    function sortByAsc()
    {
        $result = $this->getBySortAsc();
        
        while($row = $result->fetch_assoc()) {
            $bird = new self( $row['id'], $row['name'], $row['image_url'], $row['_order'], $row['binomial_name'], $row['species'], $row['genus'], $row['family']);
            $resultArr[] = $bird;
        }
        return $resultArr;
    }

    function sortByDesc()
    {
        $result = $this->getBySortDesc();
        while($row = $result->fetch_assoc()) {
            $bird = new self( $row['id'], $row['name'], $row['image_url'], $row['_order'], $row['binomial_name'], $row['species'], $row['genus'], $row['family']);
            $resultArr[] = $bird;
        }
        return $resultArr;
    }

    function getByRateHighs()
    {
        $result = $this->getByRateHigh();
        while($row = $result->fetch_assoc()) {
            $bird = new self( $row['id'], $row['name'], $row['image_url'], $row['_order'], $row['binomial_name'], $row['species'], $row['genus'], $row['family']);
            $resultArr[] = $bird;
        }
        return $resultArr;
    }

    function getByRateLows()
    {
        $result = $this->getByRateLow();
        while($row = $result->fetch_assoc()) {
            $bird = new self( $row['id'], $row['name'], $row['image_url'], $row['_order'], $row['binomial_name'], $row['species'], $row['genus'], $row['family']);
            $resultArr[] = $bird;
        }
        return $resultArr;
    }

    function getTotal()
    {
        $total = $this->totalResult();
        $row = $total->fetch_assoc();
        $this->total = $row['cnt'];
        return $total;

    }
    function getTotalReview( $id ){
        $review = $this->total_review( $id );
        $result = $review->fetch_assoc();
        return $result;
    }

    function getOne( $id ) {

        $result = $this->getById( $id );
        $bird = new self();
        if( $result->num_rows > 0 ) {
            $row = $result->fetch_assoc();
            $bird = new self( $row['id'], $row['name'], $row['image_url'], $row['_order'], $row['binomial_name'], $row['species'], $row['genus'], $row['family']);

            $bird->getReviews();
            $reviews = $bird->getReviews();
            $bird->getTotal();

            $totalRating = 0;
            $reviewRating = 0;
            foreach( $reviews as $review ) {
                ++$totalRating;
                $reviewRating += $review->getRating();
            }

            if( empty( $reviewRating ) ) {
                $bird->setAverageRating( 0 );
            } else {
                $bird->setAverageRating ( $reviewRating / ( $totalRating ) );
            }

        }

        return json_encode( $bird );

    }

    function setReviews( $reviews ) {

        $this->reviews = $reviews;
    }

    function getReviews() {

        $result = $this->getRelated('bird_review', 'birds_id', $this->getId() );
        $reviewsArr = [];
        if( $result->num_rows > 0 ) {
            while ( $row = $result->fetch_assoc() ) {
                $review = new Review();
                $review->setKey( $row['viewer_key']);
                $review->setId( $row['id']);
                $review->setName($row['reviewer_name']);
                $review->setReviewText( $row['review']);
                $review->setBirdId( $row['birds_id']);
                $review->setRating( $row['rating']);
                $review->setViewerEmail($row['viewer_email']);
                $review->setViewerDate($row['review_date']);
                $reviewsArr[] = $review;
            }
        }

        $this->setReviews( $reviewsArr );
        return $reviewsArr;
    }
}