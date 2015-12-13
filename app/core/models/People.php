<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 07.12.2015
 * Time: 20:24
 */

namespace app\core\models;

use app\base\models\Collection;
use Phalcon\Mvc\Model\Validator\Numericality;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Regex;
use Phalcon\Mvc\Model\Validator\StringLength;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class People extends Collection
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $first_name;

    /**
     * @var string
     */
    public $last_name;

    /**
     * get the collection name
     *
     * @return string
     */
    public function getSource()
    {
        return 'people';
    }

    /**
     * validate the people model using the following rules
     * id must be present
     * id must be integer
     * id must be unique
     *
     * first_name must be present
     * first_name must be alpha only
     * first_name must not be shorter than 2 characters (ex: Ib)
     * first_name must not be longer than 60 characters
     *
     * last_name must be present
     * last_name must be alpha only
     * last_name must not me shorter than 2 characters
     * last_name must not be longer than 60 characters
     *
     * @return bool
     * @throws \app\base\exceptions\InvalidConfigException
     */
    public function validation()
    {
        $this->attachValidators([
            //id
            new PresenceOf([
                'field'     => 'id',
                'message'   => 'Please provide a valid id for the person'
            ]),
            new Numericality([
                'field'     => 'id',
                'message'   => 'The id must be a number'
            ]),
            new Uniqueness([
                'field'     => 'id',
                'message'   => 'The id must be unique'
            ]),
            //first_name
            new PresenceOf([
                'field'     => 'first_name',
                'message'   => 'Please provide a valid first name for the person'
            ]),
            //[A-Z][a-zA-Z]* - must match
            new Regex([
                'field'     => 'first_name',
                'pattern'   => '[A-Z][a-zA-Z]*'
            ]),
            new StringLength([
                'field'     => 'first_name',
                'max'       => 50,
                'min'       => 2,
                'messageMaximum' => 'We don\'t like really long names',
                'messageMinimum' => 'We want more than just their initials'
            ]),
            //last_name
            new PresenceOf([
                'field'     => 'last_name',
                'message'   => 'Please provide a valid last name for the person'
            ]),
            //[a-zA-z]+([ '-][a-zA-Z]+)*
            new Regex([
                'field'     => 'last_name',
                'pattern'   => '[a-zA-z]+([ \'-][a-zA-Z]+)*'
            ]),
            new StringLength([
                'field'     => 'last_name',
                'max'       => 50,
                'min'       => 2,
                'messageMaximum' => 'We don\'t like really long names',
                'messageMinimum' => 'We want more than just their initials'
            ]),
        ]);

        if ($this->validationHasFailed() === true) {
            return false;
        }
    }
}