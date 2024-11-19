import funciones as fun

pedidos = [] #aqui almacenaremos la informacion de los pedidos que hayan sido ejecutados
lista = [] #en esta lista se guardaran los usuarios registrados
productos = [ 
    {'id_producto': '1', 'nombre': 'manzana', 'stock': 7, 'precio': 2},
    {'id_producto': '2', 'nombre': 'banana', 'stock': 15, 'precio': 1},
    {'id_producto': '3', 'nombre': 'naranja', 'stock': 10, 'precio': 3},
    {'id_producto': '4', 'nombre': 'pera', 'stock': 12, 'precio': 2},
    {'id_producto': '5', 'nombre': 'uva', 'stock': 20, 'precio': 4},
    {'id_producto': '6', 'nombre': 'sandia', 'stock': 5, 'precio': 7},
    {'id_producto': '7', 'nombre': 'melon', 'stock': 8, 'precio': 6},
    {'id_producto': '8', 'nombre': 'kiwi', 'stock': 13, 'precio': 3},
    {'id_producto': '9', 'nombre': 'pomelo', 'stock': 6, 'precio': 5},
    {'id_producto': '10', 'nombre': 'mango', 'stock': 9, 'precio': 4}
    ] #almacenamos todos los productos con sus datos en una lista de dicconarios
