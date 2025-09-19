<?php
namespace Tushar\HelloWorld\Block;

use Magento\Framework\View\Element\Template;

class Helloworld extends Template
{
    /**
     * Give Hello World Text
     *
     * @return void
     */
    public function getHelloWorldText()
    {
        return 'Hello world!';
    }
}
