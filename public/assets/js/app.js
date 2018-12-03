
import $ from 'jquery';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.css';

require('../css/app.css');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip();
    console.log('llklklk');
});