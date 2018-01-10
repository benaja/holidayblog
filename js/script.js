var autoHeight = new Array();
var open = new Array();

/*
$(document).ready(function () {
    //alert("ready");
    var counter = 0;
    $('#beitraege > div').each(function () {
        autoHeight[counter] = $("#" + (counter + 1)).height();
        //alert(autoHeight[counter]);
        open[counter] = false;
        counter++;
        $("#" + counter).height("7.4em");
    });
})

function show(id) {
    if (open[id] == false) {
        $("#" + id).animate({
            height: autoHeight[id - 1] + 80,
        });
        open[id] = true;
    } else {
        $("#" + id).animate({
            height: "7.4em",
            paddingBottom: "0"
        });
        open[id] = false;
    }

}
*/
function loeschen(id) {
    swal({
        title: 'Bist du sicher?',
        text: "Löschen kann nicht rückgängig gemacht werden!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            swal(
                'Gelöscht!',
                'Der Beitrag wurde erfolgreich gelöscht.',
                'success'
            )
        }
    })
}

$(document).ready(function () {
    var textarea = document.querySelector('textarea');

    textarea.addEventListener('keydown', autosize);

    function autosize() {
        var el = this;
        setTimeout(function () {
            el.style.cssText = 'height:auto; padding:0';
            // for box-sizing other than "content-box" use:
            // el.style.cssText = '-moz-box-sizing:content-box';
            el.style.cssText = 'height:' + el.scrollHeight + 'px';
        }, 0);
    }
});
