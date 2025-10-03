<?php
/**
 * Copyright (C) 2025 Pixel Développement
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace PixelOpen\CloudflareTurnstile\Block;

use PixelOpen\CloudflareTurnstile\Helper\Config;
use PixelOpen\CloudflareTurnstile\Model\Config\Source\Forms\Frontend;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Filter\FilterManager;

class Newsletter extends Template
{
    /**
     * Path to template file in theme.
     *
     * @var string $_template
     */
    protected $_template = 'PixelOpen_CloudflareTurnstile::turnstile.phtml';

    protected FilterManager $filter;

    protected Config $config;

    /**
     * @param Context $context
     * @param FilterManager $filter
     * @param Config $config
     * @param mixed[] $data
     */
    public function __construct(
        Context $context,
        FilterManager $filter,
        Config $config,
        array $data = []
    ) {
        $this->filter = $filter;
        $this->config = $config;

        parent::__construct($context, $data);
    }

    /**
     * Is form enabled?
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return in_array($this->getAction(), $this->config->getFrontendForms());
    }

    /**
     * Retrieve action
     *
     * @return string
     */
    public function getAction(): string
    {
        return Frontend::FORM_NEWSLETTER;
    }

    /**
     * Retrieve id
     *
     * @return string
     */
    public function getId(): string
    {
        return 'cloudflare-turnstile-' . $this->filter->translitUrl($this->getAction());
    }
}
