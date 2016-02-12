<?php
/**
 * Cakephp3Exmail
 * Cakephp3Exmail is extended Class of Cake\Mailer\Email.
 * Send Emails with Base64 or quoted-printable.
 *
 * @copyright    Copyright © 2015 oh-sky
 * @link         https://github.com/oh-sky/cakephp3-base64-email
 * @package      Cakephp3Exmail
 * @license      MIT License
 * @author oh-sky <yoshihiro.ohsuka@gmail.com>
 */

namespace OhSky\Cakephp3Exmail;

use Cake\Mailer\Email;
use Cake\Core\Configure;
use OhSky\Cakephp3Exmail\Encoder;

/**
 * Cakephp3Exmail
 * CakePHP3 extension to encode the message body with Base64.
 *
 * @package      Cakephp3Exmail
 */
class Cakephp3Exmail extends Email
{
    protected $_contentTransferEncoding = null;
    protected $_encoderName = null;

    /**
     * @param array|string|null $config Array of configs, or string to load configs from email.php
     */
    public function __construct($config = null)
    {
        parent::__construct($config);
        $this->contentTransferEncoding($config['contentTransferEncoding']);
    }

    /**
     * @param string|null $config Array of configs, or string to load configs from email.php
     */
    protected function contentTransferEncoding($contentTransferEncoding = null)
    {
        if ($contentTransferEncoding === null) {
            return @$this->_profile['contentTransferEncoding'];
        }

        $this->_applyConfig([
            'contentTransferEncoding' => $contentTransferEncoding,
        ]);
        if (isset($this->_profile['contentTransferEncoding'])) {
            $this->_contentTransferEncoding = $this->_profile['contentTransferEncoding'];
        }
        return $this->_contentTransferEncoding;
    }

    /**
     * Build and set all the view properties needed to render the templated emails.
     * If there is no template set, the $content will be returned in a hash
     * of the text content types for the email.
     *
     * @param string $content The content passed in from send() in most cases.
     * @return array The rendered content with html and text keys.
     */
    protected function _renderTemplates($content)
    {
        $encoder = 'OhSky\\Cakephp3Exmail\\Encoder\\' . $this->_getEncoderName();
        $rendered = parent::_renderTemplates($content);
        // @todo encode all properties (not only text)
        $rendered['text'] = $encoder::encode($rendered['text']);
//        $rendered['html'] = $encoder::encode($rendered['html']);
        return $rendered;
    }


    /**
     * @param string $contentTransferEncoding
     * @return void
     */
    public function setContentTransferEncoding($contentTransferEncoding)
    {
        $this->_contentTransferEncoding = $contentTransferEncoding;
    }

    /**
     * @return string
     */
    protected function _getContentTransferEncoding()
    {
        return $this->_contentTransferEncoding;
    }

    /**
     * @return string|false
     */
    protected function _getEncoderName()
    {
        $encoderPrefix = $this->_getEncoderPrefix();
        if (!strlen($encoderPrefix)) {
            return false;
        }
        return $encoderPrefix . 'Encoder';
    }

    /**
     * @return string|false
     */
    protected function _getEncoderPrefix()
    {
        if (!is_string($this->_contentTransferEncoding)) {
            return false;
        }
        return ucfirst(preg_replace_callback('/-([a-z])/i', function ($matches) {
            return strtoupper($matches[1]);
        }, $this->_contentTransferEncoding));
    }
}
