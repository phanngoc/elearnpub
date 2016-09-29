<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class CssViewComposer
{
    private $attachCssView = [
        'frontend.settingmore.category' => 'settingmore.css',
        'frontend.settingmore.language' => 'language.css',
        'frontend.author.custom_author' => 'custom_author_name.css',
        'frontend.author.add_coauthor' => 'add_coauthor.css',
        'frontend.author.add_contributor' => 'add_contributor.css',
        'frontend.author.edit_coauthor' => 'edit_coauthor.css',
        'frontend.author.list_contributor' => 'list_contributor.css',
        'frontend.author.show_edit_contributor' => 'show_edit_contributor.css',
        'frontend.coupon.add_coupon' => 'add_coupon.css',
        'frontend.coupon.list_coupon' => 'list_coupon.css',
        'frontend.coupon.edit_coupon' => 'edit_coupon.css'
    ];

    /**
     * Create a new css composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $nameView = $view->getName();
        if (array_key_exists($nameView, $this->attachCssView)) {
          $view->with('linkfilecss', $this->attachCssView[$nameView]);
        }
    }
}
