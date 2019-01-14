require('../css/booking.css');


$(document).ready(function() {
    console.log('coucou');
    $(function () {
        $('#booking_form_date_start').datepicker({
            altField: "#datepicker",
            closeText: 'Fermer',
            prevText: 'Précédent',
            nextText: 'Suivant',
            currentText: 'Aujourd\'hui',
            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
            dayNames: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'],
            dayNamesShort: ['Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.', 'Dim.'],
            dayNamesMin: ['L', 'M', 'M', 'J', 'V', 'S', 'D'],
            weekHeader: 'Sem.',
            dateFormat: 'yy-mm-dd',
            minDate: '0',
            maxTime: '8:00',
            maxDate: '15m',
            beforeShowDay: function (date) {
                var jour = date.getDay();
                var mois = date.getMonth();
                var jourSpec = date.getDate();

                if (jour == 1 || jour == 6) {
                    return [false];
                } else if (mois == 11 && jourSpec == 25) {
                    return [false];
                } else if (mois == 4 && jourSpec == 1) {
                    return [false];
                } else if (mois == 10 && jourSpec == 1) {
                    return [false];
                } else {
                    return [true];
                }
            }
        });
    });
    $(function () {
        $('#booking_form_date_end').datepicker({
            altField: "#datepicker",
            closeText: 'Fermer',
            prevText: 'Précédent',
            nextText: 'Suivant',
            currentText: 'Aujourd\'hui',
            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
            dayNames: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'],
            dayNamesShort: ['Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.', 'Dim.'],
            dayNamesMin: ['L', 'M', 'M', 'J', 'V', 'S', 'D'],
            weekHeader: 'Sem.',
            dateFormat: 'yy-mm-dd',
            minDate: '0',
            maxTime: '8:00',
            maxDate: '15m',
            beforeShowDay: function (date) {
                var jour = date.getDay();
                var mois = date.getMonth();
                var jourSpec = date.getDate();

                if (jour == 1 || jour == 6) {
                    return [false];
                } else if (mois == 11 && jourSpec == 25) {
                    return [false];
                } else if (mois == 4 && jourSpec == 1) {
                    return [false];
                } else if (mois == 10 && jourSpec == 1) {
                    return [false];
                } else {
                    return [true];
                }
            }
        });
    });
});