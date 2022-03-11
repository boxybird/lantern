<?php

namespace BoxyBird\Lantern;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

/**
 * Proof of concept for interacting and
 * integrating with the Laravel from WordPress
 *
 * @wip
 */
class Menu
{
    public static function init(): void
    {
        add_action('admin_menu', [Menu::class, 'menu']);
        add_action('admin_menu', [Menu::class, 'telescope']);
    }

    public static function menu(): void
    {
        add_menu_page(
            'Lantern Options',
            'Lantern',
            'manage_options',
            'lantern-options',
            [Menu::class, 'menuCallback'],
            LANTERN_PLUGIN_URL . '/assets/icons/fire.svg',
        );
    }

    public static function menuCallback(): void
    {
        if (request()->has('cache:clear')) {
            $validator = validator(request()->all(), [
                'cache:clear' => 'required|numeric',
                '_wpnonce'    => ['required', function ($attribute, $value, $fail) {
                    if (wp_verify_nonce($value, 'lantern-options')) {
                        return;
                    }

                    return $fail('Invalid nonce.');
                }],
            ]);

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    ?>
                    <div class="notice notice-error is-dismissible">
                        <p><?= $error; ?></p>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p>Cache cleared</p>
                </div>
                <?php

                cache()->flush();
            }
        } ?>

        <div>
            <h1>Lantern Options</h1>

            <form method="POST">
                <?php submit_button('Clear Laravel Cache'); ?>
                <input type="hidden" name="cache:clear" value="1" />
                <?php wp_nonce_field('lantern-options'); ?>
            </form>
        </div>
        <?php
    }

    public static function telescope(): void
    {
        if (!class_exists(\Laravel\Telescope\Telescope::class)) {
            return;
        }

        add_submenu_page(
            'lantern-options',
            'Telescope',
            'Telescope',
            'manage_options',
            'lantern-telescope-options',
            [Menu::class, 'telescopeCallback'],
        );
    }

    public static function telescopeCallback(): void
    {
        if (!config('telescope.enabled')) {
            ?>
            <div class="notice notice-warning is-dismissible">
                <p>Laravel Telescope is not enabled.</p>
            </div>
            <?php

            return;
        }

        $path = Str::finish(config('app.url'), '/') . config('telescope.path');

        echo '<iframe style="min-height: 100%; width: 100%;" src="' . $path . '" frameborder="0"></iframe>';
    }
}
