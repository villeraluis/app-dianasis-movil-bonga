const redondeaNum = (intN) => {
    let temporal = 0;
    for (i = 0; i < 1000000; i++) {
        let nuT = (intN + i) % 1000000;

        if (nuT == 0) {
            temporal = intN + i + 1000000;
        }
    }

    if (temporal > 0) {
        return temporal;
    }
    return intN;
};

const redondeaNumMenor = (intN) => {
    let temporal = 0;
    for (i = 0; i > -1000000; i--) {
        let nuT = (intN + i) % 1000000;

        if (nuT == 0) {
            temporal = intN + i - 1000000;
        }
    }

    if (temporal < 0) {
        return temporal;
    }
    return intN;
};

const getMaxOfArray = (numArray) => {
    return Math.max.apply(null, numArray);
};

const getMinOfArray = (numArray) => {
    let arr = numArray.filter(function (e) {
        return e != 0;
    });

    // console.log(arr);

    return Math.min.apply(null, arr);
};

const panStatus = () => (zoomOptions.pan.enabled ? "enabled" : "disabled");
const zoomStatus = () =>
    zoomOptions.zoom.wheel.enabled ? "enabled" : "disabled";

/*  */
/*  */
///espacio par funciones y datos de ayuda

const months = [
    "ENE",
    "FEB",
    "MAR",
    "ABR",
    "MAY",
    "JUN",
    "JUL",
    "AGO",
    "SEP",
    "OCT",
    "NOV",
    "DIC",
];

const dias = ["D", "L", "M", "Mi", "J", "V", "S"];

const formatDateLarge = (date) => {
    let formatted_date =
        dias[date.getDay()] +
        "-" +
        date.getDate() +
        "-" +
        months[date.getMonth()] +
        "-" +
        date.getFullYear();
    return formatted_date;
};

const addDays = function (fechainicial, fechaFinal, ventasObj) {
    let da = [];
    let arrValor = [];
    let arrD = [];
    let arrCantidad = [];

    //separar los valores y las fechas en dos valores
    //los nombres sin repetir
    let fechas = [...new Set(ventasObj.map((x) => x.fecha))];

    fechas.forEach((fech) => {
        let filtro = ventasObj.filter((x) => x.fecha == fech);
        let valor = filtro.reduce((acc, valorfac) => Number(acc) + Number(valorfac.valor), 0);
        let cantidad = filtro.length;
        arrCantidad.push(cantidad);
        arrValor.push(valor);
    });

    ///solo guardamos el array con las fechas que contienen valores y su valor correspondiente
    let arrFinal = [];
    for (i = 0; i < fechas.length; i++) {
        arrFinal.push({
            fecha: fechas[i],
            valor: arrValor[i],
            cantidadFac: arrCantidad[i],
        });
    }

    ////
    ///encontramos la cantidad de dias entre las dos fechas
    let diff =
        new Date(fechaFinal).getTime() - new Date(fechainicial).getTime();
    let days = diff / (1000 * 60 * 60 * 24); ///cantidad de dias

    let date = new Date(fechainicial);
    date.setMinutes(date.getMinutes() + date.getTimezoneOffset()); ///para colocar las fecchas con time y poder compararlas luego
    date.setDate(date.getDate() - 1); //retrocedemos un dia ya que al hacer lo anterior corre la hora zanaoria un dia despues

    //guardamos en un array todos los dias entre el rango de los imputs
    for (i = 0; i <= days; i++) {
        let nd = date.setDate(date.getDate() + 1);
        da.push(new Date(nd));
    }

    ///guardamos en otro array  todas las fechas formateadas con valor 0
    for (i = 0; i < da.length; i++) {
        arrD[i] = { fecha: formatDateLarge(da[i]), valor: "0", cantidadF: "0" };
    }

    ///se cambian los valores en el array donde es diferebte de cero
    for (i = 0; i < da.length; i++) {
        let dat = da[i];

        for (j = 0; j < arrFinal.length; j++) {
            let datef = new Date(arrFinal[j].fecha);
            datef.setMinutes(datef.getMinutes() + datef.getTimezoneOffset());

            if (dat.getTime() == datef.getTime()) {
                arrD[i].valor = arrFinal[j].valor;
                arrD[i].cantidadF = arrFinal[j].cantidadFac;
            }
        }
    }

    return arrD;
};

