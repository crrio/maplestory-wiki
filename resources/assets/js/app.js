// jQuery
window.$ = window.jQuery = require('jquery');

// Dependencies
require('./fontawesome');
require('./fa-solid')
require('./fa-brands')
require('./fa-light')
window.Popper = window.Popper ? window.Popper : require('./popper');
require('bootstrap');

window.Isotope = window.Isotope ? window.Isotope : require('isotope-layout');