/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
require('./image/badge.png');
require('./image/plus.png');
require('./image/gladiator.png');
require('./image/search.png');
require('./image/treasure.png');
require('./image/coin.png');
require('./image/roman-helmet.png');
require('./image/star.png');


// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

import "../node_modules/bootstrap/dist/js/bootstrap.bundle";
// start the Stimulus application
import './bootstrap';

