<?php
session_start()

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?php include 'include/scripts.php'; ?>
        <title>Nueva Venta</title>
    </head>
    <body>
        <?php include 'include/header.php'; ?>
        <section id="container">
            <div class="title_pege">
                <h1>Nueva venta</h1>
            </div>
            <div class="datos_cliente">
                <div class="action_cliente">
                    <h4>Datos del Cliente</h4>
                    <a href="#" class="btn_new btn_new_cliente">Nuevo Cliente</a>
                </div>
                <form name="form_new_cliente_venta" id="form_new_cliente_venta" class="datos">
                    
                    <div class="wd30">
                        <label>Nit</label>
                        <input type="text" name="nit_cliente" id="nit_cliente">
                    </div>
                    <div class="wd30">
                        <label>Nombre</label>
                        <input type="text" name="nom_cliente" id="nom_cliente">
                    </div>
                    <div class="wd30">
                        <label>Telefono</label>
                        <input type="number" name="tel_cliente" id="tel_cliente">
                    </div>
                    <div class="wd100">
                        <label>Direccion</label>
                        <input type="text" name="dir_cliente" id="dir_cliente">
                    </div>
                    <div id="div_registro_cliente" class="wd100">
                        <button type="submit" class="btn_save" >Guardar</button>
                    </div>
                </form>
            </div>
            <div class="datos_venta">
                <h4>Datos Venta</h4>
                <div class="datos">
                    <div class="wd50">
                        <label>Vendedor</label>
                        <p>Adrian Cortes Orrego</p>
                    </div>
                    <div class="wd50">
                        <label>Acciones</label>
                        <div id="acciones_venta">
                            <a href="#" class="btn_ok textcenter" id="btn_anular_venta">Anular</a>
                            <a href="#" class="btn_ok textcenter" id="btn_facturar_venta">Procesar</a>
                        </div>
                    </div>
                </div>
            </div>
            <table class="tbl_venta">
                <thead>
                    <tr>
                        <th width="100px">Codigo</th>
                        <th>Descripcion</th>
                        <th>Existencia</th>
                        <th width="100px">Cantidad</th>
                        <th class="textright">Precio</th>
                        <th class="textright">Precio Total</th>
                        <th>Accion</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="txt_cod_producto" id="txt_cod_producto"></td>
                        <td id="txt_descripcion">-</td>
                        <td id="txt_existencia">-</td>
                        <td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1" disabled ></td>
                        <td id="txt_precio" class="textright">0.00</td>
                        <td id="txt_precio_total" class="textright">0.00</td>
                        <td><a href="#" id="add_product_venta" class="link_add">Agregar</a></td>
                    </tr>
                    <tr>
                        <th>Codigo</th>
                        <th colspan="2">Descripcion</th>
                        <th>Cantidad</th>
                        <th class="textright">Precio</th>
                        <th class="textright">Precio Total</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody id="detalle_venta">
                    <tr>
                        <td>1</td>
                        <td colspan="2">Coca-Cola</td>
                        <td class="textcenter">2</td>
                        <td class="textright">1.500</td>
                        <td class="textright">3.000</td>
                        <td class=""><a class="link_delete" href="#"></a></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td colspan="2">Papas Margarita</td>
                        <td class="textcenter">1</td>
                        <td class="textright">2000</td>
                        <td class="textright">2.000</td>
                        <td class=""><a class="link_delete" href="#"></a></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="textright">SUBTOTAL</td>
                        <td class="textright">4.050</td>
                    </tr>
                      <tr>
                        <td colspan="5" class="textright">IVA (19%)</td>
                        <td class="textright">950</td>
                    </tr>
                      <tr>
                        <td colspan="5" class="textright">TOTAL</td>
                        <td class="textright">5.000</td>
                    </tr>
                </tfoot>
            </table>
        </section>
        <?php include 'include/footer.php'; ?>
    </body>
</html>
