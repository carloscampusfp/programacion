import numpy as np
import mysql.connector as myc
import funciones15 as f15
print(f'=== Gestión de Categorías === \nSeleccione una opción: \n1. Crear nueva categoría \n2. Leer categorías existentes \n3. Actualizar una categoría \n4. Eliminar una categoría \n5. Salir')
opcion = int(input('Escribe una de las opciones mencionadas en el menú: '))

match opcion:
    case 1:
        nombre_bdd = input('¿Como se llama la base de datos?: ')
        bdd = f15.conectar(nombre_bdd) #conectamos la base de datos
        try:
            if bdd.is_connected():
                print('Se ha conectado correctamente a la base de datos llamada:', nombre_bdd, "\n") 
                id_catego = input('Escribe el id de la categoría: ') #pedimos el id de la categoría
                name_catego = input('Escribe el nombre de la categoría: ') #pedimos el nombre de la categoría
                nueva_catego = (id_catego, name_catego) #creamos una tupla con los datos introducidos
                insert_catego = "insert into categoria (idcategoria, categoria) values (%s,%s)" #este será el comando que se insertara posteriormente junto a los datos que guardamos en la variable anterior
                cursor = bdd.cursor()
                cursor.execute(insert_catego, nueva_catego)
                bdd.commit()
                print('Se ha guardado correctamente')
                cursor.close()
                bdd.close()
            else:
                print('No se ha conseguido conectar a la base de datos')
        except Exception:
            bdd.rollback() #en caso de que se de algun error se revertirá la acción
            print('Ha currido un error', Exception)
        finally: #una vez se finalice el try o el except pasara a cerrar la base de datos y el controlador cursor
            cursor.close()
            bdd.close
    case 2:
        nombre_bdd = input('¿Como se llama la base de datos?: ')
        bdd = f15.conectar(nombre_bdd) #conectamos la base de datos
        if bdd.is_connected():
            print('Se ha conectado correctamente a la base de datos llamada:', nombre_bdd, "\n")
            cursor = bdd.cursor()
            cursor.execute("select * from categoria")
            resultados = cursor.fetchall()
            for idcatego, categoria in resultados:
                print(f"Id categoría: {idcatego}, Nombre categoría: {categoria}")
        cursor.close()
        bdd.close
    case 3:
        nombre_bdd = input('¿Como se llama la base de datos?: ')
        bdd = f15.conectar(nombre_bdd) #conectamos la base de datos
        if bdd.is_connected():
            print('Se ha conectado correctamente a la base de datos llamada:', nombre_bdd, "\n")
            cursor = bdd.cursor()
            dato_id = input('¿Que categoría deseas cambiar (escribe su id): ')
            dato_name = input('¿Que nombre deseas establecer: ')
            consulta = ("UPDATE `supermercado`.`categoria` SET `categoria` = %s WHERE (`idcategoria` = %s);")
            cursor.execute(consulta, (str(dato_name), dato_id))
            bdd.commit()
            cursor.close()
            bdd.close
    case 4:
        nombre_bdd = input('¿Como se llama la base de datos?: ')
        bdd = f15.conectar(nombre_bdd) #conectamos la base de datos
        if bdd.is_connected():
            print('Se ha conectado correctamente a la base de datos llamada:', nombre_bdd, "\n")
            cursor = bdd.cursor()
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
            bdd.close
    case 5:
        print('Hasta luego')