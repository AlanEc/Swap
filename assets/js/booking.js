require('../css/booking.css');


var dateBooked = document.querySelector('.js-user-rating');
var dateBooked = dateBooked.dataset.isAuthenticated;
var jsonDecodeArray = JSON.parse(dateBooked);

$(document).ready(function() {
    $(function () {
        $('input[name="daterange"]').daterangepicker({
            "locale": {
                "format": "DD/MM/YYYY",
                "separator": " - ",
                "applyLabel": "Valider",
                "cancelLabel": "Annuler",
                "fromLabel": "De",
                "toLabel": "à",
                "customRangeLabel": "Custom",
                "daysOfWeek": [
                    "Dim",
                    "Lun",
                    "Mar",
                    "Mer",
                    "Jeu",
                    "Ven",
                    "Sam"
                ],
                "monthNames": [
                    "Janvier",
                    "Février",
                    "Mars",
                    "Avril",
                    "Mai",
                    "Juin",
                    "Juillet",
                    "Août",
                    "Septembre",
                    "Octobre",
                    "Novembre",
                    "Décembre"
                ],
                "firstDay": 1
            },
            'isInvalidDate': function (date) {
                for (var i = 0; i < jsonDecodeArray.length; i++) {
                    var dateStart = '20' + jsonDecodeArray[i].dateStart.year + '-' + jsonDecodeArray[i].dateStart.month + '-' + jsonDecodeArray[i].dateStart.day;
                    var dateEnd = '20' + jsonDecodeArray[i].dateEnd.year + '-' + jsonDecodeArray[i].dateEnd.month + '-' + jsonDecodeArray[i].dateEnd.day;
                    if (date.format('YYYY-MM-DD') == dateStart) {
                        return true;
                    }
                    if (date.format('YYYY-MM-DD') == dateEnd) {
                        return true;
                    }
                    if (moment(date).isAfter(dateStart) == true && moment(date).isBefore(dateEnd) == true) {
                        return true;
                    }
                    if (moment(date).isBefore(moment().format('YYYY-MM-DD'))) {
                        return true;
                    }
                }
            },
        });
    });
});