/*------------------------------------solo numero en los input--------------------------------*/
$(function () {
    $('.solo_numero').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});
/*------------------------------------solo texto en los input--------------------------------*/

function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-39-46";
    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }
    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
    }
}
/*------------------------------------validar correo --------------------------------*/
function caracteresCorreoValido(email, div) {
    console.log(email);
    var email = $(email).val();
    var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);

    if (caract.test(email) == false) {
        swal({
            title: "Correo invalido",
            confirmButtonColor: "#F44336",
            icon: "success",
            timer: 6000000,
            background: '#ffffff'

        });
        return false;
    } else {
        swal({
            title: "Correo invalido",
            confirmButtonColor: "#F44336",
            icon: "success",
            timer: 6000000,
            background: '#ffffff'

        });
        return true;
    }
}