cesta = [] #aqui se almacenan los valores de la compra que se ese realizando
while True:
    num = 0
    
    id_pedido = 0

    opciones = ('registrar cliente', 'visualizar clientes', 'comprar', 'seguimiento pedido', 'salir') #menu de opciones para realizar
    for opcion in opciones: #bucle para imprimir las cada opcion del menu
        num += 1
        print(f'-{num}: {opcion}')
    deseo = int(input('¿Cual de las acciones mencionadas desea realizar?: '))
    match deseo: #con este match ejecuaremos la opcion del menu que deseemos
        case 1:
            registro = fun.registro() #funcion para registrarse
            lista.append(registro) #añadimos el cliente a la lista de clientes
        case 2: #este case nos lleva a la visualizacion de los clientes registrados
            id_cliente = 0
            print("{:<10} {:<20} {:<20} {:<20}".format("ID", "Nombre", "DNI", "Teléfono")) #Hacemos que se escriba un encabezado de la tabla, la cual hemos creado de esta manera asignandole x caracteres por columna como longitud
            print("-" * 70) #Con esto separo las lineas con 70 guiones
            for cliente in lista:
                id_cliente += 1
                print("{:<10} {:<20} {:<20} {:<20}".format(id_cliente, cliente['nombre'], cliente['dni'], cliente['tlf']))
        case 3:
            while True:
                inicio_sesion = input('Escribe el dni del cliente para iniciar sesion: ')
                if fun.existe_en_lista(lista,'dni',str(inicio_sesion)): #verificamos si el dni es correcto
                    break
                else:
                    print('Error, ingrese el dni de nuevo')
            while True:                     
                print("{:<10} {:<20} {:<10} {:<10}".format("ID", "Producto", "Stock", "Precio (€)")) #Hacemos que se escriba un encabezado de la tabla, la cual hemos creado de esta manera asignandole x caracteres por columna como longitud
                print("-" * 50) #Con esto separo las lineas con 50 guiones
                for producto in productos:
                    print("{:<10} {:<20} {:<10} {:<10}".format(producto['id_producto'], producto['nombre'], producto['stock'], producto['precio'])) #Aquí estamos haciendo que escriba los datos de cada producto
                comprar = input('¿Que producto desea comprar? (escribe su id): ')

                for producto1 in productos:
                    if producto1['id_producto'] == comprar:
                        comprado = producto1
                        break
                max_stock = comprado['stock'] #de la anterior forma estamos buscando el stock del producto que se desea comprar, para luego establecerle un límite
                
                while True:
                    cantidad = int(input(f'¿Que cantidad deseas comprar? (el máximo que puedes comprar es de {max_stock}) : '))
                    
                    if cantidad <= max_stock: #comprobamos que vaya a comprar una cantidad compatible con el stock
                        for a in productos:
                            if a['id_producto'] == comprar:
                                cesta.append({'id_producto': a['id_producto'], 'nombre': a['nombre'], 'cantidad': cantidad, 'precio_total': (cantidad*a['precio'])}) #creamos la lista cesta para guardar los datos de lo que se vaya añadiendo a la compra
                                a['stock'] -= cantidad #le restamos lo que se vaya escogiendo
                                
                            
                    elif cantidad > max_stock:  #Si escoge mas que la cantidad del stock saldra un error 
                        print('\nError, estas poniendo una cantidad más alta que el stock\n')
                    break
                seguir = int(input('¿Que deseas hacer?\n-1: Finalizar pedido:\n-2: Cancelar compra\n-3: Añadir más productos a la cesta ')) #preguntamos que desea continuar haciendo
                if seguir == 1:
                    id_pedido +=1
                    for cliente in lista:
                        if cliente['dni'] == inicio_sesion: #ahora se guardaran los pedidos en la lista pedidos
                            pedidos.append({'id': id_pedido, 'nombre_cliente': cliente['nombre'], 'dni': cliente['dni'], 'id_producto': a['id_producto'], 'nombre': a['nombre'], 'cantidad': cantidad, 'precio_total': (cantidad*a['precio']), 'cesta': cesta}) 
                        else:
                            print("hola")
                    break
                elif seguir == 2:
                    cesta = []
                    productos = [ #aqui reiniciamos el stock en caso de que se cancele la compra
                        {'id_producto': '1', 'nombre': 'manzana', 'stock': 7, 'precio': 2},
                        {'id_producto': '2', 'nombre': 'banana', 'stock': 15, 'precio': 1},
                        {'id_producto': '3', 'nombre': 'naranja', 'stock': 10, 'precio': 3},
                        {'id_producto': '4', 'nombre': 'pera', 'stock': 12, 'precio': 2},
                        {'id_producto': '5', 'nombre': 'uva', 'stock': 20, 'precio': 4},
                        {'id_producto': '6', 'nombre': 'sandia', 'stock': 5, 'precio': 7},
                        {'id_producto': '7', 'nombre': 'melon', 'stock': 8, 'precio': 6},
                        {'id_producto': '8', 'nombre': 'kiwi', 'stock': 13, 'precio': 3},
                        {'id_producto': '9', 'nombre': 'pomelo', 'stock': 6, 'precio': 5},
                        {'id_producto': '10', 'nombre': 'mango', 'stock': 9, 'precio': 4}
                        ]
                    break
            print("-" * 50) #Con esto separo las lineas con 50 guiones
        case 4:
            print("{:<10} {:<20} {:<15} {:<20} {:<10} {:<10}".format("ID Pedido", "Cliente", "DNI", "Productos", "Cantidad", "Total (€)"))  # Encabezado de la tabla
            print("-" * 85)  # Línea divisoria
            for pedido in pedidos:
                print("{:<10} {:<20} {:<15} ".format(pedido['id'], pedido['nombre_cliente'], pedido['dni'] )) #le mostramos resumidamente todos los pedidos

            que_pedido = int(input('¿Que pedido deseas ver con más detalles? (escribe su id): '))
            for pedido in pedidos:
                if pedido['id'] == que_pedido: 
                    for product in pedido['cesta']:
                        print("{:<20} {:10} {:<10}".format("Producto", "Cantidad", "Total (€)"))
                        print("-" * 50) #Con esto separo las lineas con 50 guiones
                        print('{:<20} {:<10} {:<10}'.format(product['nombre'], product['cantidad'], product['precio_total'])) #le mostramos detalladamente el pedido seleccionado

        case _:
            break  #finalizamos el programa    
                    
                    



