import numpy as np
import mysql.connector as myc
import funciones15 as f15

num = 0
tablas = ('categoria', 'producto')

for t in tablas:
    num += 1 
    print(f'-{num}: {t}')
tabla = int(input('Sobre que tabla desearías trabajar?: '))
if tabla == 1:
    while True:
        bdd = f15.conectar('supermercado') #conectamos la base de datos
        cursor = bdd.cursor()
        if bdd.is_connected():
            print(f'=== Gestión de Categorías === \nSeleccione una opción: \n1. Crear nueva categoría \n2. Leer categorías existentes \n3. Actualizar una categoría \n4. Eliminar una categoría \n5. Salir')
            opcion = int(input('Escribe una de las opciones mencionadas en el menú: '))
            print('Se ha conectado correctamente a la base de datos supermercado\n') 
        else:
            print('No se ha conseguido conectar a la base de datos')
        match opcion:
            case 1:
                try:
                    id_catego = input('Escribe el id de la categoría: ') #pedimos el id de la categoría
                    name_catego = input('Escribe el nombre de la categoría: ') #pedimos el nombre de la categoría
                    nueva_catego = (id_catego, name_catego) #creamos una tupla con los datos introducidos
                    insert_catego = "insert into categoria (idcategoria, categoria) values (%s,%s)" #este será el comando que se insertara posteriormente junto a los datos que guardamos en la variable anterior
                    cursor.execute(insert_catego, nueva_catego)
                    bdd.commit()
                    print('Se ha guardado correctamente')
                except Exception:
                    bdd.rollback() #en caso de que se de algun error se revertirá la acción
                    print('Ha currido un error', Exception)
                finally: #una vez se finalice el try o el except pasara a cerrar la base de datos y el controlador cursor
                    cursor.close()
                    bdd.close
            case 2:           
                cursor.execute("select * from categoria")
                resultados = cursor.fetchall()
                for idcatego, categoria in resultados:
                    print(f"Id categoría: {idcatego}, Nombre categoría: {categoria}")
                cursor.close()
                bdd.close()
            case 3:
                print('Se ha conectado correctamente a la base de datos supermercado \n')
                dato_id = input('¿Que categoría deseas cambiar (escribe su id): ')
                dato_name = input('¿Que nombre deseas establecer: ')
                consulta = ("UPDATE `supermercado`.`categoria` SET `categoria` = %s WHERE (`idcategoria` = %s);")
                cursor.execute(consulta, (str(dato_name), dato_id))
                bdd.commit()

                cursor.close()
                bdd.close()
            case 4:
                if bdd.is_connected():
                    print('Se ha conectado correctamente a la base de datos supermercado \n')
                    delete_id = input('¿Que categoría deseas eliminar (escribe su id): ')

                    # 1. Obtener todos los idproducto asociados a la categoría a eliminar
                    consulta_productos = "SELECT idproducto FROM producto WHERE idcategoria = %s"
                    cursor.execute(consulta_productos, (delete_id,))
                    productos = cursor.fetchall()  # Lista de productos relacionados con la categoría

                    # 2. Eliminar los registros en la tabla 'detalle' que dependen de esos productos
                    for (idproducto,) in productos:
                        consulta_detalle = "DELETE FROM detalle WHERE idproducto = %s"
                        cursor.execute(consulta_detalle, (idproducto,))

                    # 3. Eliminar los productos relacionados en la tabla 'producto'
                    consulta_producto = "DELETE FROM producto WHERE idcategoria = %s"
                    cursor.execute(consulta_producto, (delete_id,))

                    # 4. Eliminar la categoría en la tabla 'categoria'
                    consulta_categoria = "DELETE FROM categoria WHERE idcategoria = %s"
                    cursor.execute(consulta_categoria, (delete_id,))

                    bdd.commit()
                    cursor.close()
                    bdd.close()
            case 5:
                print('Hasta luego')
                break

elif tabla == 2:
    while True:
        bdd = f15.conectar('supermercado') #conectamos la base de datos
        cursor = bdd.cursor()
        if bdd.is_connected():
            print('Se ha conectado correctamente a la base de datos supermercado \n') 
            print(f'=== Gestión de Productos === \nSeleccione una opción: \n1. Crear nuevo producto \n2. Leer productos existentes \n3. Actualizar un producto \n4. Eliminar un producto \n5. Salir')
            opcion = int(input('Escribe una de las opciones mencionadas en el menú: '))
        else:  
            print('No se ha conseguido conectar a la base de datos')
        
        match opcion:            
            case 1:
                try:
                    id_product = int(input('Escribe el id del producto: ')) #pedimos el id del producto
                    name_product = input('Escribe el nombre del producto: ') #pedimos el nombre del producto
                    id_catego = int(input('¿De que categoría es tu producto?: '))
                    medida_product = input('Escribe las medidas de tu producto: ')
                    precio_product = int(input('Escribe el precio: '))
                    stock_product = int(input('¿Cuantos quedan en stock?: '))
                    nuevo_product = (id_product, name_product, id_catego, medida_product, precio_product, stock_product) #creamos una tupla con los datos introducidos
                    insert_product = "insert into producto (idproducto, nombre, idcategoria, medida, precio, stock) values (%s,%s,%s,%s,%s,%s)" #este será el comando que se insertara posteriormente junto a los datos que guardamos en la variable anterior
                    
                    cursor.execute(insert_product, nuevo_product)
                    bdd.commit()
                    print('Se ha guardado correctamente')

                    cursor.close()
                    bdd.close()
                
                except Exception:
                    bdd.rollback() #en caso de que se de algun error se revertirá la acción
                    print('Ha currido un error', Exception)
                finally: #una vez se finalice el try o el except pasara a cerrar la base de datos y el controlador cursor
                    cursor.close()
                    bdd.close()
            case 2:
                cursor.execute("select * from producto")
                resultados = cursor.fetchall()
                for id_product, name_product, id_catego, medida_product, precio_product, stock_product in resultados:
                    print(f"Id producto: {id_product} \nNombre producto: {name_product} \nId categoría: {id_catego} \nMedida: {medida_product} \nPrecio: {precio_product} \nStock: {stock_product}\n===\n")
                cursor.close()
                bdd.close()
            case 3:
                dato_id = input('¿Que producto deseas cambiar (escribe su id): ')
                dato_name = input('¿Que nombre deseas establecer: ')
                consulta = ("UPDATE `supermercado`.`producto` SET `nombre` = %s WHERE (`idproducto` = %s);")
                cursor.execute(consulta, (str(dato_name), dato_id))
                bdd.commit()

                cursor.close()
                bdd.close()
            case 4:
                    delete_id = input('¿Que producto deseas eliminar (escribe su id): ')

                    # 1. Obtener todos los idproducto asociados a la categoría a eliminar
                    consulta_productos = "SELECT idproducto FROM producto WHERE idproducto = %s"
                    cursor.execute(consulta_productos, (delete_id,))
                    productos = cursor.fetchall()  # Lista de productos relacionados con la categoría

                    # 2. Eliminar los registros en la tabla 'detalle' que dependen de esos productos
                    for (idproducto,) in productos:
                        consulta_detalle = "DELETE FROM detalle WHERE idproducto = %s"
                        cursor.execute(consulta_detalle, (idproducto,))

                    # 3. Eliminar los productos relacionados en la tabla 'producto'
                    consulta_producto = "DELETE FROM producto WHERE idproducto = %s"
                    cursor.execute(consulta_producto, (delete_id,))

                    bdd.commit()

                    cursor.close()
                    bdd.close()
            case 5:
                print('Hasta luego')
                break