function graficarBarrasHorizontal(
    idDatJson,
    clasFechaIni,
    clasFechaFin,
    idCanvas,
    datatableDatos,
    labelPrincipal='',
    colbusqueda=4,
    tituloGafico='Gráfico',
    textoToltip='Numero Movimientos de Día: '
) {
    
    let ventasObj = [];

    for (dato of JSON.parse($(idDatJson).val())) {
        ventasObj.push({
            fecha: dato.fecha,
            valor: dato.valor,
        });
    }

    

    const datosdias = addDays(
            $(clasFechaIni).val(),
            $(clasFechaFin).val(),
            ventasObj
        ),
        labDias = datosdias.map((x) => x.fecha),
        labValor = datosdias.map((x) => x.valor),
        mayorsig = redondeaNum(Math.round(getMaxOfArray(labValor))),
        maxValor = getMaxOfArray(labValor);
    let maxValorFecha = null,
        maxValorCantfac = null,
        minValor = getMinOfArray(labValor),
        minValorFecha = null,
        minValorCantfac = null;


        console.log(datosdias)

    for (i = 0; i < datosdias.length; i++) {
        if (datosdias[i].valor == maxValor) {
            maxValorFecha = datosdias[i].fecha;
            maxValorCantfac = datosdias[i].cantidadF;
        }

        if (datosdias[i].valor == minValor) {
            minValorFecha = datosdias[i].fecha;
            minValorCantfac = datosdias[i].cantidadF;
        }
    }

    $(".fechaMasValor").text(maxValorFecha);
    $(".maxValorCantidad").text(maxValorCantfac);
    $(".maxValor").text(new Intl.NumberFormat().format(maxValor));

    $(".fechaMinValor").text(minValorFecha);
    $(".minValorCantidad").text(minValorCantfac);
    $(".minValor").text(new Intl.NumberFormat().format(minValor));

    let ctx = document.getElementById(idCanvas);

    let myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: labDias,
            datasets: [
                {
                    label: labelPrincipal,
                    data: labValor,
                    fill: true,
                    borderColor: "rgb(75, 192, 192)",
                    backgroundColor: [
                        "rgb(51, 0, 0)",
                        "rgb(102, 102, 255)",
                        "rgb(102, 153, 102)",
                        "rgb(102, 204, 153)",
                        "rgb(153, 204, 255)",
                        "rgb(102, 255, 255)",
                        "rgb(0, 204, 153)",
                    ],
                    tension: 0.1,
                },
            ],
        },
        options: {
            onClick: (evt) => {
                const points = myChart.getElementsAtEventForMode(
                    evt,
                    "nearest",
                    {
                        intersect: true,
                    },
                    true
                );

                if (points.length) {
                    const firstPoint = points[0];
                    const label = myChart.data.labels[firstPoint.index];
                    const value =
                        myChart.data.datasets[firstPoint.datasetIndex].data[
                            firstPoint.index
                        ];
                    const months = [
                        "ENE",
                        "FEB",
                        "MAR",
                        "ABR",
                        "MAY",
                        "JUN",
                        "JUL",
                        "AGO",
                        "SEP",
                        "OCT",
                        "NOV",
                        "DIC",
                    ];

                    const fecha = label.split("-");
                    const dia =
                        fecha[1].toString().length < 2
                            ? "0" + fecha[1]
                            : fecha[1];
                    const m = months.indexOf(fecha[2]) + 1;
                    const mes = m.toString().length < 2 ? "0" + m : m;
                    const fechaCompleta = `${fecha[3]}-${mes}-${dia}`;
                    datatableDatos.columns(colbusqueda).search(fechaCompleta).draw();
                    $(".div-tabla-ventas-oculto")
                        .prop("hidden", false)
                        .trigger("focus");
                    $(".btnVerTabla").text("Ocultar Tabla Informe");
                    $(".btnVerTabla").on("click", function () {
                        datatableDatos.columns(colbusqueda).search("").draw();
                    });
                }
            },

            scales: {
                y: {
                    stacked: true,
                    min: 0,
                    max: mayorsig,
                    ticks: {
                        callback: function (value, index, values) {
                            return value / 1000000 + "M";
                        },
                    },
                },
                x: {
                    min: 0,
                },
            },
            plugins: {
                legend: {
                    display: false,
                },
                title: {
                    display: true,
                    position: "bottom",
                    text: tituloGafico,
                },
                zoom: {
                    zoom: {
                        wheel: {
                            enabled: false, //permite que se pueda usar la rueda del raton
                            speed: 0.01,
                            threshold: 0.1,
                        },
                        pinch: {
                            enabled: false, //permite usar el pellizco en la pantalla movil
                            speed: 0.0001,
                            threshold: 0.0001,
                        },

                        mode: "x", //permite el zoom en lo ejes estipulados aqui
                        onZoomComplete({ chart }) {
                            // This update is needed to display up to date zoom level in the title.
                            // Without this, previous zoom level is displayed.
                            // The reason is: title uses the same beforeUpdate hook, and is evaluated before zoom.
                            chart.update("none");
                        },
                    },
                    pan: {
                        enabled: false, //permite que se pueda mover el garfico en el eje xy
                        mode: "xy",
                        speed: 1,
                    },

                    limits: {
                        y: {
                            min: 0,
                            max: mayorsig,
                            minRange: 1000000,
                        }, //controla el minimo y el maximo del grafico en el eje y
                    },
                },
                tooltip: {
                    callbacks: {
                        footer: function (e) {
                            for (i = 0; i < datosdias.length; i++) {
                                if (datosdias[i].fecha == e[0].label) {
                                    return `${textoToltip} ${datosdias[i].cantidadF}`;
                                }
                            }
                        },
                    },
                },
            },
        },
    });

    $(".resetZoomChart").on("click", function () {
        myChart.resetZoom();
    });

    $(".Zoomas").on("click", function (e) {
        myChart.zoom(1.1);
    });

    $(".Zoomenos").on("click", function () {
        myChart.zoom(0.9);
    });

    $(".panlef").on("click", function () {
        myChart.pan(
            {
                x: 100,
            },
            undefined,
            "default"
        );
    });

    $(".panrig").on("click", function () {
        myChart.pan(
            {
                x: -100,
            },
            undefined,
            "default"
        );
    });
}
