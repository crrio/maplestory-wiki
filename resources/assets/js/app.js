// jQuery
window.$ = window.jQuery = require('jquery');

// Dependencies
require('./fontawesome');
require('./fa-solid')
require('./fa-brands')
require('./fa-light')
window.tippy = window.tippy ? window.tippy : require('tippy.js');
require('bootstrap');
require('./maple.tooltip');

window.Isotope = window.Isotope ? window.Isotope : require('isotope-layout');
require('imagesloaded');