// Elegir el producto
const selectElement = document.getElementById('supplier');

selectElement.addEventListener('change', (event) => {
    var campo1 = document.getElementById('ruc')
    var campo2 = document.getElementById('address')

    fetch('/api/supplier')
    .then(response => response.json())
    .then(supplier => {
        // Hacer algo con los datos recibidos

        supplier.forEach(element => {
            if (element.id == event.target.value) {
                campo1.value = element.ruc
                campo2.value = element.address

                return false
            }
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
});




function BuscarProducto() {
    var name_product = document.getElementById('p_name')

    // Ahora los campos que rellenare
    var id_product = document.getElementById('p_id')
    var amount_product = document.getElementById('p_amount')
    var price_product = document.getElementById('p_price')
    // Interactuar
    var amount = document.getElementById('s_amount')

    fetch('/api/data')
    .then(response => response.json())
    .then(data => {
        // Hacer algo con los datos recibidos
        console.log(data);

        data.forEach(element => {
            if (element.name.includes(name_product.value.toUpperCase())) {
                id_product.value = element.id
                name_product.value = element.name
                amount_product.value = element.stock
                price_product.value = element.price

                if (element.stock == 0) {
                    amount.setAttribute('disabled', '')
                }else if(element.stock > 0) {
                    amount.setAttribute('max', element.stock)
                }

                return false
            }
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function MostrarTabla(table1, table2) {

    var table_sale = document.getElementById(table1)
    var table_order = document.getElementById(table2)

    table_sale.style.display = 'null'
    table_order.style.display = 'none'
}

function ReporteCompra() {
    console.log('ReporteCompra')

}






// Obtener el elemento select
/*
var selectElement = document.getElementById('voucher');

// Escuchar el evento de cambio
selectElement.addEventListener('change', function() {
    
    
    // Obtener el valor seleccionado
    var selectedValue = selectElement.value;
    
    // Realizar acciones condicionales en el cliente
    if (selectedValue === '1') {
        // Mostrar u ocultar elementos
        var conditionalElement = document.getElementById('ruc-input');
        if (conditionalElement) {
            conditionalElement.style.display = 'block';
        }
    } else {
        // Restaurar estado inicial u ocultar elementos
        var conditionalElement = document.getElementById('ruc-input');
        if (conditionalElement) {
            conditionalElement.style.display = 'none';
        }
    }
});*/