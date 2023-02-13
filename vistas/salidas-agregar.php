<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">General</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- CREATE TABLE entradas_cabeceras (
                    id SERIAL  NOT NULL,
                    proveedor_id INTEGER  NOT NULL,
                    codigo CHARACTER VARYING(40)  NOT NULL,
                    fecha DATE  NOT NULL,
                    factura_nro CHARACTER VARYING(40),
                    remision_nro CHARACTER VARYING(40),
                    entregado_por CHARACTER VARYING(40),
                    monto_total MONEY,
                    monto_letras CHARACTER VARYING(250),
                    descripcion TEXT
                );
                CREATE TABLE entradas_detalles (
                    id SERIAL  NOT NULL,
                    entrada_cabecera_id INTEGER  NOT NULL,
                    producto_id INTEGER  NOT NULL,
                    cantidad INTEGER  NOT NULL,
                    lote CHARACTER VARYING(40)  NOT NULL,
                    precio_individual DOUBLE PRECISION  NOT NULL,
                    precio_total DOUBLE PRECISION  NOT NULL,
                    fecha_vencimiento CHARACTER(40)  NOT NULL
                ); -->
                <div class="card-body form-product">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="code">Codigo</label>
                            <input type="text" id="code" class="form-control" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="supplierId">Proveedor</label>
                            <select id="supplierId" class="form-control custom-select" required>
                                <option selected disabled value="0">Seleccione uno</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="date">Fecha</label>
                            <input type="date" id="date" class="form-control" value="<?php echo date('Y-m-d');?>" required disabled>
                        </div>
                        <div class="col-sm-6">
                            <label for="invoiceNro">Factura Nro</label>
                            <input type="text" id="invoiceNro" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="remissionNro">Remision Nro</label>
                            <input id="remissionNro" class="form-control" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="deliveredBy">Entregado por</label>
                            <input id="deliveredBy" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="amountTotal">Monto Total</label>
                            <input id="amountTotal" class="form-control" required disabled>
                        </div>
                        <div class="col-sm-6">
                            <label for="amountLetters">Monto en Letras</label>
                            <input id="amountLetters" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripcion</label>
                        <input id="description" class="form-control" required>
                    </div>
                    <div class="detalle">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Lote</th>
                                    <th>Fecha vencimiento</th>
                                    <th>Precio individual</th>
                                    <th>Precio total</th>
                                </tr>
                            </thead>
                            <tbody class="entrada-detalle">
                                <tr>
                                    <td>
                                        <input type="text" class="product-id" list="productos">
                                    </td>
                                    <td>
                                        <input type="number" class="product-qty" value=0>
                                    </td>
                                    <td>
                                        <input type="text" class="product-lote">
                                    </td>
                                    <td>
                                        <input type="date" class="product-vence">
                                    </td>
                                    <td>
                                        <input type="text" class="product-punit" value=0>
                                    </td>
                                    <td>
                                        <input type="text" class="product-ptotal" value=0 disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="product-id" list="productos">
                                    </td>
                                    <td>
                                        <input type="number" class="product-qty" value=0>
                                    </td>
                                    <td>
                                        <input type="text" class="product-lote">
                                    </td>
                                    <td>
                                        <input type="date" class="product-vence">
                                    </td>
                                    <td>
                                        <input type="text" class="product-punit" value=0>
                                    </td>
                                    <td>
                                        <input type="text" class="product-ptotal" value=0 disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="product-id" list="productos">
                                    </td>
                                    <td>
                                        <input type="number" class="product-qty" value=0>
                                    </td>
                                    <td>
                                        <input type="text" class="product-lote">
                                    </td>
                                    <td>
                                        <input type="date" class="product-vence">
                                    </td>
                                    <td>
                                        <input type="text" class="product-punit" value=0>
                                    </td>
                                    <td>
                                        <input type="text" class="product-ptotal" value=0 disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="product-id" list="productos">
                                    </td>
                                    <td>
                                        <input type="number" class="product-qty" value=0>
                                    </td>
                                    <td>
                                        <input type="text" class="product-lote">
                                    </td>
                                    <td>
                                        <input type="date" class="product-vence">
                                    </td>
                                    <td>
                                        <input type="text" class="product-punit" value=0>
                                    </td>
                                    <td>
                                        <input type="text" class="product-ptotal" value=0 disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="product-id" list="productos">
                                    </td>
                                    <td>
                                        <input type="number" class="product-qty" value=0>
                                    </td>
                                    <td>
                                        <input type="text" class="product-lote">
                                    </td>
                                    <td>
                                        <input type="date" class="product-vence">
                                    </td>
                                    <td>
                                        <input type="text" class="product-punit" value=0>
                                    </td>
                                    <td>
                                        <input type="text" class="product-ptotal" value=0 disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="product-id" list="productos">
                                    </td>
                                    <td>
                                        <input type="number" class="product-qty" value=0>
                                    </td>
                                    <td>
                                        <input type="text" class="product-lote">
                                    </td>
                                    <td>
                                        <input type="date" class="product-vence">
                                    </td>
                                    <td>
                                        <input type="text" class="product-punit" value=0>
                                    </td>
                                    <td>
                                        <input type="text" class="product-ptotal" value=0 disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="product-id" list="productos">
                                    </td>
                                    <td>
                                        <input type="number" class="product-qty" value=0>
                                    </td>
                                    <td>
                                        <input type="text" class="product-lote">
                                    </td>
                                    <td>
                                        <input type="date" class="product-vence">
                                    </td>
                                    <td>
                                        <input type="text" class="product-punit" value=0>
                                    </td>
                                    <td>
                                        <input type="text" class="product-ptotal" value=0 disabled>
                                    </td>
                                </tr>
                                <datalist id="productos">
                                </datalist>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="#" class="btn btn-secondary">Cancelar</a>
            <button id="addSalida" class="btn btn-success float-right product-action">Realizar entrada</button>
        </div>
    </div>
</section>