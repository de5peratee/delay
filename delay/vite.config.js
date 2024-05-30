import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/reg.css',
                'resources/css/log.css',
                'resources/css/new.css',
                'resources/css/popular.css',
                'resources/css/musician.css',
                'resources/css/genres.css',
                'resources/css/burgerMenu.css',
                'resources/css/add_music.css',
                'resources/css/become_musician.css',
                'resources/css/show_genres.css',
                'resources/css/player.css',
                'resources/css/track.css',
                'resources/css/show_musician.css',
                'resources/css/collection.css',

                'resources/js/player.js',
                'resources/js/logValidation.js',
                'resources/js/eyeCheckerReg.js',
                'resources/js/eyeCheckerLog.js',
                'resources/js/add_music_validation.js',
                'resources/js/become_musician_validation.js',
                'resources/js/lazyLoad.js',
                'resources/js/addToCollection.js',
                'resources/js/add_track_block.js',
            ],
            refresh: true,
        }),
    ],
});
