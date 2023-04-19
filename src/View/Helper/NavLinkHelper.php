<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\Helper\HtmlHelper;
use Cake\View\Helper\UrlHelper;

/**
 * NavLink helper
 *
 * @property HtmlHelper $Html
 * @property UrlHelper $Url
 */
class NavLinkHelper extends Helper
{
    protected $helpers = ['Html', 'Url'];

    /**
     * @param string $title The content to be wrapped by `<a>` tags.
     * @param string|array $url Cake-relative URL or array of URL parameters, or external URL (starts with http://)
     * @param array $options Array of options and HTML attributes
     * @return string An `<a />` element.
     */
    public function link(string $title, $url = null, array $options = []): string
    {
        $options = $this->Html->addClass((array)$options, 'nav-link');
        $currentUrl = $this->getView()->getRequest()->getRequestTarget();
        $targetUrl = $this->Url->build($url);
        if ($currentUrl === $targetUrl) {
            $options = $this->Html->addClass($options, 'active');
        }

        return $this->Html->tag('li', $this->Html->link($title, $targetUrl, $options), [
            'class' => 'nav-item',
        ]);
    }
}
