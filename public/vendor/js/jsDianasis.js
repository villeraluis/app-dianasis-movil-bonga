var resizeTimer;
var w = window.innerWidth;
//Ejecutar a cambiar de tamaño
$(window).resize(function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(Resized(), 100);
});

function Resized() {
    if (window.innerWidth != w) {
        $(".select2-custom").select2({
            theme: "bootstrap-5",
        });
        w = window.innerWidth;
    }
}

///esta funcion se ejecuta al hacer scroll
window.onscroll = function () {
    const altoDiv = $("#content").outerHeight();

    if (altoDiv + 80 > window.innerHeight) {
        sty = "--altura-sidebar: " + altoDiv + "px;";
    } else {
        sty = "--altura-sidebar: calc(100vh - 80px);";
    }

    $(".div-sidebar").attr({ style: sty });
};

/////

const cargandoAjax = () => {
    $body = $("body");
    $(document).on({
        ajaxStart: function () {
            $body.addClass("loading");
        },
        ajaxStop: function () {
            $body.removeClass("loading");
        },
    });
};

const ob = {
    paging: false,
    info: false,
};

const ftablaDatatables = (id) => {
    const tablaDatos = $(id).DataTable({
        lengthMenu: [
            [20, 50, 80, 100, 200],
            [20, 50, 80, 100, 200, "Todos"],
        ],

        aaSorting: [],

        language: {
            lengthMenu: "Mostrar _MENU_ Registros",
            zeroRecords: "No se encontraron resultados",
            info: "Existen _TOTAL_ Registros", //"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty:
                "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",

            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior",
            },
            sProcessing: "Procesando...",
            search: "Buscar:",
        },

        //para usar los botones
        responsive: false,
        dom: "Bfrtilp",
    });

    return tablaDatos;
};

const opcionNivel1 = () => {
    $("#agregarOpcionMenu").on("click", function () {
        $("#modalAgregarOpcion").modal("show");
        $("#padreOpcionActual").val("2");
        $("#NivelOpcionActual").val("1");
    });
};

const opcionNivel2 = () => {
    $(".opcionNivel2").on("click", function () {
        let clasesNivel1 = $(this).attr("class").split(/\s+/);
        let idPadre = clasesNivel1[0];

        $("#modalAgregarOpcion").modal("show");
        $("#padreOpcionActual").val(idPadre);
        $("#NivelOpcionActual").val("2");
    });
};

const addContenido = () => {
    $(".add-contenido").on("click", function () {
        let clases = $(this).attr("class").split(/\s+/);
        let nombreOpcionPadre = clases[1];

        $("#modalConfigurarContenido").modal("show");

        $("#idPadreOpcionActual").val($("#idPadreContenidoEnlaceAdd").val());

        $(".nombre-padre").text("a " + nombreOpcionPadre.replaceAll("-", " "));
    });
};

const cargarContenido = () => {
    $(".ver-contenido-opcion").on("click", function () {
        $(".ver-contenido-opcion").parent().removeClass("menu-activo");
        $(this).parent().addClass("menu-activo");

        verContenido(idOpcionPadre);
    });
};

const verContenido = (idPadre) => {
    $("#contenido").empty();

    let _url = route("contenido.show", idPadre);

    $.ajax({
        url: _url,
        type: "GET",
        data: null,
        success: function (response) {
            $(" #content,#divSidebar,.div-sidebar").removeClass("active");

            $("#contenido").empty();
            $("#contenido").append(response);
        },
    });
};

const formatoMoneda = (int) => {
    if (!isNaN(int)) {
        return new Intl.NumberFormat("es-CO", {
            style: "currency",
            currency: "COP",
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        }).format(int);
    } else {
        return int;
    }
};

const controlFila = () => {
    $(".btn-eliminar-fila").on("click", function (e) {
        e.preventDefault();
        let clases = $(this).attr("class").split(/\s+/);
        let idFila = clases[0];

        $("#idFilaModalDestroy").val(idFila);
        $("#modalEliminarFila").modal("show");
    });

    $(".btn-editar-fila").on("click", function (e) {
        e.preventDefault();
        $("#formEditContenidoFila").remove();
        let clases = $(this).attr("class").split(/\s+/);
        let idFila = clases[0];

        let _url = route("contenido.edit", idFila);

        let elem = $(this);
        $.ajax({
            url: _url,
            type: "GET",
            data: null,
            success: function (response) {
                elem.parent().parent().append(response);
            },
        });
    });
};

