<?php
namespace OnyxLogger\Model;

/**
 * Log model
 *
 * This is a class generated with Paul's Zend MVC Model Generator.
 *
 * @author Paul Headington
 * @createdOn
 * @license Copyright (c) 2014, Paul HeadingtonAll rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 * notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 * notice, this list of conditions and the following disclaimer in the
 * documentation and/or other materials provided with the distribution.
 * 3. All advertising materials mentioning features or use of this software
 * must display the following acknowledgement:
 * This product includes software developed by the <organization>.
 * 4. Neither the name of the <organization> nor the
 * names of its contributors may be used to endorse or promote products
 * derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY Paul Headington 'AS IS' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL Paul Headington BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */
class Log
{

    protected $_id = null;

    protected $_eventname = null;

    protected $_data = null;

    protected $_controller = null;

    protected $_action = null;

    protected $_params = null;

    protected $_postdate = null;

    protected $_message = null;

    const filter = null;

    protected $validation = array(
        'id' => array(
            'required' => false,
            'type' => 'int'
        ),
        'eventname' => array(
            'required' => false,
            'type' => 'string'
        ),
        'data' => array(
            'required' => false,
            'type' => 'string'
        ),
        'controller' => array(
            'required' => false,
            'type' => 'string'
        ),
        'action' => array(
            'required' => false,
            'type' => 'string'
        ),
        'params' => array(
            'required' => false,
            'type' => 'string'
        ),
        'postdate' => array(
            'required' => false,
            'type' => ''
        ),
        'message' => array(
            'required' => false,
            'type' => 'string'
        )
    );

    /**
     * build the model
     */
    public function __construct($options)
    {
        if (is_array($options)) {
        	$this->setOptions($options);
        }
        $this->filter = new Zend_Filter();
        $this->filter->addFilter(new Zend_Filter_StripTags())
        	->addFilter(new Zend_Filter_StripNewlines())
        	->addFilter(new Zend_Filter_StringTrim());
    }

    /**
     * Validation selector
     */
    public function whatValidation($name)
    {
        return $this->validation[$name];
    }

    /**
     * set array data to object
     */
    public function exchangeArray($data)
    {
        $this->id		= (isset($data["id"])) ? $data["id"] : null;
        $this->eventname		= (isset($data["eventname"])) ? $data["eventname"] : null;
        $this->data		= (isset($data["data"])) ? $data["data"] : null;
        $this->controller		= (isset($data["controller"])) ? $data["controller"] : null;
        $this->action		= (isset($data["action"])) ? $data["action"] : null;
        $this->params		= (isset($data["params"])) ? $data["params"] : null;
        $this->postdate		= (isset($data["postdate"])) ? $data["postdate"] : null;
        $this->message		= (isset($data["message"])) ? $data["message"] : null;
    }


}

?>