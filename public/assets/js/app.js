// app.js

const $ = require('jquery');
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.css';

require('../css/app.css');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');


// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});