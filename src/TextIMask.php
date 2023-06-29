<?php
namespace Osynapsy\Bcl4\TextIMask;

use Osynapsy\Bcl4\TextBox;

/**
 * Description of TextIMaskBox
 *
 * @author peter
 */
class TextIMask extends TextBox
{
    const IMASK_INTEGER = 10;
    const IMASK_NUMBER = 11;
    const IMASK_CURRENCY = 12;
    const IMASK_DATE = 20;

    protected $imask = [
        self::IMASK_INTEGER => [
            'id' => 'Number',
            'class' => 'text-right'
        ],
        self::IMASK_NUMBER  => [
            'id' => 'Number',
            'class' => 'text-right'
        ],
        self::IMASK_CURRENCY => [
            'id' => 'Currency',
            'class' => 'text-right'
        ],
        self::IMASK_DATE => [
            'id' => 'Date',
            'class' => 'text-center'
        ]
    ];

    public function __construct($name, $class = '')
    {
        parent::__construct($name, $class);
        $this->requireJs('lib/imask-6.0.5/imask.js');
        $this->requireJs('bcl4/textimask/script.js');
    }

    public function setMask($maskId)
    {
        $this->validateMaskId($maskId);
        $mask = $this->imask[$maskId];
        $this->addClass(trim('input-mask '.$mask['class']));
        $this->attribute('data-imask', $mask['id']);
    }

    protected function validateMaskId($maskId)
    {
        if (!array_key_exists($maskId, $this->imask)) {
            throw new \Exception("TextBox {$this->id} : iMask format {$maskId} not regnized");
        }
    }
}