const exportarEcxel = (selectorTabla, titulo = "Tabla_datos") => {

    $(selectorTabla+'>tbody tr').each(function(index, element) {
           
        if($(this).is(':hidden')){
            $(this).addClass('oculto')
        }else{
            $(this).removeClass('oculto') 
        }


    })


    $(selectorTabla).table2excel({
        exclude: ".noExl,.oculto",
        name: "Worksheet Name",
        filename: "Tabla_" + titulo,
        fileext: ".xls",
        preserveColors: true,
        exclude_links: true,
    });
};

const controlBusquedas = () => {
    $(".btnVerTabla").on("click", function () {
        if ($(".div-tabla-ventas-oculto").is(":visible")) {
            $(".div-tabla-ventas-oculto").prop("hidden", true);
            $(this).text("Ver Tabla Informe");
        } else {
            $(".div-tabla-ventas-oculto")
                .prop("hidden", false)
                .trigger("focus");
            $(this).text("Ocultar Tabla Informe");
        }
    });

    $(".btnVerGrafico").on("click", function () {
        if ($(".divGrafico").is(":visible")) {
            $(".divGrafico").prop("hidden", true);
            $(this).text("Ver Grafica");
        } else {
            $(".divGrafico").prop("hidden", false);
            $(this).text("Ocultar Grafica");
        }
    });

    $(".btnVerConsultas").on("click", function () {
        if ($(".div-card-consulta").is(":visible")) {
            $(".div-card-consulta").prop("hidden", true);
            $(this).html(
                '<i class="fas fa-arrow-left"></i> <span> Ver Consultas</span>'
            );
        } else {
            $(".div-card-consulta").prop("hidden", false);
            $(this).text("Ocultar Consultas");
        }
    });

    $(".btnVerOtrosParametros").on("click", function () {
        $(".divParamtros,.divBotonesEnviar").prop("hidden", false);
        $(".divControlVistaParam").prop("hidden", true);
    });

    $(".btnVolverCierraParam").on("click", function () {
        $(".divParamtros,.divBotonesEnviar").prop("hidden", true);
        $(".divControlVistaParam").prop("hidden", false);
    });

    $(".btnHoy").on("click", function (e) {
        e.preventDefault();
        let fechaHoy = $(".InputHidFechaActual").val();
        $(".fechaInicial,.fechaFinal").val(fechaHoy);
        $("#formConsultaInformes").submit();
    });

    $(".btnMes").on("click", function (e) {
        e.preventDefault();
        let inicioMes = $(".inputInicioMes").val();
        let fechaHoy = $(".InputHidFechaActual").val();
        $(".fechaInicial").val(inicioMes);
        $(".fechaFinal").val(fechaHoy);

        $("#formConsultaInformes").submit();
    });

    $(".botonEnviarForm").on("click", function (e) {
        e.preventDefault();
        $("#formConsultaInformes").submit();
    });
};

const getVistas = (route, metodo, e) => {
    cargandoAjax();
    e.preventDefault();
    $("#contenido").empty();

    let _url = route;

    $.ajax({
        url: _url,
        type: metodo,
        data: null,
        success: function (response) {
            $(" #content,#divSidebar,.div-sidebar").removeClass("active");

            $("#contenido").empty().append(response);

            $("#btn-activa-menu").removeClass("close").addClass("normal");
        },
    });
};

const postConsultas = (route, data, e, metodo = "POST") => {
    e.preventDefault();
    cargandoAjax();

    $.ajax({
        url: route,
        type: metodo,
        data: data,
        success: function (response) {
            $("#btn-activa-menu").removeClass("close").addClass("normal");

            $(".divParamtros,.divBotonesEnviar,.divBtnVerTabla").prop(
                "hidden",
                true
            );

            $(".divControlVistaParam,.btnVerConsultas,.div-card-consulta").prop(
                "hidden",
                false
            );

            $("#sectionTablaInformes").empty().append(response);

            if ($("#sectionTablaInformes > div").length > 1) {
                $(".div-card-consulta,.divParamtros,.divBotonesEnviar").prop(
                    "hidden",
                    true
                );
                $(".divBtnVerTabla,.btnVerConsultas").prop("hidden", false);
            }
        },
        error: function (err) {
            $(".spinnerCargando").prop("hidden", true);
            $(".lupaBtnBuscar").prop("hidden", false);
            alert(err);
        },
    });
};

const getBusquedas = async (route) => {
    try {
        cargandoAjax();

        return await $.ajax({
            url: route,
            type: "GET",
        });
    } catch (error) {
        console.error(error);
    }
};

