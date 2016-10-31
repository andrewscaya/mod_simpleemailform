<?php

use \Joomla\Registry\Registry;

class sefv2modsimpleemailform implements
    sefv2jformproxyinterface,
    sefv2formrendererinterface
{

    /**
     * @var JForm
     * @since 2.0.0
     */
    private $jForm;

    /**
     * @var JMail
     * @since 2.0.0
     */
    private $jMail;

    /**
     * @var JDocument
     * @since 2.0.0
     */
    private $jDocument;

    /**
     * @var Registry
     * @since 2.0.0
     */
    private $params;

    /**
     * sefv2modsimpleemailform constructor.
     * @param JForm $jForm
     * @param JMail $jMail
     * @param JDocument $jDocument
     * @param Registry $params
     *
     * @since 2.0.0
     */
    public function __construct(
        \JForm $jForm,
        \JMail $jMail,
        \JDocument $jDocument,
        Registry $params
    ) {

        $this->jForm = $jForm;
        $this->jMail = $jMail;
        $this->jDocument = $jDocument;
        $this->params = $params;
    }

    public function bind()
    {
        // @TODO: Implement bind() method.
    }

    public function filter()
    {
        // @TODO: Implement filter() method.
    }

    public function getData()
    {
        // @TODO: Implement getData() method.
    }

    public function getField()
    {
        // @TODO: Implement getField() method.
    }

    public function addField()
    {
        // @TODO: Implement addField() method.
    }

    public function removeField()
    {
        // @TODO: Implement removeField() method.
    }

    public function getFieldset()
    {
        // @TODO: Implement getFieldset() method.
    }

    public function load()
    {
        // @TODO: Implement load() method.
    }

    public function reset()
    {
        // @TODO: Implement reset() method.
    }

    public function validate()
    {
        // @TODO: Implement validate() method.
    }

    public function render()
    {
        // @TODO: Implement render() method.
    }
}
