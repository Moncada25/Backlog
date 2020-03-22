function numbersOnly(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    //Tecla para borrar, siempre la permite
    if (tecla === 8) {
        return true;
    }

    patron = /[0-9]/;
    //patron = /[A-Za-z0-9]/; números y letras
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function showAddTask() {

    var actualizar = document.getElementById('divAddTask');
    var boton = document.getElementById('btnAddTask');

    if (actualizar.style.display == 'block') {
        actualizar.style.display = 'none';
        boton.innerHTML = 'Add Task';
    } else {
        actualizar.style.display = 'block';
        boton.innerHTML = 'Hide';
    }
}

function deleteAlert(id) {

    if (confirm("Are you sure?")) {
        window.location = "home.php?item=tasks&delete=" + id;
    }
}