const generatablaCodigoNombre = (obj) => {
    const idModal = obj.idModal;
    const clasLink = obj.clasLink;
    const linkClick = obj.linkClick;
    const clasTabla = obj.clasTabla;
    const rout = obj.rout;
    const idVal = obj.idVal;
    const idescVal = obj.idescVal;
    const allDatos = obj.allDatos;
    const col = obj.canCol;

    if ($.fn.DataTable.isDataTable(clasTabla)) {
        $(clasTabla).DataTable().destroy();
    }

    getBusquedas(rout).then(function (val) {
        $(idModal).modal("show");

        let td = "";
        for (i = 1; i <= col; i++) {
            td += '<th scope="col">' + obj["th" + i] + " </th>";
        }

        let html = `<thead>
                        <tr>
                          ${td}
                        </tr>
                    </thead>
                    <tbody>`;

        for (dato of val) {
            td = "";

            for (i = 1; i <= col; i++) {
                td += `<td class="${clasLink}" role="button">${
                    dato[obj["dato" + i]]
                }</td>`;
            }

            html += ` <tr>
               
                ${td}
            </tr>`;
        }

        html += " </tbody>";

        $(clasTabla).empty().append(html);
        const tablaDatos = $(clasTabla).find("tbody > tr");
        const dtatableRes = ftablaDatatables(clasTabla);

        $(`${clasTabla} tbody`).on("click", linkClick, (e) => {
            const idf = $(e.currentTarget).parent().find("td").eq(0).html();
            const nombres = $(e.currentTarget).parent().find("td").eq(1).html();

            $(idVal).val(idf);
            $(idescVal).val(nombres);
            $(idModal).modal("hide");
        });

        $(allDatos).on("click", function (e) {
            e.preventDefault();
            $(idVal).val("");
            $(idescVal).val("");
            $(idModal).modal("hide");
        });
    });
};

const filtroTabla = (idTabla, idInput) => {
    const tableReg = document.getElementById(idTabla);
    const searchText = document.getElementById(idInput).value.toLowerCase();
    let total = 0;
    // Recorremos todas las filas con contenido de la tabla
    for (let i = 1; i < tableReg.rows.length; i++) {
        // Si el td tiene la clase "noSearch" no se busca en su cntenido
        if (tableReg.rows[i].classList.contains("noSearch")) {
            continue;
        }
        let found = false;
        const cellsOfRow = tableReg.rows[i].getElementsByTagName("td");
        // Recorremos todas las celdas
        for (let j = 0; j < cellsOfRow.length && !found; j++) {
            const compareWith = cellsOfRow[j].innerHTML.toLowerCase();
            // Buscamos el texto en el contenido de la celda
            if (
                searchText.length == 0 ||
                compareWith.indexOf(searchText) > -1
            ) {
                found = true;
                total++;
            }
        }

        if (found) {
            tableReg.rows[i].style.display = "";
        } else {
            // si no ha encontrado ninguna coincidencia, esconde la
            tableReg.rows[i].style.display = "none";
            // fila de la tabla
        }
    }
}



const tamVentana = () => {
    var tam = [0, 0];
    if (typeof window.innerWidth != "undefined") {
        tam = [window.innerWidth, window.innerHeight];
    } else if (
        typeof document.documentElement != "undefined" &&
        typeof document.documentElement.clientWidth != "undefined" &&
        document.documentElement.clientWidth != 0
    ) {
        tam = [
            document.documentElement.clientWidth,
            document.documentElement.clientHeight,
        ];
    } else {
        tam = [
            document.getElementsByTagName("body")[0].clientWidth,
            document.getElementsByTagName("body")[0].clientHeight,
        ];
    }
    return tam;
};

///////////////////

// -------------------- Gestión del historial -------------------------- ---------
/* function loadToDiv(url, title, usePush) {
    $("#mycontent").load(url, function (e) {
        bindDivA();
    });
    if (title) {
        $("#contentHeader").html(title);
    }
    var state = { pageurl: url, pagetitle: title };

    if (usePush) {
        console.log("push state of " + state);
        history.pushState(
            state,
            title,
            "/?child=" + url + "&title=" + $("#contentHeader").text()
        );
    }
}


function bindDivA() {
    console.log("bindInframeA called");
    $(".inframe").bind("click", function (e) {
        //var href = this.href;
        var href = $(this).attr("href");
        var title = $(this).text();
        console.log("visit href " + href);
        loadToDiv(href, title, true);
        return false;
    });
}


$(document).ready(function () {
    bindDivA();
});


if (history.pushState) {
    window.addEventListener("popstate", function () {
        console.log(
            "popstate called ,href=" +
                location.href +
                ", state = " +
                history.state
        );
        if (!history.state) return;
        console.log(history.state);
        loadToDiv(history.state.pageurl, history.state.pagetitle, false);
    });
} */
// -------------------- Gestión de fin de historial ------------------------- ----------
